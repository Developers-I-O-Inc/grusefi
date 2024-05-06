<?php

use Illuminate\Support\Facades\Route;


// ROLES
Route::resource('roles', 'RolesController');
Route::post('destroy_roles', 'RolesController@destroy_roles');
