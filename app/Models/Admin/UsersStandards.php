<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersStandards extends Model
{
    use HasFactory;

    protected $table = 'cat_users_standards';
    protected $fillable = [
        'user_id',
        'standard_id',
        'validity'
    ];

    public static function user_standards($id){
        return DB::select('SELECT cat_users_standards.id, cat_users_standards.user_id, cat_users_standards.standard_id, cat_standards.name,
        cat_users_standards.validity
        FROM cat_users_standards INNER JOIN cat_standards ON cat_users_standards.standard_id = cat_standards.id
        WHERE user_id ='.$id);
    }

    public static function user_standards_select($id){
        return DB::select('SELECT cat_users_standards.standard_id AS id, cat_standards.name
        FROM cat_users_standards INNER JOIN cat_standards ON cat_users_standards.standard_id = cat_standards.id
        WHERE user_id ='.$id);
    }

    public static function user_standards_date($id)
{
    return DB::select('
        SELECT
            cat_users_standards.id,
            cat_users_standards.user_id,
            cat_users_standards.standard_id,
            cat_standards.name,
            cat_users_standards.validity,
            DATEDIFF(cat_users_standards.validity, CURDATE()) AS days_remaining
        FROM
            cat_users_standards
        INNER JOIN
            cat_standards
        ON
            cat_users_standards.standard_id = cat_standards.id
        WHERE
            cat_users_standards.user_id = ?
    ', [$id]);
}
}
