<?php

namespace App\Models\Catalogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersCountries extends Model
{
    use HasFactory;

    protected $table = 'cat_users_countries';
    protected $fillable = [
        'id',
        'user_id',
        'estado_id',
    ];

    public static function user_countries($id){
        return DB::select('SELECT cat_users_countries.id, cat_users_countries.user_id, cat_users_countries.estado_id, cat_estados.nombre
        FROM cat_users_countries INNER JOIN cat_estados ON cat_users_countries.estado_id = cat_estados.id
        WHERE user_id ='.$id);
    }
}
