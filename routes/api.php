<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\CryptoController;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'crypto', 'controller' => CryptoController::class], function ()
    {
        Route::post('/store', 'store')->name('cryto.store');

        Route::post('/destroy', 'destroy')->name('cryto.destroy');
    }
);


Route::group(['prefix' => 'cards', 'controller' => CardsController::class], function ()
    {    
        Route::post('/store', 'storeSpend')->name('spend.store');
        
        Route::post('/process', 'process')->name('cards.processMonth');
        
        Route::post('/deleteSpending', 'destroy')->name('deleteSpending');
        
        Route::get('/autocomplete', 'autocomplete')->name('cards.autocomplete');
    }
);



Route::post('placeOrder', [BitsoController::class, 'placeOrder'])->name('placeOrder');