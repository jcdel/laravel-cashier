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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/plans', 'PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');
    Route::get('/subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscriptions.create');
    Route::post('/subscription/cancel/{id}', 'SubscriptionController@cancelSubscription')->name('subscriptions.cancel');
    Route::post('/subscription/resume/{id}', 'SubscriptionController@resumeSubscription')->name('subscriptions.resume');
    Route::post('/subscription/swap/{stripeId}/{planId}', 'SubscriptionController@swapSubscription')->name('subscriptions.swap');
});
