<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
    'as'=>'index', 'uses' => 'SearchController@index'
]);

//route for search
Route::post('/search',[
    'as'=>'search', 'uses' => 'SearchController@search'
]);

Route::get('/profile',[
    'as'=>'profile', 'uses' => 'SearchController@viewProfile'
]);

Route::get('/load_follower',[
    'as'=>'load_follower', 'uses' => 'SearchController@loadFollower'
]);
