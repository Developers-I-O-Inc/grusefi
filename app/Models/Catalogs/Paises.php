<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paises extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_paises';

    protected $fillable = [
        'id',
        'codigo',
        'nombre',
        'nombre_corto',
        'activo',
    ];
}
