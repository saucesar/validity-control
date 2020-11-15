<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ShelfLifeController;
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

Route::apiResource('products', ProductController::class)->except(['create', 'edit']);
Route::get('products/search/{barcode}', ProductController::class.'@search')->name('products.search');
Route::get('shelflifes/daysofvalidity/{days}', ShelfLifeController::class.'@daysOfValidity')->name('shelflifes.perDays');
Route::apiResource('shelflifes', ShelfLifeController::class)->except(['create', 'edit']);