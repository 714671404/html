<?php

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('token/refresh', 'Auth\LoginController@refresh');
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('user', 'Auth\LoginController@user');
});