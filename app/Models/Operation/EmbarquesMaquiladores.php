<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmbarquesMaquiladores extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "op_embarques_maquiladores";
    protected $fillable = [
        'embarque_id',
        'maquilador_id'
    ];
}
