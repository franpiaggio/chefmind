<?php

Route::get('/', 'HomeController@index');
Route::get('/contacto', 'ContactoController@index');

Route::get('/admin/usuarios/{id}/editar', 'AdminController@editUser');
Route::get('/admin/usuarios/{id}/ban', 'AdminController@ban');
Route::get('/admin/usuarios/{id}/borrar', 'AdminController@delete');
Route::patch('/admin/usuarios/{id}', 'AdminController@update');
Route::get('/admin/usuarios', 'AdminController@adminUsers');
Route::get('/admin', 'AdminController@index');

Route::get('/recetas', 'RecetasController@index');
Route::get('/recetas/nueva', 'RecetasController@create');
Route::get('/recetas/mis-recetas', 'RecetasController@userRecipes');
Route::get('/recetas/{id}', 'RecetasController@show');
Route::get('recetas/{id}/editar', 'RecetasController@edit');
Route::post('/recetas', 'RecetasController@store');
Route::patch('/recetas/{id}', 'RecetasController@update');
Route::delete('/recetas/{id}', 'RecetasController@delete');

Auth::routes();
