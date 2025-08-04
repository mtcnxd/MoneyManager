<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function create()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return redirect('/');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return to_route('crypto.index');
        }

        else {
            return 'Username or password is wrong';
        }
    }

    public function logout()
    {
        return 'logout';
    }
}
