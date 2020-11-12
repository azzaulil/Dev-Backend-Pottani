<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function() { 
    Route::group(['middleware' => 'admin','prefix' => 'admin'], function() { 
        Route::get('/all-data-member', 'User\AdminController@getMember');
        Route::get('/create-class', 'User\AdminController@createClass');
        Route::post('/update-class/{id}', 'User\AdminController@updateClass');
        Route::delete('/delete-class/{id}', 'User\AdminController@deleteClass');
        Route::get('/show-class', 'User\AdminController@showClass');
    });

    Route::group(['middleware' => ['member','active_user'],'prefix' => 'member'], function() { 

    });

});

Route::group([ 'prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('register', 'Auth\AuthController@register');
    
    Route::group([ 'middleware' => 'auth:api'], function() {
        Route::post('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

Route::get('/', function () {
    return 'Welcome at Pottani API';
});