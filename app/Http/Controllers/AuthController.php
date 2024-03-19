<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_name', $user->name);
            $request->session()->put('user_id', $user->name);
            return redirect('/')->with('success', 'Logged in successfully');
        }
        return redirect()->route('login')->with('error', 'Invalid credentials');        
    }
}
