<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Paises extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cat_paises')->insert([
            [
                'nombre' => 'Mexico',
                'nombre_corto' => 'MEX',
                'codigo' => '01',
                'activo' => true,
            ],
            [
                'nombre' => 'Estados Unidos',
                'nombre_corto' => 'USA',
                'codigo' => '02',
                'activo' => true,
            ],
            [
                'nombre' => 'Canada',
                'nombre_corto' => 'CAN',
                'codigo' => '03',
                'activo' => true,
            ]
        ]);
    }
}
