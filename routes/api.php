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

Route::get('get-customer','CustomerController@getData');
Route::get('get-vendor','VendorController@getData');
Route::get('get-product','ProductController@getData');
Route::get('get-support','SupportController@getData');
Route::get('get-task','TaskController@getData');
Route::get('get-event','EventController@getData');
Route::get('get-search-task','TaskController@searchTask');
Route::get('get-search-customer','EventController@searchEvent');
