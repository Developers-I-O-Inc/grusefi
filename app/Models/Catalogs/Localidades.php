<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidades extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_localidades";

    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'codigo',
        'activo',
        'municipio_id',
    ];
}
