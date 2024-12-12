<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://api-stage.bitso.com/api/v3/ticker');
        $json = $response->json();
        $results = $json['payload'];

        $myCurrencies = DB::table('crypto_currencies')->get();

        return view('dashboard.crypto_index', compact('results','myCurrencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('crypto_currencies')->insert([
            "parity" => $request->parity,
            "amount" => $request->amount,
            "price"  => $request->price,
            "created_at" => Carbon::now(),
        ]);

        return response()->json([
            "success" => true,
            "message" => "Data save successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::table('crypto_currencies')->where('id', $request->id)->delete();

        return response()->json([
            "success" => true,
            "message" => "Data delete successfully"
        ]);
    }
}
