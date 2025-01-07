<?php

use Illuminate\Support\Facades\Route;


// DICTAMEN DE VERIFICACION
Route::get('dictamen_verificacion', 'DictamenVerificacionController@dictamen_verificacion');
// PLANTILLAS
Route::get('plantillas_rpv', 'PlantillasController@plantillas_rpv');
Route::get('get_plantilla/{pais}/{variedad}', 'PlantillasController@get_plantilla');
Route::post('save_plantilla', 'PlantillasController@save_plantilla');
Route::post('edit_plantilla', 'PlantillasController@edit_plantilla');
Route::get('imprimir_dictamen/{id}', 'PlantillasController@imprimir_dictamen');
Route::get('imprimir_dictamen_embarque/{pais_id}/{embarque_id}', 'PlantillasController@imprimir_dictamen_embarque');
Route::get('imprimir_dictamen_embarque_rpv/{embarque_id}', 'PlantillasController@imprimir_dictamen_embarque_rpv');
Route::get('validate_plantilla/{pais}/{variedad}', 'PlantillasController@validate_plantilla');
// EMBARQUES
Route::resource('embarques', 'EmbarquesController');
Route::get('embarques_admin', 'EmbarquesController@embarques_admin');
Route::get('get_embarque_edit/{embarque_id}', 'EmbarquesController@get_embarque_edit');
Route::get('get_products_embarque/{embarque_id}', 'EmbarquesController@get_products_embarque');
Route::get('get_marcas_embarque/{embarque_id}', 'EmbarquesController@get_marcas_embarque');
Route::post('save_products_embarque', 'EmbarquesController@save_products_embarque');
Route::post('save_marcas_embarques', 'EmbarquesController@save_marcas_embarques');
Route::post('save_embarque_rpv', 'EmbarquesController@save_embarque_rpv');
Route::post('finish_embarque_rpv', 'EmbarquesController@finish_embarque_rpv');
Route::post('import_products', 'EmbarquesController@import_products');
