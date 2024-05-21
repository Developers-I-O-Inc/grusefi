<?php

use Illuminate\Support\Facades\Route;

// PAISES
Route::resource('paises', 'PaisesController');
Route::post('destroy_paises', 'PaisesController@destroy_paises');
// ESTADOS
Route::resource('estados', 'EstadosController');
Route::post('destroy_estados', 'EstadosController@destroy_estados');
// ESTADOS
Route::resource('municipios', 'MunicipiosController');
Route::post('destroy_municipios', 'MunicipiosController@destroy_municipios');
