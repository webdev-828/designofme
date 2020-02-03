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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('designofme/', 'UserController@index');
Route::get('designofme/checkuser', 'UserController@checkuser');
Route::post('designofme/signin/', 'UserController@siginin');
Route::post('designofme/signup', 'UserController@signup');
Route::post('designofme/logout', 'UserController@logout');
Route::post('designofme/fetchuser', 'UserController@fetchuser');
Route::any('designofme/addproduct', 'ProductController@addproduct');
Route::get('designofme/getproduct', 'ProductController@getproduct');
Route::post('designofme/checkout', 'CheckoutController@makeOrder');
Route::post('designofme/order/status', 'CheckoutController@orderCallback');
Route::post('designofme/getSellers', 'DashboardController@getSellers');
Route::post('designofme/getOrders', 'DashboardController@getOrders');
Route::post('designofme/getWithdraws', 'DashboardController@getWithdraws');
Route::post('designofme/accept', 'DashboardController@accept');
Route::post('designofme/revoke', 'DashboardController@revoke');
