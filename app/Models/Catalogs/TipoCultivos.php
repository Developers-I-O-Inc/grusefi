<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCultivos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_tipo_cultivos';

    protected $fillable = [
        'id',
        'tipo_cultivo',
        'activo',
    ];

}
