<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vigencias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "cat_vigencias";

    protected $fillable = [
        "clave_aprobacion",
        "vigencia",
        "activo"
    ];
}
