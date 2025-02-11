<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Manuel',
            'last_name' => 'Morales',
            'address' => 'Roble 4',
            'phone' => '3411671215',
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'employee_number' => '123456',
            'password'=> Hash::make('123456'),
            'password_changed_at'=> '2023-01-01 10:00:00',
            'last_id'=> '00025',
        ]);
        // Create role administrator
        Role::create(['name' => 'Super Admin']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_tefs = Role::create(['name' => 'tefs']);
        $ver_zonas = Permission::create(['name' => 'ver_zonas']);
        $ver_configuracion = Permission::create(['name' => 'ver_configuracion']);
        $ver_plantillas = Permission::create(['name' => 'ver_plantillas']);
        $ver_embarques = Permission::create(['name' => 'ver_embarques']);
        $ver_admin = Permission::create(['name' => 'ver_admin']);
        $ver_reportes = Permission::create(['name' => 'ver_reportes']);
        $admin_paises = Permission::create(['name' => 'admin_paises']);
        $admin_estados = Permission::create(['name' => 'admin_estados']);
        $admin_municipios = Permission::create(['name' => 'admin_municipios']);
        $admin_localidades = Permission::create(['name' => 'admin_localidades']);
        $admin_plantillas = Permission::create(['name' => 'admin_plantillas']);
        $admin_embarques = Permission::create(['name' => 'admin_embarques']);
        $admin_users = Permission::create(['name' => 'admin_users']);
        $admin_config = Permission::create(['name' => 'admin_config']);
        $config_tefs = Permission::create(['name' => 'config_tef']);
        //ASING PERMISSIONS TO ROLES
        $role_admin->givePermissionTo($ver_zonas);
        $role_admin->givePermissionTo($ver_configuracion);
        $role_admin->givePermissionTo($ver_plantillas);
        $role_admin->givePermissionTo($ver_embarques);
        $role_admin->givePermissionTo($ver_admin);
        $role_admin->givePermissionTo($ver_reportes);
        $role_admin->givePermissionTo($admin_paises);
        $role_admin->givePermissionTo($admin_estados);
        $role_admin->givePermissionTo($admin_municipios);
        $role_admin->givePermissionTo($admin_localidades);
        $role_admin->givePermissionTo($admin_plantillas);
        $role_admin->givePermissionTo($admin_embarques);
        $role_admin->givePermissionTo($admin_users);
        $role_admin->givePermissionTo($admin_config);
        $role_tefs->givePermissionTo($ver_plantillas);
        $role_tefs->givePermissionTo($admin_plantillas);
        $role_tefs->givePermissionTo($ver_embarques);
        $role_tefs->givePermissionTo($admin_embarques);
        $role_tefs->givePermissionTo($ver_reportes);
        $role_tefs->givePermissionTo($config_tefs);
        $this->call([
            Paises::class,
            Estados::class,
            Municipios::class,
            Presentaciones::class,
            Standards::class,
            TiposCultivo::class,
            Usos::class,
            Variedades::class,
        ]);
    }
}
