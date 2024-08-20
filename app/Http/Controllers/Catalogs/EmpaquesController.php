<?php

namespace App\Http\Controllers\Catalogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Municipios;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;

use Intervention\Image\Image;
use Intervention\Image\Drivers\Gd\Driver;
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

            $empaques = Empaques::all();
            return Datatables::of($empaques)
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
                    ->addColumn('exportacion', function($row){
                        if($row->activo){
                           $btn = '<span class="badge badge-light-success">Activo</span>';
                        }
                        else{
                            $btn = '<span class="badge badge-light-danger">Desactivado</span>';
                        }
                        return $btn;
                    })
                    ->addIndexColumn()
                    ->addColumn('asociados', function($row){
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
                           $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-empaque-table-filter="edit">
                           <span class="svg-icon svg-icon-3">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                   <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                   <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                               </svg>
                           </span>
                       </button>';
                            return $btn;
                    })
                    ->rawColumns(['check', 'buttons', 'activos', 'exportacion', 'asociados'])
                    ->make(true);
        }

        $municipios = Municipios::all();
        return view('catalogs/empaques', array("municipios" => $municipios));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'localidad_id',
            'localidad_doc_id',
            'nombre_corto',
            'nombre_fiscal',
            'domicilio_fiscal',
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
            'activo'
        ]);

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

}
