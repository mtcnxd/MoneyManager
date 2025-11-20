<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CardTransactions;
use App\Http\Controllers\Controller;

class SpendsController extends Controller
{
    public function show(string $id)
    {
        $results = [];
        $results = CardTransactions::where('id', $id)->first();

        return view('admin.creditcards.spend_show', compact('results'));
    }
}
