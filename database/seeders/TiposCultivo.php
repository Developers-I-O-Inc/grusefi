<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposCultivo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cat_tipo_cultivos')->insert([
            [
                'tipo_cultivo' => 'Cereales',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Leguminosas',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Oleaginosas',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Hortalizas',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Frutales',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Ornamentales',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Raíces y tubérculos',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tipo_cultivo' => 'Pastos',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
