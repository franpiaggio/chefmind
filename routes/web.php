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
Route::get('/admin', 'AdminController@index');

Route::get('/recetas', 'RecetasController@index');
Route::get('/recetas/{id}', 'RecetasController@show');
Auth::routes();
