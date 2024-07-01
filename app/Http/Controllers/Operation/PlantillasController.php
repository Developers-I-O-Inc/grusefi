<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input;

class PlantillasController extends Controller
{
    public function plantillas_rpv(){
        return view("operation/rpv");
    }

}
