<?php

namespace App\Models\Operation;

use App\Models\Catalogs\Calibres;
use App\Models\Catalogs\Categorias;
use App\Models\Catalogs\Municipios;
use App\Models\Catalogs\TipoCultivos;
use App\Models\Catalogs\Presentaciones;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmbarquesProductos extends Model
{
    use HasFactory;

    protected $table = "op_embarques_productos";

    protected $fillable = [
        'id',
        'embarque_id',
        'variedad_id',
        'presentacion_id',
        'sader',
        'cantidad',
        'peso',
        'lote',
        'cartilla',
        'marca_id'
    ];

    public static function get_embarque_products($id){
        return DB::select("SELECT op_embarques_productos.id, embarque_id, presentacion_id, variedad_id, variedad, nombre_cientifico,
                presentacion, sader, cantidad, lote, cartilla, peso, marca_id, cat_marcas.nombre AS marca,
                (cantidad * peso) as total_kilos
            FROM op_embarques_productos
            LEFT JOIN cat_presentaciones ON op_embarques_productos.presentacion_id = cat_presentaciones.id
            LEFT JOIN cat_variedades ON op_embarques_productos.variedad_id = cat_variedades.id
            LEFT JOIN cat_marcas ON op_embarques_productos.marca_id = cat_marcas.id
            WHERE embarque_id = $id");
    }

    public static function get_only_embarque_products($id){
        return DB::select("SELECT DISTINCT variedad, nombre_cientifico
            FROM op_embarques_productos
            LEFT JOIN cat_variedades ON op_embarques_productos.variedad_id = cat_variedades.id
            WHERE embarque_id = $id
            ORDER BY variedad");
    }

    public static function get_only_embarque_quantities($id){
        return DB::select("SELECT variedad, sum(cantidad) as cantidad, sum(peso) as peso, sum(cantidad * peso) as total_kilos
            FROM op_embarques_productos
            LEFT JOIN cat_variedades ON op_embarques_productos.variedad_id = cat_variedades.id
            WHERE embarque_id = $id
            GROUP BY variedad");
    }

    public static function get_only_embarque_marcas($id){
        return DB::select("SELECT DISTINCT variedad, nombre
            FROM op_embarques_productos
            LEFT JOIN cat_variedades ON op_embarques_productos.variedad_id = cat_variedades.id
            LEFT JOIN cat_marcas ON op_embarques_productos.marca_id = cat_marcas.id
            WHERE embarque_id = $id");
    }

    public static function get_presentations($embarque_id){
        return DB::select("SELECT variedad, sum(cantidad) as cantidad_total, peso, presentacion_id, presentacion, plural
            FROM op_embarques_productos
            LEFT JOIN cat_variedades ON op_embarques_productos.variedad_id = cat_variedades.id
            LEFT JOIN cat_presentaciones ON op_embarques_productos.presentacion_id = cat_presentaciones.id
            WHERE embarque_id = $embarque_id
            GROUP BY variedad, peso, presentacion_id, presentacion, plural");
    }

    public function calibre(){
        return $this->hasOne(Calibres::class, 'id', 'calibre_id');
    }

    public function categoria(){
        return $this->hasOne(Categorias::class, 'id', 'categoria_id');
    }

    public function tipo_cultivo(){
        return $this->hasOne(TipoCultivos::class, 'id', 'tipo_cultivo_id');
    }

    public function presentacion(){
        return $this->hasOne(Presentaciones::class, 'id', 'presentacion_id');
    }

}
