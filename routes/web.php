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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', 'ProfileController@show')->name('profile');
    Route::get('/media', 'MediaController@index')->name('media.index');
    Route::get('/media/create', 'MediaController@create')->name('media.create');
    Route::post('/media/create', 'MediaController@uploadFile')->name('media.upload');

    Route::resource('posts', 'PostsController');
    Route::resource('users', 'UsersController');
});

Route::get('/home', 'HomeController@index')->name('home');
