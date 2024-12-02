<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class SpendsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.spends_create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $creditCards = DB::table('credit_cards')->get();

        return view('dashboard.spends_create', compact('creditCards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('credit_cards_movs')->insert([
            "card_id"    => $request->credit_card,
            "concept"    => $request->concept,
            "amount"     => $request->amount,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        return to_route('spends.create')
            ->with('message','Item saved successfully');
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
    public function destroy(string $id)
    {
        //
    }
}
