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

Route::middleware('auth:jwt')->get('/user', function (Request $request) {
    return Auth::user();
});

Route::post('/login','App\Http\Controllers\AuthenticationController@login')->name('auth.login');
Route::post('/register','App\Http\Controllers\AuthenticationController@register')->name('auth.register');
