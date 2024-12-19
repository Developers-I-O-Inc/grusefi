<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Catalogs\Calibres;
use App\Models\Catalogs\Categorias;
use App\Models\Catalogs\Empaques;
use App\Models\Catalogs\Paises;
use App\Models\Catalogs\Presentaciones;
use App\Models\Catalogs\TipoCultivos;
use App\Models\Catalogs\Variedades;
use App\Models\Catalogs\Vigencias;
use App\Models\Operation\EmbarquesMarcas;
use App\Models\Operation\EmbarquesMaquiladores;
use App\Models\Operation\Embarques;
use App\Models\Operation\EmbarquesRPV;
use App\Models\Operation\EmbarquesProductos;
use App\Models\Operation\PlantillaRPV;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class EmbarquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->hasRole('tefs')){
            $empaques = Empaques::get_empaques_by_country();
        }
        else{
            $empaques = Empaques::where('activo', 1)->get();
        }
        $empaques = Empaques::where('activo', 1)->get();
        $paises = Paises::where('activo', 1)->get();
        $users = User::role('tefs')->get();
        $categorias = Categorias::where('activo', 1)->get();
        $calibres = Calibres::where('activo', 1)->get();
        $presentaciones = Presentaciones::where('activo', 1)->get();
        $variedades = Variedades::where('activo', 1)->get();
        $vigencia = Vigencias::select('id')->where('activo', 1)->first();
        return view('operation/embarques', compact('empaques', 'paises', 'users', 'categorias', 'calibres', 'presentaciones', 'variedades', 'vigencia'));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marcas = json_decode($request->get('marcas'), true);
        $maquiladores = json_decode($request->get('maquiladores'), true);
        $productos = json_decode($request->get('productos'), true);

        $data = $request->only([
            'empaque_id',
            'destinatario_id',
            'variedad_id',
            'vigencia_id',
            'pais_id',
            'puerto_id',
            'fecha_embarque',
            'numero_economico',
            'placas_trasporte',
            'inspector',
            'consolidado',
            'consolidado_id',
            'empresa_transporte',
            'chofer'
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
            ->where('variedad_id', $embarque->variedad_id)
            ->first();

                if ($plantilla) {
                    $embarqueRPVData = $plantilla->toArray();

                    // Eliminamos los campos que no necesitamos
                    unset(
                        $embarqueRPVData['id'],
                        $embarqueRPVData['pais_id'],
                        $embarqueRPVData['variedad_id'],
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
            if (!empty($marcas)) {
                foreach ($marcas as $marca_arr) {
                    $marca = new EmbarquesMarcas();
                    $marca->embarque_id = $embarque->id;
                    $marca->marca_id = $marca_arr;
                    $marca->save();
                }
            }

            if (!empty($maquiladores)) {
                foreach ($maquiladores as $maquilador_arr) {
                    $maquilador = new EmbarquesMaquiladores();
                    $maquilador->embarque_id = $embarque->id;
                    $maquilador->maquilador_id = $maquilador_arr;
                    $maquilador->save();
                }
            }

            $insertData = [];
            if (!empty($productos)) {
                foreach ($productos as $product) {
                    $insertData[] = [
                        'embarque_id' => $embarque->id,
                        'categoria_id' => $product[8],
                        'presentacion_id' => $product[10],
                        'calibre_id' => $product[12],
                        'folio_pallet' => $product[1],
                        'lote' => $product[2],
                        'cajas' => $product[3],
                        'sader' => $product[6],
                        'tipo_fruta' => $product[13],
                        'n_registros' => $product[14],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                EmbarquesProductos::insert($insertData);
            }
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
    public function destroy_calibres(Request $request)
    {

    }

    public function embarques_admin(Request $request){
        if ($request->ajax()) {
            $dates = $request->input('dates');
            $start_date = substr($dates, 0, 10);
            $end_date = substr($dates, 13, 10);
            $apply_filter = $request->input('filter', false);

            if(!$apply_filter || $start_date == '' or $end_date ==''){
                $calibres = Embarques::get_embarques_admin(auth()->user()->hasRole('tefs'));
            }
            else {
                $calibres = Embarques::get_embarques_admin_by_dates($start_date, $end_date, auth()->user()->hasRole('tefs'));
            }

            return Datatables::of($calibres) ->addIndexColumn()
            ->addColumn('buttons', function($row){
                $btn = "";
                if($row->status != "Finalizado"){
                    $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-admin-table-filter="edit">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                            </svg>
                        </span>
                    </button>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-admin-table-filter="print">
                        <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14V4H6V20H18V8H20V21C20 21.6 19.6 22 19 22Z" fill="black"/>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                </svg>
                            </span>
                    </button>';
                }

                else{
                    $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-admin-table-filter="print">
                        <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14V4H6V20H18V8H20V21C20 21.6 19.6 22 19 22Z" fill="black"/>
                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                </svg>
                            </span>
                    </button>
                    <button data-id="'.$row->id.'" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-kt-admin-table-filter="upload">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M5 16C3.3 16 2 14.7 2 13C2 11.3 3.3 10 5 10H5.1C5 9.7 5 9.3 5 9C5 6.2 7.2 4 10 4C11.9 4 13.5 5 14.3 6.5C14.8 6.2 15.4 6 16 6C17.7 6 19 7.3 19 9C19 9.4 18.9 9.7 18.8 10C18.9 10 18.9 10 19 10C20.7 10 22 11.3 22 13C22 14.7 20.7 16 19 16H5ZM8 13.6H16L12.7 10.3C12.3 9.89999 11.7 9.89999 11.3 10.3L8 13.6Z" fill="black"/>
                                <path d="M11 13.6V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19V13.6H11Z" fill="black"/>
                            </svg>
                        </span>
                    </button>
                    ';
                }
                return $btn;
            })
            ->rawColumns(['buttons'])
            ->make(true);

        }
        $categorias = Categorias::where('activo', 1)->get();
        $calibres = Calibres::where('activo', 1)->get();
        $vigencias = Vigencias::where('activo', 1)->get();
        return view("operation/embarques_admin", compact('categorias', 'calibres', 'vigencias'));
    }

    public function get_embarque_edit($embarque_id)
    {
        $embarque = Embarques::get_embarque($embarque_id);
        $plantilla = EmbarquesRPV::where('embarque_id', $embarque_id)->first();
        $embarques_marcas = EmbarquesMarcas::get_marcas_embarque($embarque_id);
        return response()->json(["plantilla" =>$plantilla, "embarque"=>$embarque, "embarques_marcas"=>$embarques_marcas]);
    }

    public function get_products_embarque($embarque_id)
    {
        $embarque_productos = EmbarquesProductos::get_embarque_products($embarque_id);
        return response()->json($embarque_productos);
    }

    public function get_marcas_embarque($embarque_id)
    {
        $embarque_marcas = EmbarquesMarcas::get_marcas_embarque($embarque_id);
        return response()->json($embarque_marcas);
    }

    public function save_products_embarque(Request $request){

        $producto = new EmbarquesProductos();
        $producto->embarque_id = $request->get('embarque_id');
        $producto->categoria_id = $request->get('categoria_id');
        $producto->calibre_id = $request->get('calibre_id');
        $producto->folio_pallet = $request->get('folio_pallet');
        $producto->lote = $request->get('lote');
        $producto->cajas = $request->get('cajas');
        $producto->sader = $request->get('sader');
        $producto->tipo_fruta = $request->get('tipo_fruta');
        $producto->n_registros = $request->get('n_registros');
        $producto->presentacion_id = explode('|', $request->input('presentacion_id'))[0];
        $producto->save();

        return response()->json(["OK"=>"Se guardo correctamente"]);

    }

    public function save_marcas_embarques(Request $request)
    {
        $embarque_id = $request->get('embarque_id');
        $marcas = $request->get('marcas');

        EmbarquesMarcas::where('embarque_id', $embarque_id)->delete();

        foreach ($marcas as $marca) {
            EmbarquesMarcas::create([
                'embarque_id' => $embarque_id,
                'marca_id' => $marca['marca_id'],
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
        $embarque->folio_embarque = 'UV-220724-16-VMRE-'.auth()->user()->employee_number.'-'.$country_id->codigo.'-'.$cadena_consecutivo.'-'.substr(date('Y'), 2, 2);
        $embarque->status = "Finalizado";
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
}
