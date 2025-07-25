<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BitsoController as Bitso;
use Exception;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bitso = new Bitso();
            $ticker  = $bitso->getTicker();        
            $balance = $bitso->getBalance();

            // $bitso->getCurrencyPrice('usdt_mxn');
        }

        catch (\Exception $e){
            return view('dashboard.crypto_index')
                ->with('error', 'Error fetching data from Bitso: '. $e->getMessage());
        }

        $myCurrencies = Crypto::get();

        return view('dashboard.crypto_index', compact('ticker','myCurrencies', 'balance'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Crypto::create([
                'parity' => $request->parity,
                'amount' => $request->amount,
                'price'  => $request->price,
                'status' => 'Pending',
            ]);
        }

        catch (\Exception $e){
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Data saved successfully"
        ]);
    }

    public function trades()
    {
        $bitso = new Bitso();
        $trades = $bitso->userTrades();

        return view('dashboard.crypto_show', compact('trades'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Crypto::destroy($id);

        return to_route('crypto.index')
            ->with('success', 'Crypto deleted successfully');
    }
}
