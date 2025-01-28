<?php

// use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['can:ver_zonas']], function () {
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
    Route::get('get_localidades', 'LocalidadesController@get_localidades');
});
Route::group(['middleware' => ['can:ver_configuracion']], function () {
    // PRESENTACIONES
    Route::resource('presentaciones', 'PresentacionesController');
    Route::post('destroy_presentaciones', 'PresentacionesController@destroy_presentaciones');
    Route::get('get_presentaciones', 'PresentacionesController@get_presentaciones');
    // TIPO CULTIVO
    Route::resource('tipo_cultivos', 'TipoCultivosController');
    Route::post('destroy_tipo_cultivos', 'TipoCultivosController@destroy_tipo_cultivos');
    // PUERTOS
    Route::resource('puertos', 'PuertosController');
    Route::post('destroy_puertos', 'PuertosController@destroy_puertos');
    // EMPAQUES
    Route::resource('empaques', 'EmpaquesController');
    Route::post('destroy_empaques', 'EmpaquesController@destroy_empaques');

    // DESTINATARIOS
    Route::resource('destinatarios', 'DestinatariosController');
    Route::post('destroy_destinatarios', 'DestinatariosController@destroy_destinatarios');
    // MARCAS
    Route::resource('marcas', 'MarcasController');
    Route::post('destroy_marcas', 'MarcasController@destroy_marcas');
    // USOS
    Route::resource('usos', 'UsosController');
    Route::post('destroy_usos', 'UsosController@destroy_usos');
    Route::get('get_usos', 'UsosController@get_usos');
    // VARIEDADES
    Route::resource('variedades', 'VariedadesController');
    Route::post('destroy_variedades', 'VariedadesController@destroy_variedades');
    //VIGENCIAS
    Route::resource('vigencias', 'VigenciasController');
    Route::post('destroy_vigencias', 'VigenciasController@destroy_vigencias');
    //STANDARDS
    Route::resource('standards', 'StandardsController');
    Route::post('destroy_standards', 'StandardsController@destroy_standards');
});

Route::get('get_destinatarios', 'DestinatariosController@get_destinatarios');
Route::get('get_marcas', 'MarcasController@get_marcas');
Route::get('get_maquiladores', 'EmpaquesController@get_maquiladores');
Route::get('get_puertos', 'PuertosController@get_puertos');
