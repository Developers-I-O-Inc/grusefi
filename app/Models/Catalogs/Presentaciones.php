<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Presentaciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_presentaciones";

    protected $fillable = [
        'id',
        'variedad_id',
        'presentacion',
        'peso',
        'activo',
    ];

    public static function get_presentaciones()
    {
        return DB::select('SELECT cat_presentaciones.id, variedad, presentacion, peso, cat_presentaciones.activo
            FROM cat_presentaciones
            LEFT JOIN cat_variedades ON cat_presentaciones.variedad_id = cat_variedades.id
            WHERE cat_presentaciones.deleted_at IS NULL');
    }

    public static function get_presentaciones_by_variedad($variedad_id)
    {
        return DB::select('SELECT cat_presentaciones.id, variedad, presentacion AS nombre, peso, cat_presentaciones.activo
            FROM cat_presentaciones
            LEFT JOIN cat_variedades ON cat_presentaciones.variedad_id = cat_variedades.id
            WHERE cat_presentaciones.deleted_at IS NULL AND cat_presentaciones.variedad_id = ?', [$variedad_id]);

    }
}
