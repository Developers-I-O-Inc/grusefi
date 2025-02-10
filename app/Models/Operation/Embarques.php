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
        'municipio_id',
        'vigencia_id',
        'destinatario_id',
        'pais_id',
        'municipio_id',
        'lugar_id',
        'fecha_termino',
        'puerto_id',
        'origen',
        'folio_embarque',
        'consecutivo',
        'numero_economico',
        'placas_transporte',
        'inspector',
        'consolidado',
        'consolidado_id',
        'empresa_transporte',
        'chofer',
        'tefs_id',
        'uso_id',
        'status'
    ];

    public static function get_embarque($id){
        $result = DB::select("SELECT
            op_embarques.id,
            op_embarques.pais_id,
            op_embarques.empaque_id,
            folio_embarque,
            op_embarques.created_at as fecha_embarque,
            empaques.nombre_fiscal,
            CONCAT_WS(', ',
                cat_localidades.nombre,
                cat_municipios.nombre,
                cat_estados.nombre) AS lugar_inicial,
            CONCAT_WS(', ',
                CONCAT_WS(' ',
                    empaques.domicilio_fiscal,
                    CONCAT('#', empaques.num_ext),
                    IF(empaques.num_int IS NOT NULL AND empaques.num_int != '', CONCAT('INT.', empaques.num_int), NULL)
                ),
                empaques.colonia,
                CONCAT('CP.', empaques.cp),
                cat_localidades.nombre,
                cat_municipios.nombre,
                cat_estados.nombre,
                'MÉXICO'
            ) AS domicilio_empaque,
            cat_destinatarios.nombre AS destinatario,
            cat_destinatarios.domicilio AS destinatario_domicilio,
            CONCAT_WS(', ', puerto,
            mpuertos.nombre) AS puerto,
            CONCAT_WS(', PLACAS: ', numero_economico,
            placas_transporte) AS transporte,
            vigencia,
            clave_aprobacion,
            uso,
            CONCAT_WS(', ',
                mo.nombre,
                eo.nombre
            ) AS lugar, fecha_termino, CONCAT_WS(' ', users.name, users.last_name) AS tefs
            FROM op_embarques
            LEFT JOIN cat_empaques AS empaques ON op_embarques.empaque_id = empaques.id
            LEFT JOIN cat_municipios ON empaques.municipio_id = cat_municipios.id
            LEFT JOIN cat_localidades ON empaques.localidad_id = cat_localidades.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_municipios AS mo ON op_embarques.lugar_id = mo.id
            LEFT JOIN cat_estados AS eo ON mo.estado_id = eo.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            LEFT JOIN cat_municipios AS mpuertos ON cat_puertos.municipio_id = mpuertos.id
            LEFT JOIN cat_vigencias ON op_embarques.vigencia_id = cat_vigencias.id
            LEFT JOIN cat_usos ON op_embarques.uso_id = cat_usos.id
            LEFT JOIN users ON op_embarques.tefs_id = users.id
            WHERE op_embarques.id = ?
        ", [$id]);

        return !empty($result) ? $result[0] : null;
    }

    public static function get_embarques_admin($admin){
        $where = "";
        if(!$admin){
            $where = "AND tefs_id = ".auth()->user()->id;
        }
        return DB::select("SELECT op_embarques.id, folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, op_embarques.created_at AS fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status,
                CONCAT_WS(' ', users.name, users.last_name) AS tefs
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            LEFT JOIN users ON op_embarques.tefs_id = users.id
            WHERE
                YEAR(op_embarques.created_at) = YEAR(CURDATE())
                AND WEEK(op_embarques.created_at, 1) = WEEK(CURDATE(), 1)"
            .$where);
    }

    public static function get_embarques_admin_by_dates($start_date, $end_date, $admin){
        $where = "";
        if(!$admin){
            $where = " AND tefs_id = ".auth()->user()->id;
        }
        return DB::select("SELECT op_embarques.id, folio_embarque, op_embarques.id, op_embarques.empaque_id, nombre_fiscal, op_embarques.created_at AS fecha_embarque, puerto, destinatario_id, cat_destinatarios.nombre, status,
                CONCAT_WS(' ', users.name, users.last_name) AS tefs
            FROM op_embarques
            LEFT JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            LEFT JOIN cat_destinatarios ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_puertos ON op_embarques.puerto_id = cat_puertos.id
            LEFT JOIN users ON op_embarques.tefs_id = users.id
            WHERE
                op_embarques.created_at BETWEEN ? AND ?".$where, [$start_date, $end_date]);
    }

    public static function count_consecutivo_year($user_id, $country_id){
        return DB::select("SELECT COUNT(tefs_id) AS total
            FROM op_embarques
            INNER JOIN cat_empaques ON op_embarques.empaque_id = cat_empaques.id
            INNER JOIN cat_municipios ON cat_empaques.municipio_id = cat_municipios.id
            WHERE YEAR(op_embarques.created_at) = YEAR(CURDATE())
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
