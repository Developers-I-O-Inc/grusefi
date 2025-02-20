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
// EMBARQUES SMALL
Route::get('embarques_small', 'EmbarquesController@embarques_small')->name('embarques_small');
Route::post('save_embarques_small', 'EmbarquesController@save_embarques_small');
// EMBAQUES DV TEMPLATE
Route::get('new_dv_template', 'EmbarquesController@new_dv_template')->name('new_dv_template');
Route::post('save_new_dv_tamplate', 'EmbarquesController@save_new_dv_tamplate');
Route::get('copy_embarque_rpv/{id}', 'EmbarquesController@copy_embarque_rpv');
