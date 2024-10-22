<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Estados extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country_id = DB::table('cat_paises')->where('nombre_corto', 'MEX')->value('id');

        $states = [
            [ 'nombre' => 'AGUASCALIENTES', 'nombre_corto' => 'AGS', 'codigo' => '01', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'BAJA CALIFORNIA', 'nombre_corto' => 'BC', 'codigo' => '02', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'BAJA CALIFORNIA SUR', 'nombre_corto' => 'BCS', 'codigo' => '03', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'CHIHUAHUA', 'nombre_corto' => 'CHI', 'codigo' => '04', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'CHIAPAS', 'nombre_corto' => 'CHS', 'codigo' => '05', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'CAMPECHE', 'nombre_corto' => 'CMP', 'codigo' => '06', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'CIUDAD DE MEXICO', 'nombre_corto' => 'CMX', 'codigo' => '07', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'COAHUILA', 'nombre_corto' => 'COA', 'codigo' => '08', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'COLIMA', 'nombre_corto' => 'COL', 'codigo' => '09', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'DURANGO', 'nombre_corto' => 'DGO', 'codigo' => '10', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'GUERRERO', 'nombre_corto' => 'GRO', 'codigo' => '11', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'GUANAJUATO', 'nombre_corto' => 'GTO', 'codigo' => '12', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'HIDALGO', 'nombre_corto' => 'HGO', 'codigo' => '13', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'JALISCO', 'nombre_corto' => 'JAL', 'codigo' => '14', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'MICHOACAN', 'nombre_corto' => 'MCH', 'codigo' => '15', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'ESTADO DE MEXICO', 'nombre_corto' => 'MEX', 'codigo' => '16', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'MORELOS', 'nombre_corto' => 'MOR', 'codigo' => '17', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'NAYARIT', 'nombre_corto' => 'NAY', 'codigo' => '18', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'NUEVO LEON', 'nombre_corto' => 'NL', 'codigo' => '19', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'OAXACA', 'nombre_corto' => 'OAX', 'codigo' => '20', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'PUEBLA', 'nombre_corto' => 'PUE', 'codigo' => '21', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'QUINTANA ROO', 'nombre_corto' => 'QR', 'codigo' => '22', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'QUERETARO', 'nombre_corto' => 'QRO', 'codigo' => '23', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'SINALOA', 'nombre_corto' => 'SIN', 'codigo' => '24', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'SAN LUIS POTOSI', 'nombre_corto' => 'SLP', 'codigo' => '25', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'SONORA', 'nombre_corto' => 'SON', 'codigo' => '26', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'TABASCO', 'nombre_corto' => 'TAB', 'codigo' => '27', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'TLAXCALA', 'nombre_corto' => 'TLX', 'codigo' => '28', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'TAMAULIPAS', 'nombre_corto' => 'TMS', 'codigo' => '29', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'VERACRUZ', 'nombre_corto' => 'VER', 'codigo' => '30', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'YUCATAN', 'nombre_corto' => 'YUC', 'codigo' => '31', 'activo' => true, 'pais_id' => $country_id ],
            [ 'nombre' => 'ZACATECAS', 'nombre_corto' => 'ZAC', 'codigo' => '32', 'activo' => true, 'pais_id' => $country_id ]
        ];

        DB::table('cat_estados')->insert($states);
    }
}
