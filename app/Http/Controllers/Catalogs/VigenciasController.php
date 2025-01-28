<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Vigencias;
use Yajra\DataTables\DataTables;

class VigenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $vigencias = Vigencias::all();
            return Datatables::of($vigencias)
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
                           $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-vigencia-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                                 <i class="ki-outline ki-pencil text-success fs-2"></i>
                       </button>';
                            return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        return view('catalogs/vigencias');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vigencia = Vigencias::updateOrCreate(
            ['id'=>$request->get('id_vigencia')],
            ['vigencia' => $request->input('vigencia'),
            'clave_aprobacion'=> $request->input('clave_aprobacion'),
            'activo' => $request->input('activo')],
        );
        Vigencias::where('id', '<>', $vigencia->id)->update([
            'activo'=> 0
        ]);
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vigencia=Vigencias::find($id);

        return response()->json(['vigencia'=>$vigencia]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_Vigencias(Request $request)
    {
        $ids = $request->input('ids');
        Vigencias::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

}
