<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\CardMovs;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::all();

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
        Card::create($request->all());

        return to_route('cards.index')
            ->with('message','Data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $card = Card::find($id);

        return view('admin.creditcards.cards_show', compact('card'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleted = CardMovs::where('id', $request->id)->delete();
        
        if ($deleted){
            return response()->json([
                'success' => true,
                'message' => 'Data save successfully',
            ]);
        }
    }

    public function spends(Card $card)
    {
        return view('admin.creditcards.cards_spends', compact('card'));
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $spends = CardMovs::where('spend', 'LIKE', "%{$search}%")
            ->select('spend')
            ->groupBy('spend')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'suggestions' => $spends,
        ]);
    }

    public function storeSpend(Request $request)
    {
        CardMovs::create([
            'card_id' => $request->card,
            'spend'   => $request->spend,
            'amount'  => $request->amount,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Spend saved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function process(Request $request)
    {
        $updated = CardMovs::where('active', true)
            ->where('card_id', $request->card)
            ->where('msi', false)
            ->update([
                'active' => false
            ]);
        
        if ($updated){
            return response()->json([
                'success' => true,
                'message' => 'Data updated successfully',
            ]);
        }
    }
}
