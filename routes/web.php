<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


 
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin'], function () {    
 
    Route::get('/', 'IndexController@index');

    Route::get('login', [ 'as' => 'login', 'uses' => 'IndexController@index']);
    
    Route::post('login', 'IndexController@postLogin');
    Route::get('logout', 'IndexController@logout');

    Route::get('forgot_password', 'IndexController@forgot_password');
    Route::post('forgot_password', 'IndexController@forgot_password_send');

    Route::group(['middleware' => ['auth']], function(){
 
    Route::get('dashboard', 'DashboardController@index');   
    Route::get('profile', 'AdminController@profile');   
    Route::post('profile', 'AdminController@updateProfile');

    Route::get('type', 'TypeController@list');  
    Route::get('type/add', 'TypeController@add'); 
    Route::get('type/edit/{id}', 'TypeController@edit');  
    Route::post('type/add_edit', 'TypeController@addnew');
    
    Route::get('location', 'LocationController@list');  
    Route::get('location/add', 'LocationController@add'); 
    Route::get('location/edit/{id}', 'LocationController@edit');  
    Route::post('location/add_edit', 'LocationController@addnew'); 
      
    Route::get('property', 'PropertyController@list');  
    Route::get('property/add', 'PropertyController@add'); 
    Route::get('property/edit/{id}', 'PropertyController@edit');  
    Route::post('property/add_edit', 'PropertyController@addnew');
      
    Route::get('reviews', 'ReviewsController@list');

    Route::get('reports', 'ReportsController@list');
 
    Route::get('users', 'UsersController@list');   
    Route::get('users/add', 'UsersController@add'); 
    Route::get('users/edit/{id}', 'UsersController@edit'); 
    Route::post('users/add_edit', 'UsersController@addnew');   
    Route::get('users/export', 'UsersController@user_export');
    Route::get('users/history/{id}', 'UsersController@user_history');
    
      
    Route::get('sub_admin', 'UsersController@admin_list'); 
    Route::get('sub_admin/add', 'UsersController@admin_add'); 
    Route::get('sub_admin/edit/{id}', 'UsersController@admin_edit');   
    Route::post('sub_admin/add_edit', 'UsersController@admin_addnew'); 
    Route::get('sub_admin/delete/{id}', 'UsersController@admin_delete');


    Route::get('subscription_plan', 'SubscriptionPlanController@list');  
    Route::get('subscription_plan/add', 'SubscriptionPlanController@add'); 
    Route::get('subscription_plan/edit/{id}', 'SubscriptionPlanController@edit');  
    Route::post('subscription_plan/add_edit', 'SubscriptionPlanController@addnew');
       
    Route::get('payment_gateway', 'PaymentGatewayController@list');
    Route::get('payment_gateway/edit/{id}', 'PaymentGatewayController@edit');   
    Route::post('payment_gateway/paypal', 'PaymentGatewayController@paypal');
    Route::post('payment_gateway/stripe', 'PaymentGatewayController@stripe');
    Route::post('payment_gateway/razorpay', 'PaymentGatewayController@razorpay');
    Route::post('payment_gateway/paystack', 'PaymentGatewayController@paystack');
    Route::post('payment_gateway/payu', 'PaymentGatewayController@payu');
    Route::post('payment_gateway/flutterwave', 'PaymentGatewayController@flutterwave');
    Route::post('payment_gateway/banktransfer', 'PaymentGatewayController@banktransfer');
    Route::post('payment_gateway/braintree', 'PaymentGatewayController@braintree');
    Route::post('payment_gateway/sslcommerz', 'PaymentGatewayController@sslcommerz');
    Route::post('payment_gateway/cinetpay', 'PaymentGatewayController@cinetpay'); 

    Route::get('transactions', 'TransactionsController@transactions_list');
    Route::post('transactions/export', 'TransactionsController@transactions_export');  
  
    Route::get('pages', 'PagesController@pages_list');  
    Route::get('pages/add', 'PagesController@add'); 
    Route::get('pages/edit/{id}', 'PagesController@edit');  
    Route::post('pages/add_edit', 'PagesController@addnew');  
    Route::post('pages/about_update', 'PagesController@about_update');
    Route::post('pages/contact_update', 'PagesController@contact_update');    
    Route::get('pages/delete/{id}', 'PagesController@delete');

    Route::get('ad_list', 'AppAdsController@list');
    Route::get('ad_list/edit/{id}', 'AppAdsController@edit');   
    Route::post('ad_list/admob', 'AppAdsController@admob');
    Route::post('ad_list/startapp', 'AppAdsController@startapp');
    Route::post('ad_list/facebook', 'AppAdsController@facebook');
    Route::post('ad_list/applovins', 'AppAdsController@applovins');
    Route::post('ad_list/wortise', 'AppAdsController@wortise');
    Route::post('ad_list/unity', 'AppAdsController@unity');

    Route::get('general_settings', 'SettingsController@general_settings');
    Route::post('general_settings', 'SettingsController@update_general_settings');
    Route::get('email_settings', 'SettingsController@email_settings');
    Route::post('email_settings', 'SettingsController@update_email_settings');
    Route::get('test_smtp_settings', 'SettingsController@test_smtp_settings'); 
    Route::get('social_login_settings', 'SettingsController@social_login_settings');
    Route::post('social_login_settings', 'SettingsController@update_social_login_settings'); 

    Route::get('recaptcha_settings', 'SettingsController@recaptcha_settings');
    Route::post('recaptcha_settings', 'SettingsController@update_recaptcha_settings');

    Route::get('web_ads_settings', 'SettingsController@web_ads_settings');
    Route::post('web_ads_settings', 'SettingsController@update_web_ads_settings');
    
    Route::get('android_settings', 'SettingsAndroidAppController@android_settings');
    Route::post('android_settings', 'SettingsAndroidAppController@update_android_settings'); 
    Route::get('onesignal_notification', 'SettingsAndroidAppController@onesignal_notification');
    Route::post('onesignal_notification', 'SettingsAndroidAppController@update_onesignal_notification');
    Route::get('app_update_popup', 'SettingsAndroidAppController@app_update_popup');
    Route::post('app_update_popup', 'SettingsAndroidAppController@update_app_update_popup');
    Route::get('others_settings', 'SettingsAndroidAppController@others_settings');
    Route::post('others_settings', 'SettingsAndroidAppController@update_others_settings');
    Route::get('notification_send', 'SettingsAndroidAppController@notification_send');
    Route::post('notification_send', 'SettingsAndroidAppController@send_android_notification');

      
    Route::get('verify_purchase_app', 'SettingsAndroidAppController@verify_purchase_app');
    Route::post('verify_purchase_app', 'SettingsAndroidAppController@verify_purchase_app_update');

    Route::get('api_urls', 'SettingsController@api_urls');

    Route::post('ajax_status', 'ActionsController@ajax_status');
    Route::post('ajax_delete', 'ActionsController@ajax_delete');

    Route::get('cache', 'DashboardController@cache');

    });
 
});

//Site

Route::group(['namespace' => 'App\Http\Controllers'], function () {

Route::get('/', 'IndexController@index');
Route::get('latest', 'IndexController@latest');
Route::get('popular', 'IndexController@popular');
Route::get('page/contact', 'PagesController@page_contact');
Route::post('page/contact_send', 'PagesController@contact_send');
Route::get('page/{slug}', 'PagesController@page_details');
  

Route::get('types', 'TypesController@types');
Route::get('types/{slug}/{id}', 'TypesController@types_property');

Route::get('properties', 'PropertyController@properties');
Route::get('properties/owner/{id}', 'PropertyController@properties_owner');
Route::get('properties/{slug}/{id}', 'PropertyController@property_details');
Route::get('properties/search', 'PropertyController@property_search');
Route::post('properties/contact', 'PropertyController@properties_contact');
Route::post('properties/report', 'PropertyController@properties_report');

Route::post('ajax_actions', 'ActionsController@ajax_actions');

/*========================================*/


Route::get('login', 'IndexController@login');
Route::post('login', 'IndexController@postLogin');

Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');

Route::get('signup', 'IndexController@signup');
Route::post('signup', 'IndexController@postSignup');

Route::get('logout', 'IndexController@logout');

Route::get('dashboard', 'UserController@dashboard');
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@editprofile');
Route::post('phone_update', 'UserController@phone_update');
Route::get('watchlist', 'UserController@my_watchlist');
Route::get('account_delete', 'UserController@account_delete');

Route::get('password/email', 'Auth\ForgotPasswordController@forget_password');
Route::post('password/email', 'Auth\ForgotPasswordController@forget_password_submit');
Route::get('password/reset/{token}', 'Auth\ForgotPasswordController@reset_password');
Route::post('password/reset', 'Auth\ForgotPasswordController@reset_password_submit');

Route::get('user/property', 'UserPropertyController@list');  
Route::get('user/property/add', 'UserPropertyController@add'); 
Route::get('user/property/edit/{id}', 'UserPropertyController@edit');  
Route::post('user/property/add_edit', 'UserPropertyController@addnew');

Route::get('user/favourites', 'UserPropertyController@favourites_list'); 

Route::get('pricing', 'UserController@pricing');
Route::get('payment_method/{plan_id}', 'UserController@payment_method');

Route::post('paypal/pay', 'PaypalController@paypal_pay');
Route::get('paypal/success', 'PaypalController@paypal_success');
Route::get('paypal/fail', 'PaypalController@paypal_fail');


Route::get('stripe/pay', 'StripeController@stripe_pay');
Route::get('stripe/success', 'StripeController@stripe_success');
Route::get('stripe/fail', 'StripeController@stripe_fail');

Route::post('razorpay_get_order_id', 'RazorpayController@get_order_id');
Route::post('razorpay-success', 'RazorpayController@payment_success');

Route::post('pay', 'PaystackController@redirectToGateway')->name('pay');
Route::get('payment/callback', 'PaystackController@handleGatewayCallback');

Route::post('payu_success', 'PayuController@payu_success');
Route::post('payu_fail', 'PayuController@payu_fail');

Route::post('flutterwave/pay', 'FlutterwaveController@flutterwave_pay');
Route::get('flutterwave/success', 'FlutterwaveController@flutterwave_success');

Route::get('sslcommerz/pay', 'SslcommerzController@sslcommerz_pay');
Route::post('sslcommerz/success', 'SslcommerzController@sslcommerz_success');
Route::post('sslcommerz/fail', 'SslcommerzController@sslcommerz_fail');

Route::get('cinetpay/pay', 'CinetpayController@pay');
Route::post('cinetpay/success', 'CinetpayController@success');
Route::get('cinetpay/notify', 'CinetpayController@notify');

Route::get('sitemap.xml', 'SitemapController@sitemap');
Route::get('sitemap-misc.xml', 'SitemapController@sitemap_misc');
Route::get('sitemap-property.xml', 'SitemapController@sitemap_property');

//For App Only
Route::any('app_payu_success', function () {
    return view('app_payu.app_payu_success');
});

Route::any('app_payu_failed', function () {
    return view('app_payu.app_payu_failed');
});

});