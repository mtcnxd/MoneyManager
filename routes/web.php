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

    return view('dashboard.reports_index', compact('totalInvestment'));

})->name('reports');

Route::resource('/cards', CardsController::class);

Route::resource('/investments', InvestmentController::class);

Route::resource('/cryptocurrencies', CryptoController::class);

Route::resource('/spends', SpendsController::class);

Route::resource('/categories', CategoriesController::class);