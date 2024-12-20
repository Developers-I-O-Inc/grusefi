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
                           $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-puerto-table-filter="edit">
                           <span class="svg-icon svg-icon-3">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                   <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                   <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                               </svg>
                           </span>
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
