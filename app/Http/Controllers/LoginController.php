<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(){
        $users = \App\Models\User::all();

        return view('auth.login',compact('users'));
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user');
    }

    public function initiateSession(){
        session()->put([
            'theme'=>'default',
            'lang'=>'en'
        ]);
    }

    public function authenticate(Request $request){
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $credentials =[
            'name'=>$request->username,
            'password'=>$request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            

            $this->initiateSession();

            return redirect()->intended('user');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
