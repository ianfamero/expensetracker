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

Route::get('/', 'Auth\LoginController@index')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::post('/register', 'RegisterController@register');

Route::group(['middleware' => ['auth:web']], function() {

    Route::get('/{any}', 'RouterController@index')->where('any', '.*');
});