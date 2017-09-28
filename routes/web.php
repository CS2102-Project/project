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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');
//Route::post('/register', 'Auth\RegisterController@create');
//Route::post('/login', 'Auth\LoginController@authenticate')->name('login');

Route::get('/users/{id}', 'UserController@show')->name('users.id');
Route::post('/users/{id}', 'UserController@show')->name('users.id');
Route::get('/items/form', 'ItemController@create')->name('newItemView');
Route::post('/items/new', 'ItemController@store')->name('newItemSubmit');
