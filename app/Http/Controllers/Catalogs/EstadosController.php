<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Estados;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $estados = DB::select('SELECT cat_estados.id, cat_estados.nombre, cat_estados.nombre_corto, cat_estados.codigo, cat_paises.nombre as pais, cat_estados.activo
                FROM cat_estados LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
                WHERE cat_estados.deleted_at is null');
            return Datatables::of($estados)
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
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-estado-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="ki-outline ki-pencil text-success fs-2"></i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        $paises = Paises::where('activo', '=', 1)->get();

        return view('catalogs/estados', array("paises" => $paises));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Estados::updateOrCreate(
            ['id'=>$request->get('id_estado')],
            ['pais_id' => $request->input('pais_id'),
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
        $estado=Estados::find($id);

        return response()->json(['estado'=>$estado]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_estados(Request $request)
    {
        $ids = $request->input('ids');
        Estados::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_estados(Request $request){
        $estados = Estados::where('pais_id', '=', $request->query('id'))
            ->where('activo', 1)->get();
        return response()->json(["ok" => "OK", "catalogo" => $estados]);
    }

}
