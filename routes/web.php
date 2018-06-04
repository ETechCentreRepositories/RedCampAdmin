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



Route::get('/home', 'PagesController@home');
Route::get('/user', 'PagesController@user');

Route::resource('user', 'UsersController');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('export-user/{type}', 'UsersController@exportFile')->name('export.file');