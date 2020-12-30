<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

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
})->name('root');

Route::post('users/login', UserController::class.'@login')->name('users.login');
Route::resource('users', UserController::class)->except(['edit', 'index', 'show']);

Route::middleware(['auth'])->group(function (){
    Route::post('users/logout', UserController::class.'@logout')->name('users.logout');
    Route::get('users/access-request/{user}/{status}', UserController::class.'@accessRequest')->name('users.accessRequest');
    Route::get('users/info', UserController::class.'@information')->name('users.information');

    Route::get('/home', HomeController::class."@index")->name('home.index');
    Route::resource('products', ProductController::class)->except(['edit'])->middleware(['authorization']);
    Route::post('products/add-date/{product}', ProductController::class.'@addDate')->name('product.addDate');
    Route::put('products/edit-date/{expdate}', ProductController::class.'@updateExpirationDate')->name('product.updateExpdate');
    Route::match(['get', 'post'], 'products/search', ProductController::class.'@generalSearch')->name('products.search')->middleware(['user.granted']);
    Route::delete('products/remove-date/{expiration_date}', ProductController::class.'@removeDate')->name('product.removeDate');
    Route::match(['get', 'post'], 'products/by-expiration-days/{days?}',  ProductController::class.'@expirationDays')->name('products.byExpiration');
});