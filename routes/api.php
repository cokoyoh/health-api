<?php

use App\User;
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

Route::middleware('auth:api')->get('user', function (Request $request) {
    $user = $request->user()->with('roles')->where('email','=', $request->user()->email)->get();
    return response(['data' => $user],200);
});

Route::get('test', function(){
    return response([
        "fname" => "charles",
        "lname" => "okoyoh",
        "email" => "charlesokoyoh@gmail.com",
        "api-name" => "health-portal-api"
        ],200);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'] ,function (){
    Route::post('user-list', 'UserController@getUserList');
    Route::get('users-list','AdminController@getAllUsers');

    Route::post('add-app-link','ApplinkController@addAppLink');
    Route::post('add-new-article','PostController@addPost');
});

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function () {
    Route::post('create-user','UserController@createUser');
    Route::post('contact-us','ContactController@getMessage');

    Route::get('get-all-app-links','ApplinkController@getAllAppLinks');

    Route::get('show-all-articles','PostController@showAllPosts');
    Route::get('get-latest-article','PostController@showLatestPost');
    Route::get('get-fitness-articles','PostController@showFitnessPosts');
    Route::get('get-medicine-articles','PostController@showMedicinePosts');
    Route::get('get-diseases-articles','PostController@showDiseasesPosts');
});
/**
 * Password reset routes
 */
Route::post('forgot-password', 'UserController@forgotPassword');
Route::post('reset-password', 'UserController@resetPassword');
