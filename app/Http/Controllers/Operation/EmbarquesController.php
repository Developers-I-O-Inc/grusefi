<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Calibres;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use App\Models\User;

class EmbarquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empaques = Empaques::all();
        $paises = Paises::all();
        $users = User::role('tefs')->get();
        return view('operation/embarques', compact('empaques', 'paises', 'users'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        calibres::updateOrCreate(
            ['id'=>$request->get('id_calibre')],
            ['calibre' => $request->input('calibre'),
            'activo' => $request->input('activo')],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $calibre=Calibres::find($id);

        return response()->json(['calibre'=>$calibre]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_calibres(Request $request)
    {
        $ids = $request->input('ids');
        Calibres::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

}
