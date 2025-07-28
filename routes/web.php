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
    
    Route::get('/trades', [CryptoController::class, 'trades'], function() {})->name('user.trades');
    
    Route::resource('/crypto', CryptoController::class)->only('index','destroy');

    Route::resource('/cards', CardsController::class);
    
    Route::resource('/investments', InvestmentController::class)->only('index','store','show');
    
    Route::resource('/spends', SpendsController::class);
    
    Route::resource('/categories', CategoriesController::class);

});
