<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Presentaciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_presentaciones";

    protected $fillable = [
        'id',
        'presentacion',
        'plural',
        'activo',
    ];

}
