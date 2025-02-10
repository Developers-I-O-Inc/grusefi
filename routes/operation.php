<?php

use Illuminate\Support\Facades\Route;

// // PLANTILLAS
Route::get('plantillas_rpv', 'PlantillasController@plantillas_rpv')->name('plantillas_rpv');
Route::get('get_plantilla/{pais}/{variedad}', 'PlantillasController@get_plantilla');
Route::post('save_plantilla', 'PlantillasController@save_plantilla');
Route::post('edit_plantilla', 'PlantillasController@edit_plantilla');
Route::get('imprimir_dictamen/{id}', 'PlantillasController@imprimir_dictamen');
Route::get('imprimir_dictamen_embarque_rpv/{embarque_id}', 'PlantillasController@imprimir_dictamen_embarque_rpv');
Route::get('validate_plantilla/{pais}/{variedad}', 'PlantillasController@validate_plantilla');
// // EMBARQUES
Route::resource('embarques', 'EmbarquesController');
Route::get('embarques_admin', 'EmbarquesController@embarques_admin')->name('embarques_admin');
Route::get('get_embarque_edit/{embarque_id}', 'EmbarquesController@get_embarque_edit');
Route::get('get_products_embarque/{embarque_id}', 'EmbarquesController@get_products_embarque');
Route::get('get_standards_embarque/{embarque_id}', 'EmbarquesController@get_standards_embarque');
Route::post('save_products_embarque', 'EmbarquesController@save_products_embarque');
Route::post('save_standards_embarques', 'EmbarquesController@save_standards_embarques');
Route::post('save_embarque_rpv', 'EmbarquesController@save_embarque_rpv');
Route::post('finish_embarque_rpv', 'EmbarquesController@finish_embarque_rpv');
Route::post('import_products', 'EmbarquesController@import_products');
Route::get('delete_product_embarque/{product_id}', 'EmbarquesController@delete_product_embarque');
Route::post('cancel_embarque/{embarque_id}', 'EmbarquesController@cancel_embarque');
