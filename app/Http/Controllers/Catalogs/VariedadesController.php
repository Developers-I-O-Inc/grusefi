<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\TipoCultivos;
use App\Models\Catalogs\Variedades;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class VariedadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $variedades = Variedades::get_variedades();
            return Datatables::of($variedades)
                ->addIndexColumn()
                ->addColumn('check', function($row){
                        $btn = '<div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" data-id="'.$row->id.'" />
                    </div>';
                        return $btn;
                })
                ->addColumn('activos', function($row){
                    if($row->activo){
                        $btn = '<span class="badge badge-light-success">Activo</span>';
                    }
                    else{
                        $btn = '<span class="badge badge-light-danger">Desactivado</span>';
                    }
                    return $btn;
                })
                ->addColumn('buttons', function($row){
                    $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-variedades-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                          <i class="ki-outline ki-pencil text-success fs-2"></i>
                    </button>';
                    return $btn;
                })
                ->rawColumns(['check', 'buttons', 'activos'])
                ->make(true);
        }

        $tipo_cultivos = TipoCultivos::where('activo', 1)->get();

        return view('catalogs/variedades', array("tipo_cultivos" => $tipo_cultivos));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Variedades::updateOrCreate(
            ['id'=>$request->get('id_variedad')],
            ['tipo_cultivo_id' => $request->input('tipo_cultivo_id'),
            'variedad' => $request->input('variedad'),
            'nombre_cientifico' => $request->input('nombre_cientifico'),
            'activo' => $request->input('activo'),]
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variedad=Variedades::find($id);

        return response()->json(['variedad'=>$variedad]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_variedades(Request $request)
    {
        $ids = $request->input('ids');
        Variedades::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_variedad(Request $request){
        $variedades = Variedades::where('tipo_cultivo_id', '=', $request->query('id'))->get();
        return response()->json(["ok" => "OK", "catalogo" => $variedades]);
    }

}
