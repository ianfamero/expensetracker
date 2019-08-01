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

    Route::get('/get-user', 'HeaderController@getUser');

    // TRACKER
    Route::post('/tracker/get-datas', 'TrackerController@getDatas');
    Route::post('/tracker/add', 'TrackerController@addExpense');
Route::get('/tracker/delete/{id}', 'TrackerController@deleteExpense');

    // FUND
    Route::get('/funds/get-datas', 'FundController@getDatas');
    Route::post('/funds/add', 'FundController@addFund');
    Route::post('/funds/transfer', 'FundController@transferFunds');


    Route::get('/{any}', 'RouterController@index')->where('any', '.*');
});