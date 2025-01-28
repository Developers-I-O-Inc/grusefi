<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Presentaciones;
use App\Models\Catalogs\Variedades;
use Yajra\DataTables\DataTables;

class PresentacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $presentaciones = Presentaciones::all();
            return Datatables::of($presentaciones)
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
                    ->addColumn('buttons', function($row){
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-presentacion-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="ki-outline ki-pencil text-success fs-2"></i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }
        $variedades = Variedades::where('activo', 1)->get();
        return view('catalogs/presentaciones', compact('variedades'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Presentaciones::updateOrCreate(
            ['id'=>$request->get('id_presentacion')],
            [
                'presentacion' => $request->input('presentacion'),
                'plural' => $request->input('plural'),
                'activo' => $request->input('activo')
            ],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presentacion=Presentaciones::find($id);

        return response()->json(['presentacion'=>$presentacion]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_presentaciones(Request $request)
    {
        $ids = $request->input('ids');
        Presentaciones::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_presentaciones()
    {
        $presentacion = Presentaciones::where('activo', 1)->get();
        return response()->json(["ok" => "OK", "catalogo" => $presentacion]);
    }

}
