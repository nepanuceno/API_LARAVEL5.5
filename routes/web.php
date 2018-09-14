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



Auth::routes();

Route::get('/', function () {
    //return view('backend.index');
    return redirect('/backend');
});

Route::get('/roles_permissions', 'HomeController@rolesPermissions');

Route::get('/backend', 'HomeController@index')->name('index');
Route::get('/listaUsuarios','Usuario\UsuariosController@listar');

Route::get('/editaUsuario/{id}','Usuario\UsuariosController@editar');
Route::get('/updateStatusUsuario/{id}','Usuario\UsuariosController@updateStatus')->name('updateStatusUsuario');

Route::get('/listRoles','Roles\RolesController@list')->name('listRoles');
Route::get('/formRoles','Roles\RolesController@form')->name('formRoles');
Route::post('/addRoles','Roles\RolesController@add')->name('addRoles');
Route::get('/editRoles','Roles\RolesController@edit')->name('editRoles');
Route::post('/updateRoles','Roles\RolesController@update')->name('updateRoles');
Route::get('/deleteRoles','Roles\RolesController@delete')->name('deleteRoles');

Route::post('/updateUsuario','Usuario\UsuariosController@update')->name('updateUsuario');