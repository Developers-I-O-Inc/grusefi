<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_categorias';

    protected $fillable = [
        'id',
        'categoria',
        'activo',
    ];
}
