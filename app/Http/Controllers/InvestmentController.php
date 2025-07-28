<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Instrument;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::all();
        $instruments = Instrument::all();

        return view('admin.investments.investment_index', compact('investments', 'instruments'));
    }

    public function create()
    {
        return view('admin.investments.investment_create');
    }

    public function show(String $request)
    {
        $results = DB::table('investments')
            ->where('instrument_id', $request)
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        $first = $results->first();
        $last  = $results->last();
        $change = number_format( (($first->amount - $last->amount) / $first->amount) * 100, 2 );

        return view('admin.investments.investment_show', compact('results', 'first', 'last', 'change'));
    }

    public function store(Request $request)
    {
        Investment::create($request->all());

        return to_route('investments.index')
            ->with('message', 'Data save successfully');
    }
}
