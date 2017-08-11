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

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'chat'], function(){

        Route::get('/', 'Web\ChatController@index')->name('chat');

        Route::group(['prefix' => 'private'], function(){

            Route::get('/{user_id}', 'Web\ChatController@private_chat')->name('private chat');

            Route::post('/send', 'Web\ChatController@send')->name('send private chat');
        });

    });
});
