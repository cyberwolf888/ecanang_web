<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Api\UserController@login')->name('login');
Route::post('/register', 'Api\UserController@register')->name('register');

Route::post('/getCanang', 'Api\CanangController@getCanang')->name('getCanang');
Route::post('/getCanangDetail', 'Api\CanangController@getCanangDetail')->name('getCanangDetail');
Route::post('/getDetailCanang', 'Api\CanangController@getDetailCanang')->name('getDetailCanang');

Route::post('/postTransaksi', 'Api\TransaksiController@postTransaksi')->name('postTransaksi');
Route::post('/getTransaksi', 'Api\TransaksiController@getTransaksi')->name('getTransaksi');
Route::post('/postPembayran', 'Api\TransaksiController@postPembayran')->name('postPembayran');