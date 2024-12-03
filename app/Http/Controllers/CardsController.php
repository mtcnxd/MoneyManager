<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardsModel;
use App\Services\Card;
use Carbon\Carbon;
use DB;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = array();
        $results = CardsModel::get();

        foreach ($results as $key => $card) {
            $currentUsage = DB::table('credit_cards_movs')
                ->where('card_id', $card->id)
                ->sum('amount');

            $current[$card->name] = $currentUsage;
            $usage[$card->name]   = number_format(($currentUsage/$card->limit) * 100, 2);
        }

        return view('dashboard.cards_index', compact('results','usage','current'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cards_create');
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
    public function show(string $id)
    {
        $movs = DB::table('credit_cards_movs')
            ->where('card_id', $id)
            ->get();

        $card = new Card($id);

        return view('dashboard.cards_show', compact('movs', 'card'));
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
        $deleted = DB::table('credit_cards_movs')->where('id', $request->id)->delete();
        
        if ($deleted){
            return response()->json([
                'success' => true,
                'message' => 'Los datos se eliminaron con exito',
            ]);
        }
    }
}
