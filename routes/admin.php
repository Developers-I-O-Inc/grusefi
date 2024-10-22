<?php

use Illuminate\Support\Facades\Route;


// ROLES
Route::resource('roles', 'RolesController');
Route::post('destroy_roles', 'RolesController@destroy_roles');

//USERS
Route::resource("users", "App\Http\Controllers\UsersController");
Route::post("destroy_users", "App\Http\Controllers\UsersController@destroy_users");
Route::get('get_user_permission', 'App\Http\Controllers\UsersController@get_user_permission');
Route::post('save_user_permissions', 'App\Http\Controllers\UsersController@save_user_permissions');
Route::get("reset_pass/{id}", 'App\Http\Controllers\UsersController@reset_pass');
