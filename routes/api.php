<?php

use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\InvoiceItemController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum', 'throttle:api')->group(function () {
    Route::get('/user',[AuthController::class,'user']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::resource('/invoiceitem',InvoiceItemController::class);
    Route::resource('/invoice',InvoiceController::class);
    Route::resource('/customers',CustomerController::class);
    Route::get('/customer',[CustomerController::class,'search'])->name('customers.search');
    Route::resource('/contract',ContractController::class);
    Route::get('/home',[HomeController::class,'index']);
});

    Route::post('/login',[AuthController::class,'login']);