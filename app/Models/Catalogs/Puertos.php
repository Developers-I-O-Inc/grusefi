<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puertos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_puertos";
    protected $fillable = [
        'id',
        'municipio_id',
        'puerto',
        'nombre_corto',
        'medio_transporte',
        'placas',
        'activo',
    ];
}
