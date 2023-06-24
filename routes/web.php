<?php

use App\Http\Controllers\office\SupplierController;
use App\Http\Controllers\Office\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\OrderController;
use App\Http\Controllers\Office\PermissionController;
use App\Http\Controllers\Office\ProductController;
use App\Http\Controllers\Office\RoleController;
use App\Http\Controllers\Office\UserController;
use App\Http\Controllers\Office\StokController;
use App\Http\Controllers\Office\ReportController;
use App\Http\Controllers\Office\TransactionController;

use App\Http\Controllers\Landing\CartController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\ProductController as LandingProductController;
use App\Http\Controllers\Landing\CategoryController as LandingCategoryController;
use App\Http\Controllers\Landing\TransactionController as LandingTransactionController;

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

Route::get('/', HomeController::class)->name('home');

Route::controller(LandingProductController::class)->as('product.')->group(function(){
    Route::get('/product', 'index')->name('index');
    Route::get('/product/{product:slug}', 'show')->name('show');
});
Route::controller(LandingCategoryController::class)->as('category.')->group(function(){
    Route::get('/category', 'index')->name('index');
    Route::get('/category/{category:slug}', 'show')->name('show');
});
Route::post('/transaction', LandingTransactionController::class)->middleware('auth')->name('transaction.store');

Route::controller(CartController::class)->middleware('auth')->as('cart.')->group(function(){
  Route::get('/cart', 'index')->name('index');
  Route::post('/cart/{product:id}', 'store')->name('store');
  Route::put('/cart/update/{cart:id}', 'update')->name('update');
  Route::delete('/cart/delete/{cart}', 'destroy')->name('destroy');
});

Route::group(['prefix' => 'office', 'as' => 'office.', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/product', ProductController::class);

    Route::controller(StokController::class)->prefix('/stock')->as('stock.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::put('/update/{id}', 'update')->name('update');
      });
    
      Route::get('/transcation', TransactionController::class)->name('transaction');
      Route::resource('/order', OrderController::class);

      Route::controller(ReportController::class)->prefix('/report')->as('report.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/filter', 'filter')->name('filter');
        Route::get('/pdf/{fromDate}/{toDate}', 'pdf')->name('pdf');
      });
});
