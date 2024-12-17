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
        'puerto_id',
        'folio_embarque',
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

    public static function get_embarques_admin(){
        return DB::select("SELECT folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            WHERE
                YEAR(fecha_embarque) = YEAR(CURDATE())
                AND WEEK(fecha_embarque, 1) = WEEK(CURDATE(), 1)
        ");
    }

    public static function get_embarques_admin_by_dates($start_date, $end_date){
        return DB::select("SELECT folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            WHERE
                fecha_embarque BETWEEN ? AND ?
        ", [$start_date, $end_date]);
    }
}
