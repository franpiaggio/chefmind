<?php
// Web
Route::get('/', 'HomeController@index');
Route::get('/buscar', 'HomeController@search');
Route::get('/recetas', 'HomeController@list');
Route::get('/contacto', 'ContactoController@index');
Route::post('/contacto', 'ContactoController@send');
// Admin Usuarios
Route::get('/admin/usuarios/{id}/editar', 'AdminController@editUser');
Route::get('/admin/usuarios/{id}/ban', 'AdminController@ban');
Route::get('/admin/usuarios/{id}/borrar', 'AdminController@delete');
Route::patch('/admin/usuarios/{id}', 'AdminController@update');
Route::get('/admin/usuarios', 'AdminController@adminUsers');
// Admin ingredientes
Route::get('/admin/ingredientes', 'AdminController@adminIngredients');
Route::post('/admin/ingredientes/nuevo', 'AdminController@newIngredient');
Route::get('/admin/ingredientes/{id}/borrar', 'AdminController@deleteIngredient');
Route::post('/admin/ingredientes/{id}/editar', 'AdminController@editIngredient');
Route::post('/admin/ingredientes/{id}/reasignar', 'AdminController@reasignIngredient');
// Admin categorías
Route::get('/admin/categorias', 'AdminController@adminCats');
Route::post('/admin/categorias/nueva', 'AdminController@createCat');
Route::get('/admin/categorias/nueva', 'AdminController@newCat');
Route::patch('/admin/categoria/{id}', 'AdminController@updateCat');
Route::get('/admin/categoria/{id}/editar', 'AdminController@editCat');
Route::get('/admin/categoria/{id}/activar', 'AdminController@activateCats');
Route::get('/admin/categoria/{id}/borrar', 'AdminController@deleteCat');
// Admin recetas
Route::get('/admin/recetas', 'AdminController@listRecipes');
Route::get('/admin/recetas/{id}/borrar', 'AdminController@deleteRecipe');
Route::get('/admin/buscar', 'AdminController@searchRecipe');
// Admin
Route::get('/admin', 'AdminController@index');
// Recetas
Route::get('/recetas', 'RecetasController@index');
Route::get('/recetas/nueva', 'RecetasController@create');
Route::get('/recetas/{id}/crear-galeria', 'RecetasController@createGallery');
Route::post('/recetas/{id}/galeria', 'RecetasController@storeGallery');
Route::get('/recetas/mis-recetas', 'RecetasController@userRecipes');
Route::get('/recetas/{id}', 'RecetasController@show');
Route::get('/recetas/{id}/editar', 'RecetasController@edit');
Route::post('/recetas', 'RecetasController@store');
Route::post('/likeReceta', 'RecetasController@likeReceta');
Route::post('/favReceta', 'RecetasController@favReceta');
Route::post('rateReceta', 'RecetasController@rateReceta');
Route::patch('/recetas/{id}', 'RecetasController@update');
Route::delete('/recetas/{id}', 'RecetasController@delete');
Route::post('/borrarFoto', 'RecetasController@deleteImg');
// Comentarios
Route::post('/recetas/{id}/comment', 'CommentsController@store');
Route::get('/comment/{id}/delete', 'CommentsController@delete');
// Categorias
Route::get('/categorias', 'CategoriesController@index');
Route::get('/categoria/{id}', 'CategoriesController@show');
Route::post('/categoria', 'CategoriesController@store');
// Perfil
Route::get('/miperfil/editar', 'PerfilController@editProfile');
Route::get('/miperfil/editar/contraseña', 'PerfilController@editPass');
Route::patch('/miperfil/editar', 'PerfilController@updateProfile');
Route::post('/miperfil/editarContraseña', 'PerfilController@updatePass');
Route::get('/miperfil', 'PerfilController@index');
Route::get('/miperfil/mis-favoritos', 'PerfilController@userFavs');
Route::get('/miperfil/borrarReceta/{id}', 'PerfilController@borrarReceta');
Route::get('/miperfil/seguidos', 'PerfilController@usersFollowed');
Route::post('/followUser', 'PerfilController@followUser');
// Perfiles publicos
Route::get('/perfil/{id}', 'UserController@getProfile');
// Auth laravel
Auth::routes();
