<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/loginUser/','UserController@loginUser');
Route::get('/autUser/','UserController@autUser');
Route::get('/addUser/','UserController@addUser');

Route::get('/editUser/','UserController@editUser');
Route::get('/deleteUser/','UserController@deleteUser');