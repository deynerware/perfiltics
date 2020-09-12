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

Route::post('/api/login', 'UserController@login');
Route::post('/api/register', 'UserController@register');

Route::apiResource('/api/categories', 'CategoryController')
    ->middleware('api.auth');
Route::apiResource('/api/products', 'ProductController')
    ->middleware('api.auth');