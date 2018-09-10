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

/*Route::get('/', function () {
    return view('auth.login');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/view/{id}', 'ManagePostController@view');








Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@profile');    
    Route::get('/post', 'PostController@post');    
    Route::get('/edit/{id}', 'ManagePostController@edit');
    Route::get('/deletePost/{id}', 'PostController@deletePost');

    Route::post('/addProfile', 'ProfileController@addProfile');
    Route::post('/addPost', 'PostController@addPost');
    Route::post('/editPost/{id}', 'PostController@editPost');
    Route::post('/comments/{id}', 'CommentController@addComment'); 
});