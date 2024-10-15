<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embarques extends Model
{
    use HasFactory;

    protected $table = "embarques";

    protected $fillable = [
        'empaque_id',
        'destinatario_id',
        'pais_id',
        'puerto_id',
        'fecha_embarque',
        'numero_economico',
        'placas_trasporte'
    ];
}
