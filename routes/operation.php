<?php

use Illuminate\Support\Facades\Route;


// DICTAMEN DE VERIFICACION
Route::get('dictamen_verificacion', 'DictamenVerificacionController@dictamen_verificacion');
// PLANTILLAS
Route::get('plantillas_rpv', 'PlantillasController@plantillas_rpv');
Route::get('get_plantilla/{pais}', 'PlantillasController@get_plantilla');
Route::post('save_plantilla', 'PlantillasController@save_plantilla');
Route::post('save_plantilla', 'PlantillasController@save_plantilla');
Route::get('imprimir_dictamen', 'PlantillasController@imprimir_dictamen');
Route::get('imprimir_dictamen2', 'PlantillasController@imprimir_dictamen2');
