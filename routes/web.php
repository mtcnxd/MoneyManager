<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InvestmentController;

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


Route::get('/', [LoginController::class, 'index'])->name('login');

Route::group(['controller' => LoginController::class], function()
    {    
        Route::get('/register', 'create')->name('user.register');
        Route::post('/store', 'store')->name('user.store');
        Route::post('/login', 'login')->name('user.login');
        Route::get('/logout', 'logout')->name('user.logout');
    }
);

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function()
    {   
        Route::resource('/crypto', CryptoController::class)->only('index','destroy');
        Route::resource('/cards', CardsController::class)->except('edit','update');
        Route::resource('/investments', InvestmentController::class)->except('edit','update');
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/trades', [CryptoController::class, 'trades'])->name('user.trades');
        Route::get('/spends/{card}', [CardsController::class, 'spends'])->name('user.spends');
    }
);
