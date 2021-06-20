<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
	Route::get('index','UserController@index')->name('user.index');
	Route::post('store','UserController@store')->name('user.store');
	Route::get('edit/{id}','UserController@edit')->name('user.edit');
	Route::post('update/{id}','UserController@update')->name('user.update');
	Route::get('delete/{id}','UserController@delete')->name('user.delete');
});

Route::group(['prefix'=>'book','middleware'=>'auth'],function(){
	Route::get('index','BookController@index')->name('book.index');
	Route::post('store','BookController@store')->name('book.store');
	Route::get('edit/{id}','BookController@edit')->name('book.edit');
	Route::post('update/{id}','BookController@update')->name('book.update');
	Route::get('delete/{id}','BookController@delete')->name('book.delete');
});
