<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipios extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_municipios";

    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'activo',
        'codigo',
        'estado_id',
    ];
}
