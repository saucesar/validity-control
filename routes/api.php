<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
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

Route::post('auth/login', AuthController::class.'@login');

Route::group(['middleware' => ['apiJWT'], 'prefix' => 'auth'], function() {
    Route::post('logout', AuthController::class.'@logout');
    Route::post('refresh', AuthController::class.'@refresh');
    Route::post('me', AuthController::class.'@me');
});

Route::group(['middleware' => ['apiJWT']], function(){
    Route::apiResource('products-api', ProductApiController::class);
    Route::post('products-api/add-date/{product}', ProductApiController::class.'@addDate');
});
