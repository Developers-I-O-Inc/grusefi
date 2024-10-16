<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmbarquesMarcas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'op_embarques_marcas';
    protected $fillable = [
        'embarque_id',
        'marca_id'
    ];
}
