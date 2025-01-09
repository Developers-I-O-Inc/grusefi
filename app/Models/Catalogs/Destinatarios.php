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
    ];

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
            ) AS domicilio
            FROM cat_destinatarios LEFT JOIN cat_empaques ON cat_destinatarios.empaque_id = cat_empaques.id
            LEFT JOIN cat_municipios ON cat_empaques.municipio_id = cat_municipios.id
            LEFT JOIN cat_localidades ON cat_empaques.localidad_id = cat_localidades.id
            WHERE cat_destinatarios.deleted_at IS NULL");
    }
}
