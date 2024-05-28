<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regulaciones extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_regulaciones";

    protected $fillable = [
        'id',
        'pais_id',
        'dictamen_apartado_4',
        'dictamen_apartado_5',
        'dictamen_apartado_11',
        'nombre_pais_dictamen',
        'nombre_pais_certificado',
        'activo_embarques',
        'rq_inspector',
        'rq_huertas',
        'rq_estudio_analisis',
        'rq_impresion',
    ];
}
