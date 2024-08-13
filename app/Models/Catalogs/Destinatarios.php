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
        "telefonos",
        "correos",
        "activo",
    ];

    public static function get_destinatarios_empaque(){
        return DB::select("SELECT cat_destinatarios.id, empaque_id, nombre_fiscal, nombre, cat_destinatarios.nombre_corto, domicilio, cat_destinatarios.telefonos,
            correos, cat_destinatarios.activo
            FROM cat_destinatarios LEFT JOIN cat_empaques ON cat_destinatarios.empaque_id = cat_empaques.id
            WHERE cat_destinatarios.deleted_at IS NULL");
    }
}
