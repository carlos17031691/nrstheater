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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/disponibilidad/{fecha}','ButacaController@disponibilidad');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/usuarios','UserController');
Route::post('/usuarios/delete','UserController@destroy');
Route::post('/usuarios/store','UserController@store');
Route::post('/usuarios/update','UserController@update');
Route::get('/usuarios/edit/{id}','UserController@edit');
Route::resource('reservas','ReservaController');
Route::post('/reservas/store','ReservaController@store');
});