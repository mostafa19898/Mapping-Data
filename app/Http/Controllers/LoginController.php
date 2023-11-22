<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{    

    public function index()
    {
       return view("login");
    }
   
    public function store(Request $request)
    {    
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed...
            return redirect()->intended('/upload-form'); // Redirect to the intended URL or a default location
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }

}