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

    Route::resource('users', 'UserController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('rooms', 'RoomController');
    Route::resource('meetings', 'MeetingController');

    Route::get('/', function () {
        return view('layouts.base');
    })->name('home');
});