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

    Route::get('/', 'WelcomeController@index');
    Route::bind('people', function($id){
        return Laravel\People::whereId($id)->first();
    });
    Route::get('/check-url', 'WelcomeController@checkUrl');
    Route::get('/edit/{id}', 'WelcomeController@edit');
    Route::get('/delete/{id}', 'WelcomeController@delete');
    Route::get('/login', 'UserController@login' );