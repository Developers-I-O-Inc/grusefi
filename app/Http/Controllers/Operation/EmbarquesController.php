<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\Paises;
use App\Models\Catalogs\Presentaciones;
use App\Models\Catalogs\Standards;
use App\Models\Catalogs\Usos;
use App\Models\Catalogs\Variedades;
use App\Models\Catalogs\Vigencias;
use App\Models\Operation\Embarques;
use App\Models\Operation\EmbarquesRPV;
use App\Models\Operation\EmbarquesProductos;
use App\Models\Operation\PlantillaRPV;
use App\Models\Admin\UsersStandards;
use App\Models\Operation\EmbarquesStandards;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EmbarquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vigencias = Vigencias::where('activo', 1)->get();
        if($vigencias->count() == 0){
            return redirect()->route('vigencias.index')->with('error_vigencia', 'No hay vigencias activas, por favor activa una vigencia para poder continuar.');
        }
        if(Auth::user()->hasRole('tefs')){
            $empaques = Empaques::get_empaques_by_country();
            $lugares = Municipios::municipios_by_user(Auth::user()->id);
            $standards = UsersStandards::user_standards_select(Auth::user()->id);
            $count_standards = UsersStandards::where('user_id', Auth::user()->id);
            if($count_standards->count() == 0){
                return redirect()->route('dashboard')->with('error_standards', 'No tienes normas asignadas, por favor asigna normas para poder continuar.');
            }
        }
        else{
            $empaques = Empaques::where('activo', 1)->get();
            $lugares = Municipios::where('activo', 1)->get();
            $standards = Standards::where('activo', 1)->get();
        }
        $paises = Paises::where('activo', 1)->get();
        $users = User::role('tefs')->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        $variedades = Variedades::where('activo', 1)->get();
        $municipios = Municipios::where('activo', 1)->get();
        $vigencia = Vigencias::select('id')->where('activo', 1)->first();
        $usos = Usos::where('activo', 1)->get();
        return view('operation/embarques', compact('empaques', 'paises', 'users', 'presentaciones', 'variedades', 'vigencia', 'municipios', 'usos', 'lugares', 'standards'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $standards = json_decode($request->get('standards'), true);
        $maquiladores = json_decode($request->get('maquiladores'), true);
        $productos = json_decode($request->get('productos'), true);

        $data = $request->only([
            'empaque_id',
            'destinatario_id',
            'vigencia_id',
            'pais_id',
            'municipio_id',
            'lugar_id',
            'puerto_id',
            'numero_economico',
            'placas_trasporte',
            'inspector',
            'consolidado',
            'consolidado_id',
            'empresa_transporte',
            'chofer',
            'uso_id'
        ]);

        // TEFS OR ADMIN
        if (auth()->user()->hasRole('tefs')) {
            $data['tefs_id'] = auth()->user()->id;
        } else {
            $data['tefs_id'] = $request->get('tefs_id');
        }
        // DB::beginTransaction();

        // try {
            $embarque = Embarques::updateOrCreate(
                ['id' => $request->get('id_embarque')],
                $data
            );
            $embarque_new = $embarque->id;
            // add embarque_rpv
            $plantilla = PlantillaRPV::where('pais_id', $embarque->pais_id)
            ->where('municipio_id', $embarque->municipio_id)
            ->first();

                if ($plantilla) {
                    $embarqueRPVData = $plantilla->toArray();

                    // Eliminamos los campos que no necesitamos
                    unset(
                        $embarqueRPVData['id'],
                        $embarqueRPVData['pais_id'],
                        $embarqueRPVData['municipio_id'],
                        $embarqueRPVData['created_at'],
                        $embarqueRPVData['updated_at'],
                        $embarqueRPVData['deleted_at'],
                        $embarqueRPVData['clave_aprobacion'],
                        $embarqueRPVData['vigencia']
                    );

                    $embarqueRPVData['embarque_id'] = $embarque_new;
                    $embarqueRPVData['created_at'] = now();
                    $embarqueRPVData['updated_at'] = now();

                    EmbarquesRPV::insert($embarqueRPVData);
                }
            //--------------------------------
            if (!empty($standards)) {
                foreach ($standards as $standards_arr) {
                    $standard = new EmbarquesStandards();
                    $standard->embarque_id = $embarque->id;
                    $standard->standard_id = $standards_arr;
                    $standard->save();
                }
            }

            // if (!empty($maquiladores)) {
            //     foreach ($maquiladores as $maquilador_arr) {
            //         $maquilador = new EmbarquesMaquiladores();
            //         $maquilador->embarque_id = $embarque->id;
            //         $maquilador->maquilador_id = $maquilador_arr;
            //         $maquilador->save();
            //     }
            // }

            $insertData = [];
            if (!empty($productos)) {
                foreach ($productos as $product) {
                    $insertData[] = [
                        'embarque_id' => $embarque->id,
                        'folio_pallet' => $product[1],
                        'lote' => $product[2],
                        'sader' => $product[3],
                        'cartilla' => $product[4],
                        'variedad_id' => $product[5],
                        'presentacion_id' => $product[7],
                        'cantidad' => $product[9],
                        'peso' => $product[10],
                        'marca_id' => $product[12],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                EmbarquesProductos::insert($insertData);
            }
            // if ($request->hasFile('file_import')) {
            //     Excel::import(new ProductsImport, $request->file('file_import'));
            // }

            // return response()->json(['success' => $request->file('file_import')]);
            // DB::commit();

            return response()->json(['success' => 'Datos guardados exitosamente!', 'embarque_id'=>$embarque->id]);
        // }
        // catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json(['error' => 'Error al guardar los permisos.'], 500);
        // }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */

    public function embarques_admin(Request $request){
        if ($request->ajax()) {
            $dates = $request->input('dates');
            $start_date = substr($dates, 0, 10);
            $end_date = substr($dates, 13, 10);
            $apply_filter = $request->input('filter', false);

            if(!$apply_filter || $start_date == '' or $end_date ==''){
                $embarques = Embarques::get_embarques_admin(auth()->user()->hasRole('tefs'));
            }
            else {
                $embarques = Embarques::get_embarques_admin_by_dates($start_date, $end_date, auth()->user()->hasRole('tefs'));
            }

            return Datatables::of($embarques) ->addIndexColumn()
            ->addColumn('buttons', function($row){
                $btn = "";
                if($row->status != "Finalizado"){
                    $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-admin-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                        <i class="ki-outline ki-pencil text-success fs-2"></i>
                    </button>
                    <a href="/operation/imprimir_dictamen_embarque_rpv/'.$row->id.'" target="_blank" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Imprimir">
                        <i class="ki-outline ki-printer text-success fs-2"></i>
                    </a>';
                }

                else{
                    $btn = '<a href="/operation/imprimir_dictamen_embarque_rpv/'.$row->id.'" target="_blank" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Imprimir">
                        <i class="ki-outline ki-printer text-success fs-2"></i>
                    </a>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-admin-table-filter="upload" data-bs-toggle="tooltip" title="Subir evidencia">
                       <i class="ki-outline ki-file-up text-success fs-2"></i>
                    </button>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['buttons'])
            ->make(true);

        }
        $vigencias = Vigencias::where('activo', 1)->get();
        if(auth()->user()->hasRole('tefs')){
            $standards = UsersStandards::user_standards_select(auth()->user()->id);
            $count_standards = UsersStandards::where('user_id', Auth::user()->id);
            if($count_standards->count() == 0){
                return redirect()->route('dashboard')->with('error_standards', 'No tienes normas asignadas, por favor asigna normas para poder continuar.');
            }
        }
        else{
            $standards = Standards::where('activo', 1)->get();
        }
        $variedades = Variedades::where('activo', 1)->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        return view("operation/embarques_admin", compact('vigencias', 'standards', 'variedades', 'presentaciones'));
    }

    public function get_embarque_edit($embarque_id)
    {
        $embarque = Embarques::get_embarque($embarque_id);
        $plantilla = EmbarquesRPV::where('embarque_id', $embarque_id)->first();
        // $embarques_standards = EmbarquesStandards::get_marcas_embarque($embarque_id);
        return response()->json(["plantilla" =>$plantilla, "embarque"=>$embarque]);
    }


    public function get_standards_embarque($embarque_id)
    {
        $embarque_standards = EmbarquesStandards::get_standards_embarque($embarque_id);
        return response()->json($embarque_standards);
    }

    public function get_products_embarque($embarque_id)
    {
        $embarque_productos = EmbarquesProductos::get_embarque_products($embarque_id);
        return response()->json($embarque_productos);
    }

    public function save_products_embarque(Request $request){

        $producto = new EmbarquesProductos();
        $producto->embarque_id = $request->get('embarque_id');
        $producto->folio_pallet = $request->get('folio_pallet');
        $producto->lote = $request->get('lote');
        $producto->cantidad = $request->get('cantidad');
        $producto->peso = $request->get('peso');
        $producto->sader = $request->get('sader');
        $producto->cartilla = $request->get('cartilla');
        $producto->presentacion_id = $request->input('presentacion_id');
        $producto->variedad_id = $request->input('variedad_product_id');
        $producto->marca_id = $request->input('select_marca');
        $producto->save();

        return response()->json(["OK"=>"Se guardo correctamente", "id"=>$producto->id]);

    }

    public function save_standards_embarques(Request $request)
    {
        $embarque_id = $request->get('embarque_id');
        $standards = $request->get('standards');

        EmbarquesStandards::where('embarque_id', $embarque_id)->delete();

        foreach ($standards as $marca) {
            EmbarquesStandards::create([
                'embarque_id' => $embarque_id,
                'standard_id' => $marca['standard_id'],
            ]);
        }

        return response()->json(['success' => 'Marcas guardadas exitosamente!']);


    }

    public function save_embarque_rpv(Request $request)
    {
        $datos = $request->json()->all();
        $embarque = Embarques::find($request->embarque_id);
        $embarque->folio_embarque = $request->folio_embarque;
        $embarque->status = "Modificado";
        $embarque->save();
        $registro = EmbarquesRPV::where('embarque_id', $request->embarque_id)->first();
        unset($datos['folio_embarque']);
        unset($datos['clave_aprobacion']);
        unset($datos['vigencia']);
        foreach ($datos as $campo => $valor) {
            $registro->$campo = $valor;
        }

        $registro->save();

        return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);
    }

    public function finish_embarque_rpv(Request $request)
    {
        $datos = $request->json()->all();
        // VALIDATE STANDARDS, PRODUCTOS AND
        $normas = EmbarquesStandards::where('embarque_id', $request->embarque_id)->count();
        $productos = EmbarquesProductos::where('embarque_id', $request->embarque_id)->count();
        if($normas == 0 || $productos == 0){
            return response()->json(['error' => 'No hay productos en este embarque'], 403);
        }
        // $vigencias = Vigencias::where('activo', 1)->get();
        $embarque = Embarques::find($request->embarque_id);
        // GET COUNTRY ID BY EMBPAQUE
        $country_id = Empaques::select('cat_estados.codigo', 'cat_estados.id')
            ->join('cat_localidades', 'cat_empaques.localidad_id', 'cat_localidades.id')
            ->join('cat_municipios', 'cat_localidades.municipio_id', 'cat_municipios.id')
            ->join('cat_estados', 'cat_municipios.estado_id', 'cat_estados.id')->where('cat_empaques.id', $embarque->empaque_id)->first();
        // -----------------------------
        // CONSECUTIVE
        $consecutivo = Embarques::count_consecutivo_year($embarque->tefs_id, $country_id->id);
        $num_consecutivo = $consecutivo[0]->total;
        if (strlen((string)$num_consecutivo) > 4) {
            $cadena_consecutivo = (string)$num_consecutivo;
        }
        else{
            if($num_consecutivo == 0){
                $cadena_consecutivo = '0001';
            }
            else
                $cadena_consecutivo = str_pad($num_consecutivo + 1, 4, '0', STR_PAD_LEFT);
        }
        // -----------------------------
        $embarque->folio_embarque = 'VMRE-'.auth()->user()->employee_number.'-'.$country_id->codigo.'-'.$cadena_consecutivo.'-'.substr(date('Y'), 2, 2);
        $embarque->status = "Finalizado";
        $embarque->fecha_termino = now();
        $embarque->save();
        $registro = EmbarquesRPV::where('embarque_id', $request->embarque_id)->first();
        unset($datos['folio_embarque']);
        unset($datos['clave_aprobacion']);
        unset($datos['vigencia']);
        foreach ($datos as $campo => $valor) {
            $registro->$campo = $valor;
        }

        $registro->save();

        return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);
    }

    public function import_products(Request $request)
    {
        try {
            if ($request->hasFile('file_import')) {
                Excel::import(new ProductsImport, $request->file('file_import'));
                return redirect()->back()->with('success', 'Datos importados correctamente');
            }
            return redirect()->back()->with('error', 'No se proporcionó un archivo para importar.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "Fila {$failure->row()}: " . implode(', ', $failure->errors());
            }
            return redirect()->back()->with('error', 'Error al importar los datos.')->with('details', $errorMessages);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }

    public function delete_product_embarque($product_id)
    {
        EmbarquesProductos::find($product_id)->delete();
        return response()->json(['success' => 'Producto eliminado correctamente']);
    }

}
