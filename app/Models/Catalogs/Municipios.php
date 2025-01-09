<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Municipios extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cat_municipios";

    protected $fillable = [
        'id',
        'nombre',
        'nombre_corto',
        'activo',
        'codigo',
        'estado_id',
    ];

    public static function municipios_by_user($user_id){
        $estados = UsersCountries::select("estado_id")->where('user_id', $user_id)->get();
        if($estados->count() == 0){
            return [];
        }
        else{
            $estados = $estados->pluck('estado_id')->toArray();
            return DB::select("SELECT id, nombre FROM cat_municipios WHERE estado_id IN (".implode(",", $estados).")");
        }
    }
}
