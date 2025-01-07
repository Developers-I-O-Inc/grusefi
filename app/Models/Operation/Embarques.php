<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Embarques extends Model
{
    use HasFactory;

    protected $table = "op_embarques";

    protected $fillable = [
        'empaque_id',
        'variedad_id',
        'vigencia_id',
        'destinatario_id',
        'pais_id',
        'municipio_id',
        'puerto_id',
        'folio_embarque',
        'consecutivo',
        'fecha_embarque',
        'numero_economico',
        'placas_trasporte',
        'inspector',
        'consolidado',
        'consolidado_id',
        'empresa_transporte',
        'chofer',
        'tefs_id',
    ];

    public static function get_embarque($id){
        $result = DB::select("SELECT
            op_embarques.id,
            op_embarques.pais_id,
            op_embarques.variedad_id,
            op_embarques.empaque_id,
            folio_embarque,
            fecha_embarque,
            empaques.nombre_fiscal,
            CONCAT_WS(', ',
                empaques.domicilio_fiscal,
                empaques.num_ext,
                empaques.num_int,
                cat_municipios.nombre,
                cat_localidades.nombre
            ) AS domicilio_empaque,
            cat_destinatarios.nombre AS destinatario,
            cat_destinatarios.domicilio AS destinatario_domicilio,
            CONCAT_WS(', ', puerto,
            mpuertos.nombre) AS puerto,
            CONCAT_WS(', PLACAS:S', medio_transporte,
            placas) AS transporte,
            vigencia,
            clave_aprobacion
            FROM op_embarques
            LEFT JOIN cat_empaques AS empaques ON op_embarques.empaque_id = empaques.id
            LEFT JOIN cat_localidades ON empaques.localidad_id = cat_localidades.id
            LEFT JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            LEFT JOIN cat_municipios AS mpuertos ON cat_puertos.municipio_id = mpuertos.id
            LEFT JOIN cat_vigencias ON op_embarques.vigencia_id = cat_vigencias.id
            WHERE op_embarques.id = ?
        ", [$id]);

        return !empty($result) ? $result[0] : null;
    }

    public static function get_embarques_admin($admin){
        $where = "";
        if($admin){
            $where = "AND tefs_id = ".auth()->user()->id;
        }
        return DB::select("SELECT op_embarques.id, folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            WHERE
                YEAR(fecha_embarque) = YEAR(CURDATE())
                AND WEEK(fecha_embarque, 1) = WEEK(CURDATE(), 1)"
            .$where);
    }

    public static function get_embarques_admin_by_dates($start_date, $end_date, $admin){
        $where = "";
        if($admin){
            $where = " AND tefs_id = ".auth()->user()->id;
        }
        return DB::select("SELECT op_embarques.id, folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            WHERE
                fecha_embarque BETWEEN ? AND ?".$where, [$start_date, $end_date]);
    }

    public static function count_consecutivo_year($user_id, $country_id){
        return DB::select("SELECT COUNT(tefs_id) AS total
            FROM op_embarques
            INNER JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            INNER JOIN cat_localidades ON cat_empaques.localidad_id = cat_localidades.id
            INNER JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
            WHERE YEAR(fecha_embarque) = YEAR(CURDATE())
            AND status = 'Finalizado'
            AND tefs_id = ?
            AND estado_id = ?", [$user_id, $country_id]);
    }

    public static function get_procedencia($embarque_id){
        return DB::select("SELECT CONCAT_WS(', ', cat_municipios.nombre, cat_estados.nombre, cat_paises.nombre) AS procedencia
            FROM op_embarques
            LEFT JOIN cat_municipios ON op_embarques.municipio_id = cat_municipios.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE op_embarques.id = ?", [$embarque_id]);
    }
}
