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

Route::namespace('Auth')->group(function() {
    Route::get('/login', 'LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::middleware('auth')->group( function() {

    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('meetings', 'MeetingController')->except('show');

    Route::middleware('admin')->group( function() {
        Route::resource('users', 'UserController')->except('show');
        Route::resource('departments', 'DepartmentController')->except('show');
        Route::resource('rooms', 'RoomController')->except('show');
    });
});