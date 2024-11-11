<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Variedades extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cat_variedades';
    protected $fillable = [
        "variedad",
        "tipo_cultivo_id",
        "activo"
    ];

    public static function get_variedades()
    {
        return DB::select('SELECT cat_variedades.id, tipo_cultivo_id, tipo_cultivo, variedad, cat_variedades.activo
            FROM cat_variedades
            LEFT JOIN cat_tipo_cultivos ON cat_variedades.tipo_cultivo_id = cat_tipo_cultivos.id
            WHERE cat_variedades.deleted_at is null');
    }
}
