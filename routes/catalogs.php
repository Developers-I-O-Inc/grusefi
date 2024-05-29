<?php

use Illuminate\Support\Facades\Route;

// PAISES
Route::resource('paises', 'PaisesController');
Route::post('destroy_paises', 'PaisesController@destroy_paises');
// ESTADOS
Route::resource('estados', 'EstadosController');
Route::post('destroy_estados', 'EstadosController@destroy_estados');
Route::get('get_estados', 'EstadosController@get_estados');
// MUNICIPIOS
Route::resource('municipios', 'MunicipiosController');
Route::post('destroy_municipios', 'MunicipiosController@destroy_municipios');
Route::get('get_municipios', 'MunicipiosController@get_municipios');
// LOCALIDADES
Route::resource('localidades', 'LocalidadesController');
Route::post('destroy_localidades', 'LocalidadesController@destroy_localidades');
// REGULACIONES
Route::resource('regulaciones', 'RegulacionesController');
Route::post('destroy_regulaciones', 'RegulacionesController@destroy_regulaciones');
// CALIBRES
Route::resource('calibres', 'CalibresController');
Route::post('destroy_calibres', 'CalibresController@destroy_calibres');
// CATEGORIAS
Route::resource('categorias', 'CategoriasController');
Route::post('destroy_categorias', 'CategoriasController@destroy_categorias');
// PRESENTACIONES
Route::resource('presentaciones', 'PresentacionesController');
Route::post('destroy_presentaciones', 'PresentacionesController@destroy_presentaciones');
// FLORACIONES
Route::resource('floraciones', 'FloracionesController');
Route::post('destroy_floraciones', 'FloracionesController@destroy_floraciones');
// TIPO CULTIVO
Route::resource('tipo_cultivos', 'TipoCultivosController');
Route::post('destroy_tipo_cultivos', 'TipoCultivosController@destroy_tipo_cultivos');
// PUERTOS
Route::resource('puertos', 'PuertosController');
Route::post('destroy_puertos', 'PuertosController@destroy_puertos');
