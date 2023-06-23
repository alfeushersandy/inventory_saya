<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\PermissionController;
use App\Http\Controllers\Office\RoleController;
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

Route::group(['prefix' => 'office', 'as' => 'office.', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
});
