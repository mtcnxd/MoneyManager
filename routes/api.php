<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\SpendsController;
use App\Http\Controllers\BitsoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('deleteSpending', [
    CardsController::class, 'destroy'
])->name('deleteSpending');

Route::post('processMonth', [
    CardsController::class, 'process'
])->name('processMonth');

Route::post('storeCryto', [
    CryptoController::class, 'store'
])->name('storeCryto');

Route::post('destroyCryto', [
    CryptoController::class, 'destroy'
])->name('destroyCryto');

Route::post('searchItems', [
    SpendsController::class, 'searchItems'
])->name('searchItems');

Route::post('placeOrder', [
    BitsoController::class, 'placeOrder'
])->name('placeOrder');