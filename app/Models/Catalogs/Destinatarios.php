<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Destinatarios extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "cat_destinatarios";
    protected $fillable = [
        "id",
        "empaque_id",
        "nombre",
        "nombre_corto",
        "domicilio",
        'colonia',
        'num_ext',
        'num_int',
        'cp',
        "telefonos",
        "correos",
        "activo",
        "municipio_id",
        "localidad_id",
    ];

    public static function get_destinatario($id){
        return DB::select("SELECT destinatarios.id, empaque_id, destinatarios.nombre, destinatarios.nombre_corto, destinatarios.domicilio,
            destinatarios.colonia, destinatarios.num_ext, destinatarios.num_int, destinatarios.cp, destinatarios.telefonos,
            correos, destinatarios.activo, destinatarios.municipio_id, destinatarios.localidad_id, estado_id, pais_id
        FROM cat_destinatarios AS destinatarios
        LEFT JOIN cat_empaques ON destinatarios.empaque_id = cat_empaques.id
        LEFT JOIN cat_municipios ON destinatarios.municipio_id = cat_municipios.id
        LEFT JOIN cat_localidades ON destinatarios.localidad_id = cat_localidades.id
        LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
        LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
        WHERE destinatarios.deleted_at IS NULL AND destinatarios.id = $id");
    }
    public static function get_destinatarios_empaque(){
        return DB::select("SELECT cat_destinatarios.id, empaque_id, nombre_fiscal, cat_destinatarios.nombre, cat_destinatarios.nombre_corto, domicilio, cat_destinatarios.telefonos,
            correos, cat_destinatarios.activo,
             CONCAT_WS(', ',
                CONCAT_WS(' ',
                    cat_destinatarios.domicilio,
                    CONCAT('#', cat_destinatarios.num_ext),
                    IF(cat_destinatarios.num_int IS NOT NULL AND cat_destinatarios.num_int != '', CONCAT('INT.', cat_destinatarios.num_int), NULL)
                ),
                cat_destinatarios.colonia,
                CONCAT('CP.', cat_destinatarios.cp),
                cat_municipios.nombre,
                cat_localidades.nombre
            ) AS domicilio, pais_id, estado_id, cat_destinatarios.municipio_id, cat_destinatarios.localidad_id
            FROM cat_destinatarios
				LEFT JOIN cat_empaques ON cat_destinatarios.empaque_id = cat_empaques.id
            LEFT JOIN cat_municipios ON cat_destinatarios.municipio_id = cat_municipios.id
            LEFT JOIN cat_localidades ON cat_destinatarios.localidad_id = cat_localidades.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE cat_destinatarios.deleted_at IS NULL
            ORDER BY cat_destinatarios.nombre");
    }

    public static function get_destinatario_address($embarque_id){
        return DB::select("SELECT
            CONCAT_WS(', ',
                CONCAT_WS(' ',
                    cat_destinatarios.domicilio,
                    CONCAT('#', cat_destinatarios.num_ext),
                    IF(cat_destinatarios.num_int IS NOT NULL AND cat_destinatarios.num_int != '', CONCAT('INT.', cat_destinatarios.num_int), NULL)
                ),
                cat_destinatarios.colonia,
                CONCAT('CP.', cat_destinatarios.cp),
                cat_localidades.nombre,
                cat_municipios.nombre,
                cat_estados.nombre,
                cat_paises.nombre
            ) AS domicilio
            FROM cat_destinatarios
            LEFT JOIN op_embarques ON op_embarques.destinatario_id = cat_destinatarios.id
            LEFT JOIN cat_municipios ON cat_destinatarios.municipio_id = cat_municipios.id
            LEFT JOIN cat_localidades ON cat_destinatarios.localidad_id = cat_localidades.id
            LEFT JOIN cat_estados ON cat_municipios.estado_id = cat_estados.id
            LEFT JOIN cat_paises ON cat_estados.pais_id = cat_paises.id
            WHERE cat_destinatarios.deleted_at IS NULL AND op_embarques.id = $embarque_id");
    }
}
