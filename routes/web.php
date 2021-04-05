<?php

use Illuminate\Support\Facades\Route;

// Auth::routes();

Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('{any?}', function () {
    return view('App');
})->where('any', '^(?!api).*');
