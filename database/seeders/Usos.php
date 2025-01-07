<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cat_usos')->insert([
            [
                'uso' => 'CONSUMO ANIMAL',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'CONSUMO HUMANO',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'DOCENCIA - INVESTIGACION',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'INDUSTRIAL',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'ORNATO',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'MUESTRAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'SIEMBRA',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uso' => 'MATERIAL PROPAGATIVO',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
