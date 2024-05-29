<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calibres extends Model
{
    use HasFactory;

    protected $table = 'cat_calibres';

    protected $fillable = [
        'id',
        'calibre',
        'activo'
    ];
}
