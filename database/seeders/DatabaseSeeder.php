<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Manuel',
            // 'user_name' => 'Manuel',
            'last_name' => 'Morales',
            'address' => 'Roble 4',
            'phone' => '3411671215',
            'name' => 'Test User',
            'email' => 'admin@admin.com',
            'password'=> Hash::make('123456')
        ]);
        // Create role administrator
        Role::create(['name' => 'admin']);
        // ADD PAIS
        \App\Models\Catalogs\Paises::factory()->create([
            'nombre' => 'México',
            'nombre_corto' => 'MEX',
            'codigo' => '010'
        ]);
    }
}
