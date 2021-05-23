<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// backend routing
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('users')->group(function () {

        Route::get('/view', 'Backend\UserController@view')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    });


    Route::prefix('profiles')->group(function () {

        Route::get('/store', 'Backend\ProfileController@view')->name('profiles.view');
        Route::get('/view', 'Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('/add', 'Backend\ProfileController@update')->name('profiles.update');
        Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
    });

    // supplies middleware 

    Route::prefix('suppliers')->group(function () {

        Route::get('/view', 'Backend\SupplierController@view')->name('suppliers.view');
        Route::get('/add', 'Backend\SupplierController@add')->name('suppliers.add');
        Route::post('/store', 'Backend\SupplierController@store')->name('suppliers.store');
        Route::get('/edit/{id}', 'Backend\SupplierController@edit')->name('suppliers.edit');
        Route::post('/update/{id}', 'Backend\SupplierController@update')->name('suppliers.update');
        Route::get('/delete/{id}', 'Backend\SupplierController@delete')->name('suppliers.delete');
    });
});
























// Route::prefix('sliders')->group(function(){
//     Route::get('/view','Backend\UserController@view')->name('users.view');
//     Route::get('/add','Backend\UserController@add')->name('users.add');
//     Route::post('/store','Backend\UserController@store')->name('users.store');
//     Route::get('/edit/{id}','Backend\UserController@edit')->name('users.edit');
//     Route::post('/update/{id}','Backend\UserController@update')->name('users.update');
//     Route::get('/delete/{id}','Backend\UserController@delete')->name('users.delete');
// });
