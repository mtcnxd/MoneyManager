<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Instrument;
use App\Models\InstrumentModel;
use DB;

class InvestmentController extends Controller
{
    public function index()
    {
        $instruments = DB::table('investments')
            ->select('instrument_id')
            ->groupBy('instrument_id')
            ->get();

        $results = array();
        foreach($instruments as $instrument){
            $results[] = new Instrument($instrument->instrument_id);
        }

        $instruments = [
            'Cetes',
            'Doopla',
            'GBM',
            'Mercado Pago',
            'Yo te presto',
        ];

        return view('dashboard.investment_index', compact('results','instruments'));
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

        return view('dashboard.investment_create', compact('instruments'));
    }

    public function show(String $request)
    {
        $results = DB::table('investments')
            ->where('instrument_id', $request)
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        return view('dashboard.investment_show', compact('results'));
    }

    public function store(Request $request)
    {
        InstrumentModel::create($request->all());

        return to_route('investments.index')
            ->with('message', 'Data save successfully');
    }
}
