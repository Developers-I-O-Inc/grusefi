<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosEmbarques extends Model
{
    use HasFactory;

    protected $table = "productos_embarques";

    protected $fillable = [
        'id',
        'categoria_id',
        'tipo_cultivo_id',
        'presentacion_id',
        'calibre_id',
        'folio_pallet',
        'sader',
        'cajas',
        'peso',
        'lote',
        'tipo_fruta',
    ];
}
