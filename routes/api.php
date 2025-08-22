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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace' => 'App\Http\Controllers\API'], function(){
     
    Route::get('/', 'AndroidApiController@index');
    Route::post('app_details', 'AndroidApiController@app_details');
    Route::post('payment_settings', 'AndroidApiController@payment_settings');
    
    Route::post('home', 'AndroidApiController@home');     
    Route::post('location', 'AndroidApiController@location');     
    Route::post('types', 'AndroidApiController@types');   
    Route::post('types_all', 'AndroidApiController@types_all');
    Route::post('property_by_types', 'AndroidApiController@property_by_types');
    Route::post('property_details', 'AndroidApiController@property_details');
    Route::post('trending_property', 'AndroidApiController@trending_property');
    Route::post('latest_property', 'AndroidApiController@latest_property');  
    Route::post('search_property', 'AndroidApiController@search_property');
    Route::post('normal_search_property', 'AndroidApiController@normal_search_property');
     
    Route::post('post_view', 'AndroidApiController@post_view');
    Route::post('post_favourite', 'AndroidApiController@post_favourite');
  
    Route::post('login', 'AndroidApiController@login');
    Route::post('signup', 'AndroidApiController@signup');
    Route::post('social_login', 'AndroidApiController@social_login');
    Route::post('forgot_password', 'AndroidApiController@forgot_password');

    Route::post('profile', 'AndroidApiController@profile');
    Route::post('profile_update', 'AndroidApiController@profile_update');

    Route::post('user_property', 'AndroidApiController@user_property');
    Route::post('user_add_property', 'AndroidApiController@user_add_property');
    Route::post('user_edit_property', 'AndroidApiController@user_edit_property');
    Route::post('user_edit_property_save', 'AndroidApiController@user_edit_property_save');
    Route::post('user_property_gallery_delete', 'AndroidApiController@user_property_gallery_delete');


    Route::post('user_favourite_post_list', 'AndroidApiController@user_favourite_post_list'); 
    Route::post('user_reports', 'AndroidApiController@user_reports');
    
    Route::post('check_user_plan', 'AndroidApiController@check_user_plan');
    Route::post('subscription_plan', 'AndroidApiController@subscription_plan');
    Route::post('transaction_add', 'AndroidApiController@transaction_add');

    Route::post('stripe_token_get', 'AndroidApiController@stripe_token_get');
    Route::post('get_braintree_token', 'AndroidApiController@get_braintree_token');
    Route::post('braintree_checkout', 'AndroidApiController@braintree_checkout');
    Route::post('razorpay_order_id_get', 'AndroidApiController@razorpay_order_id_get');
    Route::post('get_payu_hash', 'AndroidApiController@payumoney_hash_generator');
 });
