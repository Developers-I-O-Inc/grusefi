<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floraciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_floraciones";

    protected $fillable = [
        'id',
        'floracion',
        'activo',
    ];
}
