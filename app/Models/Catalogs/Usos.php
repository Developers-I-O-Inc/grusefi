<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_usos";

    protected $fillable = [
        "uso",
        "activo"
    ];
}
