<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Destinatarios;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\Paises;
use App\Models\Catalogs\Variedades;
use App\Models\Catalogs\Vigencias;
use App\Models\Operation\Embarques;
use App\Models\Operation\EmbarquesMarcas;
use App\Models\Operation\EmbarquesProductos;
use App\Models\Operation\EmbarquesRPV;
use App\Models\Operation\EmbarquesStandards;
use App\Models\Operation\PlantillaRPV;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PlantillasController extends Controller
{
    public function plantillas_rpv(Request $request){
        $vigencias = Vigencias::where('activo', 1)->get();
        if($vigencias->count() == 0){
            return redirect()->route('vigencias.index')->with('error_vigencia', 'No hay vigencias activas, por favor activa una vigencia para poder continuar.');
        }
        if ($request->has('message_type') && $request->has('message')) {
            session()->flash('message_type', $request->query('message_type'));
            session()->flash('message', $request->query('message'));
            session()->flash('pais_id', $request->query('pais_id'));
            session()->flash('variedad_id', $request->query('variedad_id'));
        }
        $paises = Paises::where('activo', 1)->get();
        if (Auth::user()->hasRole(['Super Admin'])) {
            $municipios = Municipios::where('activo', 1)->get();
        }
        else{
            $municipios = Municipios::municipios_by_user(Auth::user()->id);
        }
        return view("operation/rpv", compact('paises', 'vigencias', 'municipios'));
    }

    public function save_plantilla(Request $request) {
        $datos = $request->json()->all();
        $count_pais = PlantillaRPV::where("pais_id",$request->pais_id)->where("municipio_id", $request->municipio_id)->count();
        if($count_pais > 0 ){
            return response()->json(['mensaje' => 'El país ya tiene una plantilla registrada'], 422);
        }
        else{
            $registro = new PlantillaRPV();

            foreach ($datos as $campo => $valor) {
                $registro->$campo = $valor;
            }

            $registro->save();

            return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);
        }

    }

    public function edit_plantilla(Request $request) {
        $datos = $request->json()->all();
        $registro = PlantillaRPV::find($request->id);
        unset($datos['vigencia_id']);
        foreach ($datos as $campo => $valor) {
            $registro->$campo = $valor;
        }

        $registro->save();

        return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);

    }

    public function get_plantilla($pais, $variedad){
        $plantilla = PlantillaRPV::where("pais_id", $pais)->where("municipio_id", $variedad)->get();

        return response()->json(["plantilla"=>$plantilla]);
    }

    public function imprimir_dictamen($id)
    {
        $plantilla = PlantillaRPV::find($id);
        $pdf = PDF::loadView('operation/reports/dicatamen', compact("plantilla"));
        return $pdf->stream('reporte_productos.pdf');
    }

    public function imprimir_dictamen_embarque_rpv($embarque_id)
    {
        $embarque = Embarques::get_embarque($embarque_id);
        $domicilio_destinatario = Destinatarios::get_destinatario_address($embarque_id);
        $plantilla = EmbarquesRPV::where('embarque_id', $embarque_id)->first();
        $embarques_standards = EmbarquesStandards::get_standards_embarque($embarque_id);
        $count_productos = EmbarquesProductos::select('variedad_id')->where('embarque_id', $embarque_id)->groupBy('variedad_id')->get()->count();
        $embarques_productos = EmbarquesProductos::get_only_embarque_products($embarque_id);
        $quantities = EmbarquesProductos::get_only_embarque_quantities($embarque_id);
        $presentations = EmbarquesProductos::get_presentations($embarque_id);
        $procedencia = Embarques::get_procedencia($embarque_id);
        $standards = EmbarquesStandards::get_standards_embarque($embarque_id);
        $marcas = EmbarquesProductos::get_only_embarque_marcas($embarque_id);
        $vigencias = Vigencias::where('activo', 1)->first();
        // $pdf = PDF::loadView('operation/reports/dictamen_embarque', compact("plantilla", "embarque", "embarques_standards", "count_productos", "embarques_productos",
        //     "presentations", 'procedencia', 'standards', 'quantities', 'marcas', 'vigencias', 'domicilio_destinatario'));
        // return $pdf->stream($embarque->folio_embarque.'.pdf');
        $pdf = PDF::loadView('operation/reports/dictamen_embarque', compact(
            "plantilla", "embarque", "embarques_standards", "count_productos",
            "embarques_productos", "presentations", 'procedencia', 'standards',
            'quantities', 'marcas', 'vigencias', 'domicilio_destinatario'
        ));

        $pdf->setOption('isPhpEnabled', true);

        $canvas = $pdf->getDomPDF()->getCanvas();
        $canvas->page_script(function($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = "CONFIDENCIAL";
            $font = $fontMetrics->getFont('Arial', 'bold');
            $size = 80;
            $opacity = 0.1;

            // Posición centrada
            $x = ($canvas->get_width() - $fontMetrics->getTextWidth($text, $font, $size)) / 2;
            $y = $canvas->get_height() / 2;

            // Rotar 45 grados
            $canvas->save();
            $canvas->rotate(-45, $x, $y);
            $canvas->set_opacity($opacity);
            $canvas->text($x, $y, $text, $font, $size, [0, 0, 0]);
            $canvas->restore();
        });

        return $pdf->stream($embarque->folio_embarque.'.pdf');
    }

    public function validate_plantilla($pais, $variedad){
        $count_pais = PlantillaRPV::where("pais_id",$pais)->where('municipio_id', $variedad)->count();
        if($count_pais > 0 ){
            return response()->json(['mensaje' => 'si esta'], 200);
        }
        else{
            return response()->json(['mensaje' => 'El país ya tiene una plantilla registrada'], 422);
        }
    }

}
