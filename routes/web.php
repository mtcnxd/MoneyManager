<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\SpendsController;
use App\Http\Controllers\CategoriesController;

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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'user'], function(){
    
    Route::resource('/crypto', CryptoController::class)->only('index','destroy');

    Route::resource('/cards', CardsController::class);
    
    Route::resource('/investments', InvestmentController::class)->except('edit','update');
    
    Route::resource('/categories', CategoriesController::class);

    Route::get('/trades', [CryptoController::class, 'trades'])->name('user.trades');

    Route::get('/spends/{card}', [CardsController::class, 'spends'])->name('user.spends');

});
