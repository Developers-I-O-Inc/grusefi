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
use App\Models\Catalogs\Marcas;
use App\Models\Catalogs\Puertos;
use App\Models\Operation\EmbarquesStandards;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use DB;

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
        if(Auth::user()->hasRole('Super Admin')){
            $empaques = Empaques::where('activo', 1)->get();
            $lugares = Municipios::where('activo', 1)->get();
            $standards = Standards::where('activo', 1)->get();
        }
        else{
            $empaques = Empaques::get_empaques_by_country();
            $lugares = Municipios::municipios_by_user(Auth::user()->id);
            $standards = UsersStandards::user_standards_select(Auth::user()->id);
            $count_standards = UsersStandards::where('user_id', Auth::user()->id);
            if($count_standards->count() == 0){
                return redirect()->route('dashboard')->with('error_standards', 'No tienes normas asignadas, por favor asigna normas para poder continuar.');
            }
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
        $productos = json_decode($request->get('productos'), true);

        $data = $request->only([
            'empaque_id',
            'destinatario_id',
            'vigencia_id',
            'pais_id',
            'municipio_id',
            'lugar_id',
            'puerto_id',
            'origen',
            'numero_economico',
            'placas_transporte',
            'inspector',
            'consolidado',
            'consolidado_id',
            'empresa_transporte',
            'chofer',
            'uso_id'
        ]);

        // TEFS OR ADMIN
        if (auth()->user()->hasRole('Super Admin')) {
            $data['tefs_id'] = $request->get('tefs_id');
        } else {
            $data['tefs_id'] = auth()->user()->id;
        }

        DB::beginTransaction();

        try {
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
                    $standard->standard_id = $standards_arr['id'];
                    $standard->observations = $standards_arr['observation'];
                    $standard->save();
                }
            }

            $insertData = [];
            if (!empty($productos)) {
                foreach ($productos as $product) {
                    $insertData[] = [
                        'embarque_id' => $embarque->id,
                        'lote' => $product[9],
                        'sader' => $product[10],
                        'cartilla' => $product[11],
                        'variedad_id' => $product[1],
                        'presentacion_id' => $product[3],
                        'cantidad' => $product[6],
                        'peso' => $product[7],
                        'marca_id' => $product[8],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                EmbarquesProductos::insert($insertData);
            }
            DB::commit();

            return response()->json(['success' => 'Datos guardados exitosamente!', 'embarque_id'=>$embarque->id]);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al guardar los permisos.'], 500);
        }

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
                $embarques = Embarques::get_embarques_admin(auth()->user()->hasRole('Super Admin'));
            }
            else {
                $embarques = Embarques::get_embarques_admin_by_dates($start_date, $end_date, auth()->user()->hasRole('Super Admin'));
            }

            return Datatables::of($embarques) ->addIndexColumn()
            ->addColumn('status', function($row){
                $btn = "";
                if($row->status == "Finalizado"){
                    $btn = '<span class="badge badge-light-success">Finalizado</span>';
                }

                else if($row->status == "Modificado"){
                    $btn = '<span class="badge badge-light-warning">Modificado</span>';
                }

                else if($row->status == "Cancelado"){
                    $btn = '<span class="badge badge-light-danger">Cancelado</span>';
                }

                else{
                    $btn = '<span class="badge badge-light-primary">Pendiente</span>';
                }

                return $btn;
            })
            ->addColumn('buttons', function($row){
                $btn = "";
                if($row->status != "Finalizado" && $row->status != "Cancelado"){
                    $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-admin-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                        <i class="ki-outline ki-pencil text-success fs-2"></i>
                    </button>
                    <a href="/operation/imprimir_dictamen_embarque_rpv/'.$row->id.'" target="_blank" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Imprimir">
                        <i class="ki-outline ki-printer text-success fs-2"></i>
                    </a>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Cancelar" data-kt-admin-table-filter="delete">
                        <i class="ki-outline ki-tablet-delete text-danger fs-2"></i>
                    </button>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm copy-dv" data-bs-toggle="tooltip" title="Copiar DV" data-kt-admin-table-filter="copy">
                        <i class="ki-outline ki-copy text-primary fs-2"></i>
                    </button>';
                }

                else if($row->status == "Finalizado"){
                    $btn = '<a href="/operation/imprimir_dictamen_embarque_rpv/'.$row->id.'" target="_blank" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Imprimir">
                        <i class="ki-outline ki-printer text-success fs-2"></i>
                    </a>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-kt-admin-table-filter="upload" data-bs-toggle="tooltip" title="Subir evidencia">
                       <i class="ki-outline ki-file-up text-success fs-2"></i>
                    </button>
                     <button data-id="'.$row->id.'" type="_button" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Cancelar" data-kt-admin-table-filter="delete">
                        <i class="ki-outline ki-tablet-delete text-danger fs-2"></i>
                    </button>
                     <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm" data-bs-toggle="tooltip" title="Copiar DV" data-kt-admin-table-filter="copy">
                        <i class="ki-outline ki-copy text-primary fs-2"></i>
                    </button>
                    ';
                }
                else{

                }
                return $btn;
            })
            ->rawColumns(['buttons', 'status'])
            ->make(true);

        }
        $vigencias = Vigencias::where('activo', 1)->get();
        if(auth()->user()->hasRole('Super Admin')){
            $standards = Standards::where('activo', 1)->get();
            $lugares = Municipios::where('activo', 1)->get();
            $empaques = Empaques::where('activo', 1)->get();
        }
        else{
            $municipios = Municipios::get_municipios_template_by_user(Auth::user()->id);
            $standards = UsersStandards::user_standards_select(auth()->user()->id);
            $count_standards = UsersStandards::where('user_id', Auth::user()->id);
            $lugares = Municipios::municipios_by_user(Auth::user()->id);
            if($count_standards->count() == 0){
                return redirect()->route('dashboard')->with('error_standards', 'No tienes normas asignadas, por favor asigna normas para poder continuar.');
            }
        }
        $variedades = Variedades::where('activo', 1)->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        $puertos = Puertos::where('activo', 1)->get();
        $usos = Usos::where('activo', 1)->get();
        return view("operation/embarques_admin", compact('vigencias', 'standards', 'variedades', 'presentaciones', 'puertos', 'lugares', 'empaques', 'usos'));
    }

    public function get_embarque_edit($embarque_id)
    {
        $embarque = Embarques::get_embarque($embarque_id);
        $plantilla = EmbarquesRPV::where('embarque_id', $embarque_id)->first();
        $marcas = Marcas::where('activo', 1)->where('empaque_id', $embarque->empaque_id)->get();
        return response()->json(["plantilla" =>$plantilla, "embarque"=>$embarque, "marcas"=>$marcas]);
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
                'observations' => $marca['observations'],
            ]);
        }

        return response()->json(['success' => 'Marcas guardadas exitosamente!']);


    }

    public function save_embarque_rpv(Request $request)
    {
        $datos = $request->json()->all();
        $embarque = Embarques::find($request->embarque_id);
        $embarque->created_at = $request->fecha_embarque_new . ' ' . $request->hora_embarque_new;
        $embarque->folio_embarque = $request->folio_embarque;
        $embarque->lugar_id = $request->lugar_id;
        $embarque->empaque_id = $request->empaque_id;
        $embarque->destinatario_id = $request->destinatario_id;
        $embarque->uso_id = $request->uso_id;
        $embarque->origen = $request->origen;
        $embarque->numero_economico = $request->numero_economico;
        $embarque->placas_transporte = $request->placas_transporte;
        $embarque->puerto_id = $request->puerto_id;
        $embarque->status = "Modificado";
        $embarque->save();
        $registro = EmbarquesRPV::where('embarque_id', $request->embarque_id)->first();
        unset($datos['folio_embarque']);
        unset($datos['clave_aprobacion']);
        unset($datos['vigencia']);
        unset($datos['vigencia_id']);
        unset($datos['lugar_id']);
        unset($datos['empaque_id']);
        unset($datos['destinatario_id']);
        unset($datos['uso_id']);
        unset($datos['origen']);
        unset($datos['numero_economico']);
        unset($datos['puerto_id']);
        unset($datos['placas_transporte']);
        unset($datos['fecha_embarque_new']);
        unset($datos['hora_embarque_new']);
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
            ->join('cat_municipios', 'cat_empaques.municipio_id', 'cat_municipios.id')
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
        $embarque->created_at = $request->fecha_embarque_new . ' ' . $request->hora_embarque_new;
        $embarque->lugar_id = $request->lugar_id;
        $embarque->empaque_id = $request->empaque_id;
        $embarque->destinatario_id = $request->destinatario_id;
        $embarque->uso_id = $request->uso_id;
        $embarque->origen = $request->origen;
        $embarque->numero_economico = $request->numero_economico;
        $embarque->placas_transporte = $request->placas_transporte;
        $embarque->puerto_id = $request->puerto_id;
        $embarque->folio_embarque = 'VMRE-'.auth()->user()->employee_number.'-'.$country_id->codigo.'-'.$cadena_consecutivo.'-'.substr(date('Y'), 2, 2);
        $embarque->status = "Finalizado";
        $embarque->fecha_termino = now();
        $embarque->save();

        $registro = EmbarquesRPV::where('embarque_id', $request->embarque_id)->first();
        unset($datos['folio_embarque']);
        unset($datos['clave_aprobacion']);
        unset($datos['vigencia']);
        unset($datos['vigencia_id']);
        unset($datos['lugar_id']);
        unset($datos['empaque_id']);
        unset($datos['destinatario_id']);
        unset($datos['uso_id']);
        unset($datos['origen']);
        unset($datos['numero_economico']);
        unset($datos['puerto_id']);
        unset($datos['placas_transporte']);
        unset($datos['fecha_embarque_new']);
        unset($datos['hora_embarque_new']);
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

    public function cancel_embarque(Request $request, $embarque_id)
    {
        $embarque = Embarques::find($embarque_id);
        // GET COUNTRY ID BY EMBPAQUE
        $country_id = Empaques::select('cat_estados.codigo', 'cat_estados.id')
            ->join('cat_municipios', 'cat_empaques.municipio_id', 'cat_municipios.id')
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
        $embarque->status = "Cancelado";
        $embarque->fecha_termino = now();
        $embarque->observaciones = $request->observations;
        $embarque->save();

        return redirect()->back();
    }

    public function embarques_small(){
        $vigencias = Vigencias::where('activo', 1)->first();
        if($vigencias->count() == 0){
            return redirect()->route('vigencias.index')->with('error_vigencia', 'No hay vigencias activas, por favor activa una vigencia para poder continuar.');
        }
        if(Auth::user()->hasRole('Super Admin')){
            $empaques = Empaques::where('activo', 1)->get();
            $lugares = Municipios::where('activo', 1)->get();
        }
        else{
            $empaques = Empaques::get_empaques_by_country();
            $lugares = Municipios::municipios_by_user(Auth::user()->id);
        }
        $paises = Paises::where('activo', 1)->get();
        $users = User::role('tefs')->get();
        return view('operation/embarques_small', compact('empaques', 'paises', 'users', 'vigencias', 'lugares', 'vigencias'));
    }

    public function save_embarques_small(Request $request){

        $data = $request->only([
            'empaque_id',
            'destinatario_id',
            'vigencia_id',
            'pais_id',
            'municipio_id',
        ]);

        // TEFS OR ADMIN
        if (auth()->user()->hasRole('Super Admin')) {
            $data['tefs_id'] = $request->get('tefs_id');
        } else {
            $data['tefs_id'] = auth()->user()->id;

        }

        $embarque = Embarques::updateOrCreate(
            ['id' => $request->get('id_embarque')],
            $data
        );

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

                $embarqueRPVData['embarque_id'] = $embarque->id;
                $embarqueRPVData['created_at'] = now();
                $embarqueRPVData['updated_at'] = now();

                EmbarquesRPV::insert($embarqueRPVData);
            }

        return response()->json(['success' => 'Datos guardados exitosamente!']);


    }

    public function new_dv_template(){
        $vigencias = Vigencias::where('activo', 1)->get();
        if($vigencias->count() == 0){
            return redirect()->route('vigencias.index')->with('error_vigencia', 'No hay vigencias activas, por favor activa una vigencia para poder continuar.');
        }
        if(Auth::user()->hasRole('Super Admin')){
            $empaques = Empaques::where('activo', 1)->get();
            $municipios = Municipios::get_municipios_template();
            $lugares = Municipios::where('activo', 1)->get();
            $standards = Standards::where('activo', 1)->get();
        }
        else{
            $empaques = Empaques::get_empaques_by_country();
            $municipios = Municipios::get_municipios_template_by_user(Auth::user()->id);
            $lugares = Municipios::municipios_by_user(Auth::user()->id);
            $standards = UsersStandards::user_standards_select(Auth::user()->id);
            $count_standards = UsersStandards::where('user_id', Auth::user()->id);
            if($count_standards->count() == 0){
                return redirect()->route('dashboard')->with('error_standards', 'No tienes normas asignadas, por favor asigna normas para poder continuar.');
            }
        }
        $paises = Paises::where('activo', 1)->get();
        $users = User::role('tefs')->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        $variedades = Variedades::where('activo', 1)->get();
        // $municipios = Municipios::where('activo', 1)->get();
        $vigencia = Vigencias::select('id')->where('activo', 1)->first();
        $usos = Usos::where('activo', 1)->get();
        $puertos = Puertos::where('activo', 1)->get();
        return view('operation/new_dv_template', compact('empaques', 'paises', 'users', 'presentaciones', 'variedades', 'vigencias', 'municipios', 'usos', 'standards', 'puertos', 'lugares'));
    }

    public function save_new_dv_tamplate(Request $request){
        $datos = $request->json()->all();
        $productos = json_decode($datos['products'], true);
        $standards = json_decode($datos['standards'], true);
        DB::beginTransaction();
        try {
            $embarque_id = Embarques::create([
                'empaque_id' => $datos['empaque_id'],
                'municipio_id' => $datos['municipio_id'],
                'destinatario_id' => $datos['destinatario_id'],
                'pais_id' => $datos['pais_id'],
                'puerto_id' => $datos['puerto_id'],
                'tefs_id' => $datos['tefs_id'],
                'vigencia_id' => $datos['vigencia_id'],
                'lugar_id' => $datos['lugar_id'],
                'uso_id' => $datos['uso_id'],
                'origen' => $datos['origen'],
                'folio_embarque' => "EMB-",
                'numero_economico' => $datos['numero_economico'],
                'placas_transporte' => $datos['placas_transporte'],
                'origen' => $datos['origen'],
                'status' => 'Pendiente',
            ]);
            unset($datos['pais_id']);
            unset($datos['municipio_id']);
            unset($datos['empaque_id']);
            unset($datos['destinatario_id']);
            unset($datos['tefs_id']);
            unset($datos['puerto_id']);
            unset($datos['lugar_id']);
            unset($datos['uso_id']);
            unset($datos['numero_economico']);
            unset($datos['placas_transporte']);
            unset($datos['origen']);
            unset($datos['vigencia_id']);
            unset($datos['fecha_embarque_new']);
            unset($datos['hora_embarque_new']);
            unset($datos['products']);
            unset($datos['standards']);

            $registro = new EmbarquesRPV();
            $registro->embarque_id = $embarque_id->id;
            foreach ($datos as $campo => $valor) {
                $registro->$campo = $valor;
            }

            $registro->save();

            if (!empty($standards)) {
                foreach ($standards as $standards_arr) {
                    $standard = new EmbarquesStandards();
                    $standard->embarque_id = $embarque_id->id;
                    $standard->standard_id = $standards_arr[0];
                    $standard->observations = $standards_arr[2];
                    $standard->save();
                }
            }
            $insertData = [];
            if (!empty($productos)) {
                foreach ($productos as $product) {
                    $insertData[] = [
                        'embarque_id' => $embarque_id->id,
                        'lote' => $product[9],
                        'sader' => $product[10],
                        'cartilla' => $product[11],
                        'variedad_id' => $product[1],
                        'presentacion_id' => $product[3],
                        'cantidad' => $product[6],
                        'peso' => $product[7],
                        'marca_id' => $product[8] == '' ? null : $product[8],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                EmbarquesProductos::insert($insertData);
            }
            DB::commit();
            return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al guardar los datos.'], 500);
        }
    }

    public function copy_embarque_rpv($id){
        $embarque = Embarques::find($id);
        $embarque_dv = EmbarquesRPV::where('embarque_id', $id)->first();
        $embarque_productos = EmbarquesProductos::where('embarque_id', $id)->get();
        $embarque_standards = EmbarquesStandards::where('embarque_id', $id)->get();
        $new_embarque = $embarque->replicate();
        $new_embarque->status = 'Pendiente';
        $new_embarque->created_at = now();
        $new_embarque->folio_embarque = 'EMB-';
        $new_embarque->save();

        $new_embarque_rpv = $embarque_dv->replicate();
        $new_embarque_rpv->embarque_id = $new_embarque->id;
        $new_embarque_rpv->save();

        foreach ($embarque_productos as $producto) {
            $new_producto = $producto->replicate();
            $new_producto->embarque_id = $new_embarque->id;
            $new_producto->save();
        }

        foreach ($embarque_standards as $standard) {
            $new_standard = $standard->replicate();
            $new_standard->embarque_id = $new_embarque->id;
            $new_standard->save();
        }

        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
}
