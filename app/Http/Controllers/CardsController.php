<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\CardMSI;
use App\Models\CardTransactions;
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
        $deleted = CardTransactions::where('id', $request->id)->delete();
        
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
        $spends = CardTransactions::where('spend', 'LIKE', "%{$search}%")
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
        $msi = false;
        if ($request->months != 0){
            $msi = true;
            $price = ((double) $request->amount / (double) $request->months);
        }

        $movId = CardTransactions::insertGetId([
            'card_id' => $request->card,
            'spend'   => $request->spend,
            'amount'  => $request->amount,
            'msi'     => $msi,
            'description' => $request->description,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        if ($msi){
            for ($i=1; $i <= $request->months; $i++) {
                CardMSI::create([
                    'mov_id'     => $movId,
                    'price'      => $price,
                    'pay_number' => $i,
                    'due_date'   => Carbon::now()->addMonths($i),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Spend saved successfully',
            'data'    => $request->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function process(Request $request)
    {
        $updated = CardTransactions::where('active', true)
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
