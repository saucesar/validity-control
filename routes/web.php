<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ProductController;

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
    if(Auth::user()){
        return redirect()->route('home.index');
    } else {
        return view('users.login');
    }
});
Route::resource('users', UserController::class)->except(['edit']);
Route::post('users/login', UserController::class.'@login')->name('users.login');
Route::post('users/logout', UserController::class.'@logout')->name('users.logout');

Route::get('/home', HomeController::class."@index")->name('home.index');
Route::post('products/add-date/{product}', ProductController::class.'@addDate')->name('product.addDate');
Route::match(['get', 'post'], 'products/search', ProductController::class.'@generalSearch')->name('products.search');
Route::delete('products/remove-date/{product}', ProductController::class.'@removeDate')->name('product.removeDate');