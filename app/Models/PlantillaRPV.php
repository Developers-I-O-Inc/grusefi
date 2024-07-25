<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlantillaRPV extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plantilla_rpv';

    protected $fillable = [
        'pais_id',
        'ss_dictamen_verificacion',
        'ss_certificado_movilizacion',
        'ss_certificado_internacional',
        'ss_otro'
    ];
}
