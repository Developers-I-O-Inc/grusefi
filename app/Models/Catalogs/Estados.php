<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estados extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_estados";

    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'pais_id',
        'codigo',
        'activo'
    ];
}
