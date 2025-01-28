<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Estados;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class MunicipiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $municipios = DB::select('SELECT cat_municipios.id, cat_municipios.nombre, cat_municipios.nombre_corto, cat_municipios.codigo, cat_estados.nombre as estado,
                    cat_paises.nombre as pais, cat_municipios.activo
                FROM cat_municipios LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
                LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
                WHERE cat_municipios.deleted_at is null');
                return Datatables::of($municipios)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                            $btn = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" data-id="'.$row->id.'" />
                            </div>';
                            return $btn;
                    })
                    ->addColumn('activos', function($row){
                        return $row->activo
                            ? '<span class="badge badge-light-success">Activo</span>'
                            : '<span class="badge badge-light-danger">Desactivado</span>';
                    })
                    ->addColumn('buttons', function($row){
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-municipio-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                            <i class="ki-outline ki-pencil text-success fs-2">
                            </i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        $paises = Paises::where('activo', '=', 1)->get();

        return view('catalogs/municipios', array("paises" => $paises));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Municipios::updateOrCreate(
            ['id'=>$request->get('id_municipio')],
            ['estado_id' => $request->input('estado_id'),
            'nombre' => $request->input('nombre'),
            'nombre_corto' => $request->input('nombre_corto'),
            'activo' => $request->input('activo'),
            'codigo' => $request->input('codigo')],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $municipio=DB::select('SELECT cat_municipios.id, estado_id, pais_id, cat_municipios.nombre, cat_municipios.nombre_corto, cat_municipios.codigo, cat_municipios.activo
            FROM cat_municipios LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE cat_municipios.id = '.$id);

        return response()->json(['municipio'=>$municipio]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_municipios(Request $request)
    {
        $ids = $request->input('ids');
        Municipios::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_municipios(Request $request){
        $municipios = Municipios::where('estado_id', '=', $request->query('id'))
            ->where('activo', 1)->get();
        return response()->json(["ok" => "OK", "catalogo" => $municipios]);
    }

}
