<?php

namespace App\Http\Controllers;

use App\Models\ShoppingBook;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\BitsoController as Bitso;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balances = array();
        
        try {
            $bitso    = new Bitso();
            $balances = $bitso->getBalance();
        }

        catch (\Exception $e){
            return view('admin.currencies.crypto_index')
                ->with('error', 'Error fetching data from Bitso: '. $e->getMessage());
        }

        $currencies = ShoppingBook::where('status','Pending')->get();

        foreach($currencies as $item){
            $item->setAdditionals($bitso->getBookPrice($item->book));
        }

        return view('admin.currencies.crypto_index', compact('balances','currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            ShoppingBook::create([
                'userid' => $request->userid,
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

        return view('admin.currencies.crypto_show', compact('trades'));
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
