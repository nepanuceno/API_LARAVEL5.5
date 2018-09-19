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
Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('index');


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
    Route::get('/deleteRoles/{id}','Roles\RolesController@delete')->name('deleteRoles');

    Route::get('/listPermissions','Permissions\PermissionsController@list')->name('listPermissions');
    Route::get('/formPermissions','Permissions\PermissionsController@form')->name('formPermissions');
    Route::post('/addPermissions','Permissions\PermissionsController@add')->name('addPermissions');
    Route::get('/editPermissions','Permissions\PermissionsController@edit')->name('editPermissions');
    Route::post('/updatePermissions','Permissions\PermissionsController@update')->name('updatePermissions');
    Route::get('/deletePermissions/{id}','Permissions\PermissionsController@delete')->name('deletePermissions');

    Route::get('/userRoles/{id}','Usuario\UserRolesController@index')->name('userRoles');
    Route::get('/userRolesDelete/{id}/{id_usu}','Usuario\UserRolesController@delete')->name('userRolesDelete');
    Route::post('/userRolesVincular/{id}','Usuario\UserRolesController@vincular')->name('userRolesVincular');

    Route::post('/updateUsuario','Usuario\UsuariosController@update')->name('updateUsuario');
    Route::get('/perfil','Usuario\PerfilController@perfil')->name('perfil');
    Route::post('/alterarFoto','Usuario\PerfilController@alterarFoto')->name('alterarFoto');
});