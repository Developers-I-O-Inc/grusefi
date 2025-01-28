<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Destinatarios;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Paises;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DestinatariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $Destinatarios = Destinatarios::get_destinatarios_empaque();
            return Datatables::of($Destinatarios)
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
                    ->addColumn('exportacion', function($row){
                        if($row->activo){
                           $btn = '<span class="badge badge-light-success">Activo</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">Desactivado</span>';
                        }
                        return $btn;
                    })
                    ->addColumn('asociados', function($row){
                        if($row->activo){
                           $btn = '<span class="badge badge-light-success">Activo</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">Desactivado</span>';
                        }
                        return $btn;
                    })
                    ->addColumn('buttons', function($row){
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-destinatario-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                              <i class="ki-outline ki-pencil text-success fs-2"></i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos', 'exportacion', 'asociados'])
                    ->make(true);
        }

        $empaques = Empaques::all();
        $paises = Paises::where('activo', 1)->get();
        return view('catalogs/destinatarios', compact('empaques', 'paises'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'empaque_id',
            'nombre',
            'nombre_corto',
            'domicilio',
            'colonia',
            'num_ext',
            'num_int',
            'cp',
            'municipio_id',
            'telefonos',
            'correos',
            'activo'
        ]);
        $data['localidad_id'] = $request->input('localidad_id') ? $request->input("localidad_id") : null;

        Destinatarios::updateOrCreate(
            ['id' => $request->get('id_destinatario')],
            $data
        );

        return response()->json(['success' => 'Datos guardados exitosamente!']);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $destinatario=Destinatarios::get_destinatario($id);

        return response()->json(['destinatario'=>$destinatario]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_Destinatarios(Request $request)
    {
        $ids = $request->input('ids');
        Destinatarios::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_destinatarios(Request $request){
        $puertos = DB::select("SELECT cat_destinatarios.id, nombre
            FROM cat_destinatarios
            LEFT JOIN cat_empaques ON cat_destinatarios.empaque_id = cat_empaques.id
            WHERE empaque_id =".$request->query('id'));
        return response()->json(["ok" => "OK", "catalogo" => $puertos]);
    }

}
