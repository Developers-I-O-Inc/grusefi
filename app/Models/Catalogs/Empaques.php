<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empaques extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_empaques";

    protected $fillable = [
        'id',
        'localidad_id',
        'localidad_doc_id',
        'nombre_corto',
        'nombre_fiscal',
        'domicilio_fiscal',
        'num_ext',
        'num_int',
        'cp',
        'rfc',
        'telefonos',
        'imagen',
        'nombre_embarque',
        'domicilio_documentacion',
        'codigo',
        'sader',
        'exportacion',
        'asociado',
        'activo',
    ];
}
