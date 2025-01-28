<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Marcas;
use App\Models\Catalogs\Empaques;
use Yajra\DataTables\DataTables;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $marcas = Marcas::get_marcas_empaque();
            return Datatables::of($marcas)
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
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-marca-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="ki-outline ki-pencil text-success fs-2"></i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos'])
                    ->make(true);
        }

        $empaques = Empaques::all();

        return view('catalogs/marcas', compact('empaques'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'empaque_id',
            'nombre',
            'activo'
        ]);

        Marcas::updateOrCreate(
            ['id' => $request->get('id_marca')],
            $data
        );

        return response()->json(['success' => 'Datos guardados exitosamente!']);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marca=Marcas::find($id);

        return response()->json(['marca'=>$marca]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_marcas(Request $request)
    {
        $ids = $request->input('ids');
        Marcas::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_marcas(Request $request){
        $marcas = Marcas::where("empaque_id", $request->query('id'))->get();
        return response()->json(["ok" => "OK", "catalogo" => $marcas]);
    }


}
