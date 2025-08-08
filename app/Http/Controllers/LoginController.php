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
            switch (Auth::user()->rol){
                case 'admin':
                    $request->session()->regenerate();
                    return redirect()->route('crypto.index');

                case 'client':
                    $request->session()->regenerate();
                    return redirect()->route('crypto.index');
                
                default:
                    return 'You dont have enogth permissions';
            }
        }

        else {
            return 'Username or password is wrong';
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();        
        
        return to_route('user.login');
    }
}
