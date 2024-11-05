<?php

namespace App\Models\Operation;

use App\Models\Catalogs\Calibres;
use App\Models\Catalogs\Categorias;
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
        'categoria_id',
        'tipo_cultivo_id',
        'presentacion_id',
        'calibre_id',
        'folio_pallet',
        'sader',
        'cajas',
        'lote',
        'tipo_fruta',
        'n_registros'
    ];

    public static function get_embarque_products($id){
        return DB::select("SELECT op_embarques_productos.id, embarque_id, categoria_id, categoria, tipo_cultivo_id, tipo_cultivo, presentacion_id,
            presentacion, calibre_id, calibre, folio_pallet, sader, cajas, lote, tipo_fruta, n_registros, peso,
            (cajas * peso) as total_kilos
        FROM op_embarques_productos
        LEFT JOIN cat_categorias ON op_embarques_productos.categoria_id = cat_categorias.id
        LEFT JOIN cat_tipo_cultivos ON op_embarques_productos.tipo_cultivo_id = cat_tipo_cultivos.id
        LEFT JOIN cat_presentaciones ON op_embarques_productos.presentacion_id = cat_presentaciones.id
        LEFT JOIN cat_calibres ON op_embarques_productos.calibre_id = cat_calibres.id
        WHERE embarque_id = $id");
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
