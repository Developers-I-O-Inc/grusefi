<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Catalogs\Paises;
use App\Models\PlantillaRPV;
use Illuminate\Http\Request;

class PlantillasController extends Controller
{
    public function plantillas_rpv(){
        $paises = Paises::all();
        return view("operation/rpv", compact('paises'));
    }

    public function save_plantilla(Request $request) {
        $datos = $request->json()->all();

        $registro = new PlantillaRPV();

        foreach ($datos as $campo => $valor) {
            $registro->$campo = $valor;
        }

        $registro->save();

        return response()->json(['mensaje' => 'Datos guardados con éxito'], 200);
    }

    public function get_plantilla($pais){
        $plantilla = PlantillaRPV::where("pais_id", $pais)->get();

        return response()->json(["plantilla"=>$plantilla]);
    }

}
