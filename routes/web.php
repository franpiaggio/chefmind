<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/contacto', 'ContactoController@index');

Route::get('/admin/usuarios/{id}/editar', 'AdminController@editUser');
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

Auth::routes();
