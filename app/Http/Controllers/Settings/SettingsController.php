<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = DB::table('setting')->get();

        return view('admin.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        return to_route('settings.index')
            ->with('message', 'Setting updated successfully');
    }
}
