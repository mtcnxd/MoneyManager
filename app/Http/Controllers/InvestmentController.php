<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use DB;

class InvestmentController extends Controller
{
    public function index()
    {
        $results = array();
        $investments = array();
        $instruments = [
            'Doopla',
            'GBM',
            'Yo te presto',
        ];

        return view('admin.investments.investment_index', compact('investments', 'results','instruments'));
    }

    public function create()
    {
        $instruments = [
            'Cetes',
            'Doopla',
            'GBM',
            'Mercado Pago',
            'Yo te presto',
        ];

        return view('admin.investments.investment_create', compact('instruments'));
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
