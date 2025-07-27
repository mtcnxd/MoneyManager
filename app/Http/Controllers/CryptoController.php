<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use Illuminate\Http\Request;
use App\Http\Controllers\BitsoController as Bitso;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bitso   = new Bitso();
            $ticker  = $bitso->getTicker();
            $balance = $bitso->getBalance();
        }

        catch (\Exception $e){
            return view('dashboard.crypto_index')
                ->with('error', 'Error fetching data from Bitso: '. $e->getMessage());
        }

        $myCurrencies = Crypto::where('status','Pending')->get();

        return view('dashboard.crypto_index', compact('ticker','balance','myCurrencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Crypto::create([
                'book'   => $request->parity,
                'amount' => $request->amount,
                'price'  => $request->price,
                'status' => 'Pending',
            ]);
        }

        catch (\Exception $e){
            return response()->json([
                "success" => false,
                "message" => sprintf('Error saving data: %s', $e->getMessage())
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
        Crypto::where('id', $id)->update([
            'status' => 'Deleted'
        ]);

        return to_route('crypto.index')
            ->with('success', 'Crypto deleted successfully');
    }
}
