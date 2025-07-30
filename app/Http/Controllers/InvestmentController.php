<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Instrument;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function index()
    {
        $subQuery = Investment::selectRaw('instrument_id, max(created_at) as latest')
            ->groupBy('instrument_id')
            ->toSql();

        $investments = Investment::from(DB::raw("(SELECT tbl.instrument_id, amount FROM ($subQuery) tbl JOIN investments ON tbl.latest = investments.created_at) as tbl2"))
            ->join('instruments', 'tbl2.instrument_id', 'instruments.id')
            ->select('instruments.name', 'tbl2.amount','tbl2.instrument_id')
            ->orderBy('instruments.name')
            ->get();

        $instruments = Instrument::all();

        return view('admin.investments.investment_index', compact('investments', 'instruments'));
    }

    public function create()
    {
        return view('admin.investments.investment_create');
    }

    public function show(String $id)
    {
        $instrument = Instrument::find($id);

        return view('admin.investments.investment_show', compact('instrument', ));
    }

    public function store(Request $request)
    {
        $formatter = new NumberFormatter('en_US', NumberFormatter::DECIMAL);

        Investment::create([
            'instrument_id' => $request->instrument_id,
            'amount' => $formatter->parse($request->amount),
        ]);

        return to_route('investments.index')
            ->with('message', 'Data save successfully');
    }
}
