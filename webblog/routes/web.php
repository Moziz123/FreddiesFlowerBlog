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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');








Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@profile');
    Route::post('/addProfile', 'ProfileController@addProfile');
    Route::get('/post', 'PostController@post');
    Route::post('/addPost', 'PostController@addPost');
    
});