<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        'colonia',
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
        'tipo',
        'activo',
    ];

    public static function get_empaques(){
        return DB::select("SELECT
            empaques.nombre_corto,
            nombre_fiscal,
            CONCAT_WS(', ',
                CONCAT_WS(' ',
                    empaques.domicilio_fiscal,
                    CONCAT('#', empaques.num_ext),
                    IF(empaques.num_int IS NOT NULL AND empaques.num_int != '', CONCAT('INT.', empaques.num_int), NULL)
                ),
                empaques.colonia,
                CONCAT('CP.', empaques.cp),
                cat_municipios.nombre,
                cat_localidades.nombre
            ) AS domicilio_fiscal,
            rfc,
            telefonos,
            sader,
            exportacion,
            asociado,
            tipo,
            empaques.id,
            empaques.activo
        FROM cat_empaques AS empaques
        INNER JOIN cat_localidades ON empaques.localidad_id = cat_localidades.id
        INNER JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
        WHERE empaques.deleted_at IS NULL
        ORDER BY empaques.nombre_fiscal ASC;");
    }
    public static function get_empaques_localidad($id){
        return DB::select("SELECT cat_empaques.id, localidad_id, localidades.municipio_id, localidad_doc_id, localidades2.municipio_id as municipio2,
            cat_empaques.nombre_corto, nombre_fiscal, domicilio_fiscal, num_ext,num_int, tipo,
            cp, rfc ,telefonos ,imagen ,nombre_embarque, domicilio_documentacion, sader, cat_empaques.codigo, exportacion, asociado, cat_empaques.activo, colonia
            FROM  cat_empaques LEFT JOIN cat_localidades localidades ON cat_empaques.localidad_id = localidades.id
            LEFT JOIN cat_localidades localidades2 ON cat_empaques.localidad_doc_id = localidades2.id
            WHERE cat_empaques.deleted_at IS NULL AND cat_empaques.id = $id
       ");
    }

    public static function get_empaques_by_country(){
        $countries = UsersCountries::where('user_id', auth()->user()->id)->get();
        if($countries->count() == 0){
            return [];
        }
        $array = [];
        foreach ($countries as $country) {
            $array[] = $country->estado_id;
        }
        $countriesList = implode(",", $array);
        return DB::select("SELECT cat_empaques.id, nombre_fiscal
            FROM  cat_empaques
            INNER JOIN cat_localidades ON cat_empaques.localidad_id = cat_localidades.id
            INNER JOIN cat_municipios ON cat_localidades.municipio_id = cat_municipios.id
            WHERE cat_empaques.deleted_at IS NULL AND cat_empaques.activo = 1
                AND cat_municipios.estado_id IN ($countriesList)");
    }
}
