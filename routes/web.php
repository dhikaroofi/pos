<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'actLogout'])->name('actLogout');

    Route::group(['middleware' => ['admin']], function () {
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::post('/create', [CategoryController::class, 'actCreate'])->name('category.actCreate');
            Route::put('/update', [CategoryController::class, 'actUpdate'])->name('category.actUpdate');
            Route::delete('/delete', [CategoryController::class, 'actDelete'])->name('category.actDelete');
        });


        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::post('/create', [UserController::class, 'actCreate'])->name('users.actCreate');
            Route::put('/update', [UserController::class, 'actUpdate'])->name('users.actUpdate');
            Route::delete('/delete', [UserController::class, 'actDelete'])->name('users.actDelete');
        });

    });

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::post('/create', [ProductController::class, 'actCreate'])->name('product.actCreate');
        Route::put('/update', [ProductController::class, 'actUpdate'])->name('product.actUpdate');
        Route::delete('/delete', [ProductController::class, 'actDelete'])->name('product.actDelete');
    });






    Route::prefix('transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
        Route::post('/pay', [TransactionController::class, 'pay'])->name('transaction.pay');
        Route::post('/cancel', [TransactionController::class, 'cancelTransaction'])->name('transaction.cancel');
        Route::get('/print/{id}', [TransactionController::class, 'print'])->name('transaction.print');
    });

    Route::prefix('cart')->group(function () {
        Route::post('/add', [CartController::class, 'addItem'])->name('cart.addItem');
        Route::post('/subtract', [CartController::class, 'subtractItem'])->name('cart.subtractItem');
    });

    Route::prefix('report')->group(function () {
        Route::get('/transaction', [ReportController::class, 'transaction'])->name('report.transaction');
        Route::get('/stock', [ReportController::class, 'stock'])->name('report.stock');
    });

});


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'actLogin'])->name('actLogin');

