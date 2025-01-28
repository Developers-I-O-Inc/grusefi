<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Paises;
use Illuminate\Http\Request;
use App\Models\Catalogs\Puertos;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PuertosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $puertos = DB::select('SELECT cat_puertos.id, cat_paises.nombre as pais, cat_estados.nombre as estado, cat_municipios.nombre as municipio,
                puerto, cat_puertos.nombre_corto, medio_transporte, cat_puertos.activo, placas
                FROM cat_puertos LEFT JOIN cat_municipios ON cat_puertos.municipio_id = cat_municipios.id
                LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
                LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
                WHERE cat_puertos.deleted_at IS NULL');
            return Datatables::of($puertos)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                           $btn = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                           <input class="form-check-input" type="checkbox" value="1" data-id="'.$row->id.'" />
                       </div>';
                            return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('activos', function($row){
                        if($row->activo){
                           $btn = '<span class="badge badge-light-success">Activo</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">Desactivado</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('placas', function($row){
                        if($row->placas){
                           $btn = '<span class="badge badge-light-success">SI</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">NO</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('buttons', function($row){
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-puerto-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="ki-outline ki-pencil text-success fs-2"></i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos', 'placas'])
                    ->make(true);
        }

        $paises = Paises::all();

        return view('catalogs/puertos', array("paises" => $paises));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Puertos::updateOrCreate(
            ['id'=>$request->get('id_puerto')],
            ['puerto' => $request->input('puerto'),
            'municipio_id' => $request->input('municipio_id'),
            'nombre_corto' => $request->input('nombre_corto'),
            'pais_id' => $request->input('pais_id'),
            'medio_transporte' => $request->input('medio_transporte'),
            'placas' => $request->input('placas'),
            'activo' => $request->input('activo')],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $puerto=DB::select('SELECT cat_puertos.id, cat_municipios.id as municipio_id, cat_estados.id as estado_id, cat_paises.id as pais_id,
            cat_paises.nombre as pais, cat_estados.nombre as estado, cat_municipios.nombre as municipio,
            puerto, cat_puertos.nombre_corto, medio_transporte, cat_puertos.activo, placas
            FROM cat_puertos LEFT JOIN cat_municipios ON cat_puertos.municipio_id = cat_municipios.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE cat_puertos.deleted_at IS NULL AND cat_puertos.id ='.$id);

        return response()->json(['puerto'=>$puerto]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_puertos(Request $request)
    {
        $ids = $request->input('ids');
        Puertos::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_puertos(Request $request){
        $puertos = DB::select("SELECT cat_puertos.id, cat_puertos.puerto as nombre
            FROM cat_puertos
            LEFT JOIN cat_municipios ON cat_puertos.municipio_id = cat_municipios.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE cat_paises.id =".$request->query('id'));
        return response()->json(["ok" => "OK", "catalogo" => $puertos]);
    }

}
