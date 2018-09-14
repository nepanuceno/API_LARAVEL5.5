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

Route::get('/backend', 'HomeController@index')->name('index');
Route::get('/listaUsuarios','Usuario\UsuariosController@listar');

Route::get('/editaUsuario/{id}','Usuario\UsuariosController@editar');
Route::get('/updateStatusUsuario/{id}','Usuario\UsuariosController@updateStatus')->name('updateStatusUsuario');

Route::post('/updateUsuario','Usuario\UsuariosController@update')->name('updateUsuario');