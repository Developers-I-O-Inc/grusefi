<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class EmbarquesStandards extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'op_embarques_standards';
    protected $fillable = [
        'embarque_id',
        'standard_id',
        'observations'
    ];

    public static function get_standards_embarque($embarque_id){
        return DB::table('op_embarques_standards')
            ->join('cat_standards', 'op_embarques_standards.standard_id', '=', 'cat_standards.id')
            ->select('cat_standards.id', 'cat_standards.name', 'cat_standards.description', 'op_embarques_standards.observations')
            ->where('op_embarques_standards.embarque_id', '=', $embarque_id)
            ->where('op_embarques_standards.deleted_at', '=', null)
            ->get();
    }
}
