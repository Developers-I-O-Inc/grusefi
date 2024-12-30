<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Standards extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cat_standards';

    protected $fillable = ['name', 'description', 'activo'];
}
