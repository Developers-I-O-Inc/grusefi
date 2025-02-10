<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Municipios;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
// use Image;

class EmpaquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $empaques = Empaques::get_empaques();
            return Datatables::of($empaques)
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
                        $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-empaque-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                            <i class="ki-outline ki-pencil text-success fs-2">
                            </i>
                        </button>';
                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos', 'exportacion', 'asociados'])
                    ->make(true);
        }

        $municipios = Municipios::get_municipios();
        return view('catalogs/empaques', array("municipios" => $municipios));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'municipio_id',
            'nombre_corto',
            'nombre_fiscal',
            'domicilio_fiscal',
            'colonia',
            'num_ext',
            'num_int',
            'cp',
            'rfc',
            'telefonos',
            'nombre_embarque',
            'domicilio_documentacion',
            'codigo',
            'sader',
            'exportacion',
            'asociado',
            'activo',
            'tipo'
        ]);
        $data['localidad_id'] = $request->input('localidad_id') ? $request->input("localidad_id") : null;
        $data['localidad_doc_id'] = $request->input('localidad_doc_id') ? $request->input("localidad_doc_id") : null;
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $image = ImageManager::imagick()->read($request->file('imagen'));
            $image->resize(300, 200);
            $imageString = (string) $image->encode();
            $ruta = "public/img/empaques/".$request->get('nombre_fiscal').".".$request->file('imagen')->getClientOriginalExtension();
            Storage::disk('local')->put($ruta, $imageString);
            $data['imagen'] = $ruta;
        }

        Empaques::updateOrCreate(
            ['id' => $request->get('id_empaque')],
            $data
        );

        return response()->json(['success' => 'Datos guardados exitosamente!']);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empaque=Empaques::get_empaques_localidad($id);

        return response()->json(['empaque'=>$empaque]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_empaques(Request $request)
    {
        $ids = $request->input('ids');
        Empaques::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_maquiladores(Request $request){
        $empaques = DB::select("SELECT id, nombre_fiscal as nombre FROM cat_empaques where id <>". $request->query('id'));
        return response()->json(["ok" => "OK", "catalogo" => $empaques]);
    }

}
