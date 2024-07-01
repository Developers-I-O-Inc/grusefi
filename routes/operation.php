<?php

use Illuminate\Support\Facades\Route;


// DICTAMEN DE VERIFICACION
Route::get('dictamen_verificacion', 'DictamenVerificacionController@dictamen_verificacion');
// PLANTILLAS
Route::get('plantillas_rpv', 'PlantillasController@plantillas_rpv');
