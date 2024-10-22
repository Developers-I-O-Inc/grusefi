<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Calibres;
use App\Models\Catalogs\Categorias;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Paises;
use App\Models\Catalogs\Presentaciones;
use App\Models\Catalogs\TipoCultivos;
use App\Models\Operation\EmbarquesMarcas;
use App\Models\Operation\EmbarquesMaquiladores;
use App\Models\Operation\Embarques;
use App\Models\Operation\EmbarquesProductos;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmbarquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empaques = Empaques::where('activo', 1)->get();
        $paises = Paises::where('activo', 1)->get();
        $users = User::role('tefs')->get();
        $categorias = Categorias::where('activo', 1)->get();
        $cultivos = TipoCultivos::where('activo', 1)->get();
        $calibres = Calibres::where('activo', 1)->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        return view('operation/embarques', compact('empaques', 'paises', 'users', 'categorias', 'cultivos', 'calibres', 'presentaciones'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marcas = json_decode($request->get('marcas'), true);
        $maquiladores = json_decode($request->get('maquiladores'), true);
        $productos = json_decode($request->get('productos'), true);

        $data = $request->only([
            'empaque_id',
            'destinatario_id',
            'pais_id',
            'puerto_id',
            'fecha_embarque',
            'numero_economico',
            'placas_trasporte',
            'inspector',
            'consolidado',
            'consolidado_id',
            'empresa_transporte',
            'chofer',
        ]);
        DB::beginTransaction();

        try {
            $embarque = Embarques::updateOrCreate(
                ['id' => $request->get('id_embarque')],
                $data
            );

            if (!empty($marcas)) {
                foreach ($marcas as $marca_arr) {
                    $marca = new EmbarquesMarcas();
                    $marca->embarque_id = $embarque->id;
                    $marca->marca_id = $marca_arr;
                    $marca->save();
                }
            }

            if (!empty($maquiladores)) {
                foreach ($maquiladores as $maquilador_arr) {
                    $maquilador = new EmbarquesMaquiladores();
                    $maquilador->embarque_id = $embarque->id;
                    $maquilador->maquilador_id = $maquilador_arr;
                    $maquilador->save();
                }
            }

            $insertData = [];
            if (!empty($productos)) {
                foreach ($productos as $product) {
                    $insertData[] = [
                        'embarque_id' => $embarque->id,
                        'categoria_id' => $product[5],
                        'tipo_cultivo_id' => $product[7],
                        'presentacion_id' => $product[9],
                        'calibre_id' => $product[11],
                        'folio_pallet' => $product[1],
                        'sader' => $product[3],
                        'cajas' => $product[12],
                        'lote' => $product[2],
                        'tipo_fruta' => $product[14],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                EmbarquesProductos::insert($insertData);
            }
            DB::commit();

            return response()->json(['success' => 'Datos guardados exitosamente!', 'embarque_id'=>$embarque->id]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al guardar los permisos.'], 500);
        }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_calibres(Request $request)
    {

    }

}
