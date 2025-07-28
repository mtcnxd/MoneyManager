<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::get();

        return view('admin.creditcards.cards_index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.creditcards.cards_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CardsModel::create($request->all());

        return to_route('cards.index')
            ->with('message','Data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $card = Card::find($id);
        
        $chart = DB::table('credit_cards_movs')
            ->select('concept', DB::raw('sum(amount) as amount'))
            ->where('card_id', $id)
            ->where('active', true)
            ->groupBy('concept')
            ->get();

        return view('admin.creditcards.cards_show', compact('card', 'chart'));
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
    public function process(Request $request)
    {
        $update = DB::table('credit_cards_movs')
            ->where('active', true)
            ->where('card_id', $request->card)
            ->update([
                'active' => false
            ]);
        
        if ($update){
            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleted = DB::table('credit_cards_movs')->where('id', $request->id)->delete();
        
        if ($deleted){
            return response()->json([
                'success' => true,
                'message' => 'Data save successfully',
            ]);
        }
    }
}
