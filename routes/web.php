<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', 'ApiController@contact');

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'cors'], function() {

   Route::post('/web-api/{endpoint}', 'ApiController@api')->name('api');
   
});

Route::get('/admin/{endpoint?}', 'AdminController@interpret');
Route::post('/admin/{endpoint}', 'AdminController@interpret');

Route::get('/verify-email/{token}', 'ApiController@verify')->name('verify');

Route::get('/home', 'HomeController@index')->name('home');
