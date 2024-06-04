<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calibres extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cat_calibres';

    protected $fillable = [
        'id',
        'calibre',
        'activo'
    ];
}
