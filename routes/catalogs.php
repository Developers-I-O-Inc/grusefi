<?php

use Illuminate\Support\Facades\Route;

// CATEGORIES
Route::resource('paises', 'PaisesController');
Route::post('destroy_paises', 'PaisesController@destroy_paises');
