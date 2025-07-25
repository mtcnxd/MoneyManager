<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\SpendsController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\BitsoController as Bitso;

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

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/reports', function () {
    $subquery = DB::table('investments')
        ->selectRaw('MAX(id) as id')
        ->groupBy('instrument_id');

    $totalInvestment = DB::table('investments')
        ->whereIn('id', $subquery)
        ->sum('amount');

    $totalSpends = DB::table('credit_cards_movs')
        ->selectRaw('credit_cards.name, SUM(amount) as amount')
        ->join('credit_cards','credit_cards_movs.card_id','credit_cards.id')
        ->groupBy('card_id')
        ->get();

    return view('dashboard.reports_index', compact('totalInvestment','totalSpends'));

})->name('reports');


Route::group(['prefix' => 'user'], function(){
    
    Route::get('/trades', [CryptoController::class, 'trades'], function() {})->name('user.trades');
    
    Route::resource('/crypto', CryptoController::class)->only('index','destroy');

    Route::resource('/cards', CardsController::class)->only('index');
    
    Route::resource('/investments', InvestmentController::class)->only('index');
    
    Route::resource('/spends', SpendsController::class)->only('index');
    
    Route::resource('/categories', CategoriesController::class)->only('index');

});
