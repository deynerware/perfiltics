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


Route::post('/api/login', 'UserController@login');
Route::post('/api/register', 'UserController@register');
Route::put('/api/user/update', 'UserController@update')->middleware('api.auth');

Route::apiResource('/api/categories', 'CategoryController');