<?php

use Illuminate\Support\Facades\Route;


// DICTAMEN DE VERIFICACION
Route::get('dictamen_verificacion', 'DictamenVerificacionController@dictamen_verificacion');
// PLANTILLAS
Route::get('plantillas_rpv', 'PlantillasController@plantillas_rpv');
Route::get('get_plantilla/{pais}', 'PlantillasController@get_plantilla');
Route::post('save_plantilla', 'PlantillasController@save_plantilla');
Route::post('edit_plantilla', 'PlantillasController@edit_plantilla');
Route::get('imprimir_dictamen/{id}', 'PlantillasController@imprimir_dictamen');
Route::get('imprimir_dictamen_embarque/{pais_id}/{embarque_id}', 'PlantillasController@imprimir_dictamen_embarque');
// EMBARQUES
Route::resource('embarques', 'EmbarquesController');
Route::get('embarques_admin', 'EmbarquesController@embarques_admin');
