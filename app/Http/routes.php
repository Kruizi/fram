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
    Route::get('/check-url', 'StatusController@index');
    Route::get('/edit/{id}', 'WelcomeController@edit');
    Route::get('/delete/{id}', 'WelcomeController@delete');
    // POST-запрос при нажатии на нашу кнопку.
    Route::post('/more', array('before'=>'csrf-ajax', 'as'=>'more', 'uses'=>'StatusController@getMore'));
    Route::post('/check', array('before'=>'csrf-ajax', 'as'=>'check', 'uses'=>'WelcomeController@getUrl'));

    // Фильтр, срабатывающий перед пост запросом.
    Route::filter('csrf-ajax', function()
    {
        if (Session::token() != Request::header('x-csrf-token'))
        {
            throw new Illuminate\Session\TokenMismatchException;
        }
    });