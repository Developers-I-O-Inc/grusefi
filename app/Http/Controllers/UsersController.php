<?php

namespace App\Http\Controllers;

use App\Models\Admin\UsersStandards;
use App\Models\Catalogs\Estados;
use App\Models\Catalogs\UsersCountries;
use App\Models\Catalogs\Standards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if ($request->ajax()) {
            $users = User::all();
            return Datatables::of($users)
                    ->addIndexColumn()
                    ->addColumn('check', function($row){
                        return view('components.checks_table', [
                            'id' => $row->id,
                            'disabled' => !auth()->user()->can("admin_users"),
                        ])->render();
                    })
                    ->addColumn('buttons', function($row){
                        if(auth()->user()->can('admin_users')){
                            $btn = '<button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-user-table-filter="edit" data-bs-toggle="tooltip" title="Editar">
                                <i class="ki-outline ki-pencil text-success fs-2"></i>
                            </button>
                            <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-user-table-filter="permissions" data-bs-toggle="tooltip" title="Agregar Permisos">
                                <i class="ki-outline ki-security-user text-success fs-2"></i>
                            </button>
                            <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-user-table-filter="reset-pass" data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar contraseña">
                                <i class="ki-outline ki-lock-2 text-success fs-2"></i>
                            </button>
                            <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-user-table-filter="add-countries" data-bs-toggle="tooltip" title="Agregar Estados">
                                <i class="ki-outline ki-geolocation text-success fs-2"></i>
                            </button>
                            <button data-id="'.$row->id.'" type="button" class="btn btn-active-light-success btn-sm me-0 ms-0" data-kt-user-table-filter="add-standards" data-bs-toggle="tooltip" title="Agregar Normas">
                                <i class="ki-outline ki-archive-tick text-success fs-2"></i>
                            </button>';
                        }
                        else{
                            $btn = 'No puedes realizar modificaciones';
                        }

                        return $btn;
                    })
                    ->rawColumns(['check', 'buttons'])
                    ->make(true);
        }
        $roles=Roles::all();
        $countries = Estados::all();
        $standards = Standards::all();
        return view("admin/users", array("roles"=>$roles, "countries"=>$countries, "standards"=>$standards));
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::updateOrCreate(

            ['id'=>$request->get('id_user')],
            ['name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'address' => $request->get('address'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'employee_number' => $request->get('employee_number'),
                'last_id' => $request->get('last_id'),
                'password' => Hash::make('123456'),
                'password_changed_at'=>now()
             ],
        );
        return response()->json(["OK"=>"Se guardo correctamente"]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::find($id);

        return response()->json(['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy_users(Request $request)
    {
        $ids = $request->input('ids');
        User::whereIn('id', $ids)->delete();
        return response()->json(["OK"=>"Eliminados"]);
    }

    public function get_user_permission(Request $request){
        $user=User::find($request->get('user_id'));
        return response()->json(["user"=>$user->getRoleNames()]);
    }

    public function get_user_countries(Request $request){
        $user_countries=UsersCountries::user_countries($request->get('user_id'));
        return response()->json(["user"=>$user_countries]);
    }

    public function get_user_standards(Request $request){
        $user_standards=UsersStandards::user_standards($request->get('user_id'));
        return response()->json(["user"=>$user_standards]);
    }

    // SAVE PERMISSIONS TO USER
    public function save_user_permissions(Request $request){
        $datos =json_decode($request->get('permissions'), true);
        $user=User::find($request->get('user_id'));
        $user->syncRoles($datos);
        return response()->json(["user"=>$user]);
    }

    // SAVE COUNTRIES TO USER
    public function save_user_countries(Request $request){
        $datos =json_decode($request->get('countries'), true);
        UsersCountries::where('user_id', $request->get('user_id'))->delete();
        foreach ($datos as $country) {
            UsersCountries::create([
                'user_id' => $request->get('user_id'),
                'estado_id' => $country,
                'created_at' => now(),
            ]);
        }
        return response()->json(["user"=>"ok"]);
    }

    // SAVE STANDARDS TO USER
    public function save_user_standards(Request $request){
        $standards =json_decode($request->get('standards'), true);
        $user_id = $request->get('user_id');
        UsersStandards::where('user_id', $request->get('user_id'))->delete();
        foreach ($standards as $standard) {
            UsersStandards::create([
                'user_id' => $user_id,
                'standard_id' => $standard['standard_id'],
                'validity' => $standard['validity'],
            ]);
        }
        return response()->json(["user"=>"ok"]);
    }

    public function reset_pass($id){
        User::where('id', $id)->update([
            'password' => Hash::make('123456'),
            'password_changed_at' => '2023-10-15 19:41:10',
        ]);

        return response()->json(["ok"=>"ok"]);
    }
}
