<?php

use App\Http\Controllers\AmountInOutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExpirationDateController;
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

Route::get('/', [HomeController::class, 'checkLogin'])->name('login');

Route::post('users/login', [UserController::class, 'login'])->name('users.login');
Route::resource('users', UserController::class)->except(['edit', 'index', 'show']);

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/home', [HomeController::class, "index"])->name('home.index');

    Route::prefix('users')->group(function(){
        Route::post('change-password/{user}', [UserController::class, 'changePassword'])->name('users.changePassword');
        Route::post('logout', [UserController::class, 'logout'])->name('users.logout');
        Route::get('access-request/{user}/{status}', [UserController::class, 'accessRequest'])->name('users.accessRequest');
        Route::get('info', [UserController::class, 'information'])->name('users.information');
    });
    
    Route::prefix('company')->group(function(){
        Route::post('update/{company}', [CompanyController::class, 'update'])->name('company.update')->middleware(['authorization']);
    });

    Route::resource('products', ProductController::class)->except(['edit'])->middleware(['authorization']);
    Route::prefix('products')->group(function(){
        Route::match(['get', 'post'], 'search', [ProductController::class, 'generalSearch'])->name('products.search')->middleware(['user.granted']);
        Route::match(['get', 'post'], 'by-expiration-days/{days?}',  [ProductController::class, 'expirationDays'])->name('products.byExpiration');
        Route::post('pdf', [ProductController::class, 'productsToPdf'])->name('products.toPDF');
        Route::get('/by-category/{category_id}', [ProductController::class, 'byCategory'])->name('products.byCategory');
    });

    Route::prefix('expiration-dates')->group(function(){
        Route::post('add-date/{product}', [ExpirationDateController::class, 'store'])->name('product.addDate');
        Route::put('edit-date/{expdate}', [ExpirationDateController::class, 'update'])->name('product.updateExpdate');
        Route::delete('remove-date/{expiration_date}', [ExpirationDateController::class, 'destroy'])->name('product.removeDate');
    });

    Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->group(function(){
        Route::post('add-email/{category}', [CategoryController::class, 'addEmail'])->name('categories.addEmail');
    });

    Route::prefix('amountInOut')->group(function(){
        Route::post('store/{expDateId}', [AmountInOutController::class, 'store'])->name('amountInOut.store');
    });
});