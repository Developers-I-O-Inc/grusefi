<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Presentaciones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cat_presentaciones')->insert([
            [
                'presentacion' => 'ARPILLA',
                'plural' => 'ARPILLAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'BOLSA',
                'plural' => 'BOLSAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'CAJA',
                'plural' => 'CAJAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'CHAROLA',
                'plural' => 'CHAROLAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'COSTAL',
                'plural' => 'COSTALES',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'GRANEL',
                'plural' => 'GRANELES',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'MANOJO',
                'plural' => 'MANOJOS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'NO APLICA',
                'plural' => 'NO APLICA',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'presentacion' => 'PIEZA',
                'plural' => 'PIEZAS',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
