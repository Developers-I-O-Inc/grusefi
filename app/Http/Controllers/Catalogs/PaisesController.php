<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input;


class PaisesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paises = Paises::all();
            return Datatables::of($paises)
                ->addIndexColumn()
                ->addColumn('check', function($row){
                    return view('components.checks_table', [
                        'id' => $row->id,
                        'disabled' => !auth()->user()->can("admin_paises"),
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
                        'disabled' => !auth()->user()->can("admin_paises"),
                        'catalog' => "pais"
                    ])->render();
                })
                ->rawColumns(['check', 'buttons', 'activos'])
                ->make(true);
        }

        return view('catalogs/paises');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Paises::updateOrCreate(
            ['id'=>$request->get('id_pais')],
            ['nombre' => $request->input('nombre'),
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
        $pais=Paises::find($id);

        return response()->json(['pais'=>$pais]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_paises(Request $request)
    {
        $ids = $request->get('ids');
        Paises::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>$ids]);
    }

}
