<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Localidades;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class LocalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $localidades = DB::select('SELECT cat_localidades.id, cat_localidades.nombre, cat_localidades.nombre_corto, cat_localidades.codigo, cat_estados.nombre AS estado,
                    cat_paises.nombre AS pais, cat_municipios.nombre AS municipio, cat_localidades.activo
                FROM cat_localidades LEFT JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
                LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
                LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
                WHERE cat_localidades.deleted_at is null');
                return Datatables::of($localidades)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        return view('components.checks_table', [
                            'id' => $row->id,
                            'disabled' => !auth()->user()->can("admin_localidades"),
                        ])->render();
                    })
                    ->addColumn('activos', function($row){
                        return $row->activo
                            ? '<span class="badge badge-light-success">Activo</span>'
                            : '<span class="badge badge-light-danger">Desactivado</span>';
                    })
                    ->addColumn('buttons', function($row){
                        return view('components.buttons_table', [
                            'id' => $row->id,
                            'disabled' => !auth()->user()->can("admin_localidades"),
                            'catalog' => "localidad"
                        ])->render();
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        $paises = Paises::where('activo', '=', 1)->get();

        return view('catalogs/localidades', array("paises" => $paises));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Localidades::updateOrCreate(
            ['id'=>$request->get('id_localidad')],
            ['municipio_id' => $request->input('municipio_id'),
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
        $localidad=DB::select('SELECT cat_localidades.id, municipio_id, estado_id, pais_id, cat_localidades.nombre, cat_localidades.nombre_corto, cat_localidades.codigo, cat_localidades.activo
        FROM cat_localidades LEFT JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
		LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
        LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
        WHERE cat_localidades.id = '.$id);

        return response()->json(['localidad'=>$localidad]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_localidades(Request $request)
    {
        $ids = $request->input('ids');
        Localidades::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_localidades(Request $request){
        $localidades = Localidades::where('municipio_id', '=', $request->query('id'))
            ->where('activo', 1)->get();
        return response()->json(["ok" => "OK", "catalogo" => $localidades]);
    }

}
