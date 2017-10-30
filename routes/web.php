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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin-access'], 'as'=>'admin'], function() {

    //Dashboard
    Route::get('/', 'Admin\DashboardController@index')->name('.dashboard');

    //Canang
    Route::group(['prefix' => 'canang', 'middleware' => ['auth','role:admin-access'], 'as'=>'.canang'], function() {
        Route::get('/', 'Admin\CanangController@index')->name('.manage');
        Route::get('/create', 'Admin\CanangController@create')->name('.create');
        Route::post('/store', 'Admin\CanangController@store')->name('.store');
        Route::get('/edit/{id}', 'Admin\CanangController@edit')->name('.edit');
        Route::post('/update/{id}', 'Admin\CanangController@update')->name('.update');
        Route::get('/detail/{id}', 'Admin\CanangController@show')->name('.detail');
    });

    //Users
    Route::group(['prefix' => 'user', 'middleware' => ['auth','role:admin-access'], 'as'=>'.user'], function() {

        Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin-access'], 'as'=>'.admin'], function() {
            Route::get('/', 'Admin\UserController@admin')->name('.manage');
            Route::get('/create', 'Admin\UserController@create_admin')->name('.create');
            Route::post('/store', 'Admin\UserController@store_admin')->name('.store');
            Route::get('/edit/{id}', 'Admin\UserController@edit_admin')->name('.edit');
            Route::post('/update/{id}', 'Admin\UserController@update_admin')->name('.update');
        });

        Route::group(['prefix' => 'member', 'middleware' => ['auth','role:admin-access'], 'as'=>'.member'], function() {
            Route::get('/', 'Admin\UserController@member')->name('.manage');
            Route::get('/create', 'Admin\UserController@create_member')->name('.create');
            Route::post('/store', 'Admin\UserController@store_member')->name('.store');
            Route::get('/edit/{id}', 'Admin\UserController@edit_member')->name('.edit');
            Route::post('/update/{id}', 'Admin\UserController@update_member')->name('.update');
        });
    });

    //Transaksi
    Route::group(['prefix' => 'transaksi', 'middleware' => ['auth','role:admin-access'], 'as'=>'.transaksi'], function() {
        Route::get('/', 'Admin\TransaksiController@index')->name('.manage');
        Route::get('/detail/{id}', 'Admin\TransaksiController@show')->name('.detail');
        Route::get('/batal/{id}', 'Admin\TransaksiController@batal')->name('.batal');
        Route::get('/confirmPayment/{id}', 'Admin\TransaksiController@confirmPayment')->name('.confirmPayment');
        Route::get('/cancelPayment/{id}', 'Admin\TransaksiController@cancelPayment')->name('.cancelPayment');
        Route::post('/cancelPayment/{id}', 'Admin\TransaksiController@prosesCancelPayment')->name('.prosesCancelPayment');
        Route::get('/dikirim/{id}', 'Admin\TransaksiController@dikirim')->name('.dikirim');
        Route::get('/selesai/{id}', 'Admin\TransaksiController@selesai')->name('.selesai');
        Route::get('/invoice/{id}', 'Admin\TransaksiController@invoice')->name('.invoice');
    });

    //Laporan
    Route::group(['prefix' => 'laporan', 'middleware' => ['auth','role:admin-access'], 'as'=>'.laporan'], function() {
        Route::get('/', 'Admin\LaporanController@priod')->name('.priod');
        Route::post('/result', 'Admin\LaporanController@result')->name('.result');
    });

});