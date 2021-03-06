<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//always put more specific routes ahead of less specific ones.

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
//Route::post('logout', 'UserController@logout');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('/logout', 'UserController@logout');
    //Route::get('/user_details', 'UserController@getDetails');
    //Route::resource();
    Route::resource('home', 'PostController');

    Route::get('/category/{category}/tasks', 'CategoryController@tasks');
    Route::resource('/category', 'CategoryController');
    Route::resource('/task', 'TaskController');
});
