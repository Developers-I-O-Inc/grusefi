<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Standards extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('cat_standards')->insert([
            [
                'name' => 'NOM-026-FITO-1995',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NOM-031-FITO-2000',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NOM-040-FITO-2002',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MODIF. NOM-066-FITO-1995',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'NOM-075-FITO-1997',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ACUERDO MOSCA DEL MEDITERRANEO',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ACUERDO HLB',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CIRC. 118 DE 6/11/2007',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AVISO NO. 002 DEL 5/01/2012',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ACUERDO DE MOSCA DEL VINAGRE',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AVISO NO. 078 DEL 03/06/2015',
                'activo' => true,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
