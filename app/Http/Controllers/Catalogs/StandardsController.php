<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Standards;
use Yajra\DataTables\DataTables;

class StandardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $standards = Standards::all();
            return Datatables::of($standards)
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
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-standard-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                            <i class="ki-outline ki-pencil text-success fs-2">
                            </i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        return view('catalogs/standards');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Standards::updateOrCreate(
            ['id'=>$request->get('id_standard')],
            ['name' => $request->get('name'),
            'description' => $request->get('description'),
            'activo' => $request->input('activo')],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $standard = Standards::find($id);

        return response()->json(['standard'=>$standard]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_standards(Request $request)
    {
        $ids = $request->input('ids');
        standards::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

}
