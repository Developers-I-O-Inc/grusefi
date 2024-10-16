<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
