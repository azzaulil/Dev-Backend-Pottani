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

        //class
        Route::get('/all-data-member', 'User\AdminController@getMember');
        Route::post('/create-class', 'User\AdminController@createClass');
        Route::post('/update-class/{id}', 'User\AdminController@updateClass');
        Route::delete('/delete-class/{id}', 'User\AdminController@deleteClass');
        Route::get('/show-class', 'User\AdminController@showClass');
        //category
        Route::post('/create-category', 'User\AdminController@createCategory');
        Route::post('/update-category/{id}', 'User\AdminController@updateCategory');
        Route::get('/category', 'User\AdminController@indexCategory');
        Route::get('/detail-category/{id}', 'User\AdminController@showCategory');
        Route::delete('/delete-category/{id}', 'User\AdminController@deleteCategory');
        //status
        Route::post('/create-status', 'User\AdminController@createStatus');
        Route::post('/update-status/{id}', 'User\AdminController@updateStatus');
        Route::get('/status', 'User\AdminController@indexStatus');
        Route::delete('/delete-status/{id}', 'User\AdminController@deleteStatus');
    });

    Route::group(['middleware' => ['member','active_user'],'prefix' => 'member'], function() {

        //class 
        Route::get('/show-all-class', 'User\MemberController@AllClass');
        Route::get('/show-detail-class/{id_class}', 'User\MemberController@showDetailClass');
        Route::post('/register-class', 'User\MemberController@registerClass');
        Route::get('/show-registered-class', 'User\MemberController@showClassRegister');
        Route::get('/show-detail-class/{id_class}', 'User\MemberController@showDetailClassRegister');
        //profile
        Route::get('/show-profile', 'User\MemberController@showProfile');
        Route::post('/update-profile/{id_member}', 'User\MemberController@updateProfile');
    });

});

Route::group([ 'prefix' => 'auth'], function () {
    Route::get('user/verify/{token}', 'Auth\AuthController@verifyUser')->name('verify');
    Route::post('login', 'Auth\AuthController@login');
    Route::post('register', 'Auth\AuthController@register');
    Route::get('show-all-class', 'User\UserController@showAllClass');
    Route::get('show-detail-class/{id_class}', 'User\UserController@showDetailClass');
    
    Route::group([ 'middleware' => 'auth:api'], function() {
        Route::post('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});