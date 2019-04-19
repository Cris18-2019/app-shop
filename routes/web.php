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

Route::get('/','TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
		Route::get('/products','ProductController@index');/*listado de productos y el metodo que devolera el listado de productos es @index*/
		Route::get('/products/create','ProductController@create');//CREAR un nuevo producto 
		//PETICIONES GET LAS USAMOS CUANDO QUEREMOS CONSULTAR INFORMACIÓN
		//LAS PETICIONES POST CUANDO QUEREMOS REGISTRAR INFORMACIÓN
		//PARA VER EL FORMULARIO DONDE INTRODUCIREMOS LA INFORMACIÓN UTILIZAREMOS UNA PETICION GET 

		Route::post('/products','ProductController@store');//Con esta petición se guardara 

		Route::get('/products/{id}/edit','ProductController@edit');//formulario ediciopn de productos
		Route::post('/products/{id}/edit','ProductController@update');//actualizar los datos del producto

		Route::delete('/products/{id}','ProductController@destroy');//para borrar

});





