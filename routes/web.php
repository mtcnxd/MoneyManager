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

Route::get('/trades', function() {
    $bitso = new Bitso();
    $trades = $bitso->userTrades();

    return view('dashboard.crypto_show', compact('trades'));
})->name('trades');

Route::resource('/cards', CardsController::class);

Route::resource('/investments', InvestmentController::class);

Route::resource('/cryptocurrencies', CryptoController::class);

Route::resource('/spends', SpendsController::class);

Route::resource('/categories', CategoriesController::class);