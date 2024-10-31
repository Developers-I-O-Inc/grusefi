<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Paises;
use App\Models\Operation\Embarques;
use App\Models\Operation\EmbarquesMarcas;
use App\Models\Operation\PlantillaRPV;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlantillasController extends Controller
{
    public function plantillas_rpv(){
        $paises = Paises::all();
        return view("operation/rpv", compact('paises'));
    }

    public function save_plantilla(Request $request) {
        $datos = $request->json()->all();
        $count_pais = PlantillaRPV::where("pais_id",$request->pais_id)->count();
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
        foreach ($datos as $campo => $valor) {
            $registro->$campo = $valor;
        }

        $registro->save();

        return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);

    }

    public function get_plantilla($pais){
        $plantilla = PlantillaRPV::where("pais_id", $pais)->get();

        return response()->json(["plantilla"=>$plantilla]);
    }

    public function imprimir_dictamen($id)
    {
        $plantilla = PlantillaRPV::find($id);
        $pdf = PDF::loadView('operation/reports/dicatamen', compact("plantilla"));
        return $pdf->stream('reporte_productos.pdf');
    }

    public function imprimir_dictamen_embarque($pais_id, $embarque_id)
    {
        $embarque = Embarques::get_embarque($embarque_id);
        $plantilla = PlantillaRPV::where('pais_id', $pais_id)->first();
        $embarques_marcas = EmbarquesMarcas::get_marcas_embarque($embarque_id);
        $pdf = PDF::loadView('operation/reports/dicatamen_embarque', compact("plantilla", "embarque", "embarques_marcas"));
        return $pdf->stream('embarque.pdf');
    }
}
