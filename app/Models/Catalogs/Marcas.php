<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marcas extends Model
{
    use HasFactory;

    protected $table = "cat_marcas";

    protected $fillable = [
        "id",
        "empaque_id",
        "nombre",
        "activo"
    ];

    public static function get_marcas_empaque(){
        return DB::select("SELECT cat_marcas.id, empaque_id,  cat_empaques.nombre_fiscal as empaque, cat_marcas.nombre, cat_marcas.activo
            FROM cat_marcas LEFT JOIN cat_empaques ON cat_marcas.empaque_id = cat_empaques.id
            WHERE cat_marcas.deleted_at IS NULL");
    }
}
