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



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('apilogin', 'API\V1\Auth\LoginController@login');
Route::post('apiregister', 'API\V1\Auth\RegisterController@register');



Route::group([
	
	'prefix' => '/v1',
	'namespace' => 'API\V1',
	'as' => 'api.',
	'middleware' => 'auth:api'

], function() {
	Route::group(['prefix' => 'meetings'], function() {
	    Route::get('/{id}/owner', 'MeetingController@getList');
	    Route::get('/{id}/detail', 'MeetingController@getDetail');
	    Route::resource('/', 'MeetingController',  ['except' => ['create', 'edit']]);
	});
	Route::group(['prefix' => 'auth'], function() {
	    Route::get('/getSelf', 'Auth\UserController@getSelf');
	});
    Route::group(['prefix' => 'user'], function() {
	    Route::get('/find-{type}-{data}', 'UserController@findUser');
	   	Route::post('/beFriend', 'UserController@addFriend');
	   	Route::post('/responseRequest', 'UserController@responseRequest');
	   	Route::get('/getFriendRequests', 'UserController@getFriendRequests');
	   	Route::get('/getFriends', 'UserController@getFriends');
	});

});
