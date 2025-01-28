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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'tefs']);
        Permission::create(['name' => 'ver_zonas']);
        Permission::create(['name' => 'ver_configuracion']);
        Permission::create(['name' => 'ver_plantillas']);
        Permission::create(['name' => 'ver_embarques']);
        Permission::create(['name' => 'ver_admin']);
        Permission::create(['name' => 'ver_reportes']);
        Permission::create(['name' => 'admin_paises']);
        Permission::create(['name' => 'admin_estados']);
        Permission::create(['name' => 'admin_municipios']);
        Permission::create(['name' => 'admin_localidades']);
        Permission::create(['name' => 'admin_plantillas']);
        Permission::create(['name' => 'admin_embarques']);
        Permission::create(['name' => 'admin_users']);

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
