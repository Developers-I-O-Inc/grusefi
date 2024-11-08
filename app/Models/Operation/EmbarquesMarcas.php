<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class EmbarquesMarcas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'op_embarques_marcas';
    protected $fillable = [
        'embarque_id',
        'marca_id'
    ];

    public static function get_marcas_embarque($embarque_id){
        return DB::select("SELECT marca_id, cat_marcas.nombre as marca FROM op_embarques_marcas
            LEFT JOIN cat_marcas ON op_embarques_marcas.marca_id = cat_marcas.id
            WHERE embarque_id = $embarque_id and op_embarques_marcas.deleted_at is null");
    }
}
