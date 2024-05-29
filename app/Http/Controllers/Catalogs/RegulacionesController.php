<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Regulaciones;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class RegulacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $regulaciones = DB::select('SELECT cat_regulaciones.id, pais_id, nombre_corto as abreviacion, dictamen_apartado_4, dictamen_apartado_5, dictamen_apartado_11, nombre_pais_dictamen,
                    nombre_pais_certificado, activo_embarques, rq_inspector, rq_huertas, rq_estudios_analisis, rq_impresion, cat_regulaciones.activo, nombre as pais
                    FROM cat_regulaciones LEFT JOIN cat_paises ON cat_regulaciones.pais_id = cat_paises.id where cat_regulaciones.deleted_at IS NULL');
            return Datatables::of($regulaciones)
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
                    ->addColumn('embarques', function($row){
                        if($row->activo_embarques){
                           $btn = '<span class="badge badge-light-success">Si</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">No</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('inspector', function($row){
                        if($row->rq_inspector){
                           $btn = '<span class="badge badge-light-success">Si</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">No</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('huertas', function($row){
                        if($row->rq_huertas){
                           $btn = '<span class="badge badge-light-success">Si</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">No</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('analisis', function($row){
                        if($row->rq_estudios_analisis){
                           $btn = '<span class="badge badge-light-success">Si</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">No</span>';
                        }
                        return $btn;
                    })
                    ->addColumn('impresion', function($row){
                        if($row->rq_impresion){
                           $btn = '<span class="badge badge-light-success">Si</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">No</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('buttons', function($row){
                           $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-regulacion-table-filter="edit">
                           <span class="svg-icon svg-icon-3">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                   <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                   <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                               </svg>
                           </span>
                       </button>';
                            return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos', 'embarques', 'inspector', 'huertas', 'analisis', 'impresion'])
                    ->make(true);
        }

        $paises = Paises::all();

        return view('catalogs/Regulaciones', array("paises" => $paises));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Regulaciones::updateOrCreate(
            ['id'=>$request->get('id_regulacion')],
            ['pais_id' => $request->input('pais_id'),
            'abreviacion' => $request->input('abreviacion'),
            'dictamen_apartado_4' => $request->input('dictamen_apartado_4'),
            'dictamen_apartado_5' => $request->input('dictamen_apartado_5'),
            'dictamen_apartado_11' => $request->input('dictamen_apartado_11'),
            'nombre_pais_dictamen' => $request->input('nombre_pais_dictamen'),
            'nombre_pais_certificado' => $request->input('nombre_pais_certificado'),
            'activo_embarques' => $request->input('activo_embarques'),
            'rq_inspector' => $request->input('rq_inspector'),
            'rq_huertas' => $request->input('rq_huertas'),
            'rq_estudios_analisis' => $request->input('rq_estudios_analisis'),
            'rq_impresion' => $request->input('rq_impresion'),
            'activo' => $request->input('activo')],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $regulacion = DB::select('SELECT cat_regulaciones.id, pais_id, nombre_corto as abreviacion, dictamen_apartado_4, dictamen_apartado_5, dictamen_apartado_11, nombre_pais_dictamen,
                    nombre_pais_certificado, activo_embarques, rq_inspector, rq_huertas, rq_estudios_analisis, rq_impresion, cat_regulaciones.activo, nombre as pais
                    FROM cat_regulaciones LEFT JOIN cat_paises ON cat_regulaciones.pais_id = cat_paises.id where cat_regulaciones.deleted_at IS NULL AND cat_regulaciones.id = '.$id);

        return response()->json(['regulacion'=>$regulacion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_regulaciones(Request $request)
    {
        $ids = $request->input('ids');
        Regulaciones::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

}
