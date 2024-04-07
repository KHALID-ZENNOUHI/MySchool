<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            $request->session()->put('username', $user->name);
            $request->session()->put('id', $user->id);
            $request->session()->put('role', $user->role->nom);

            if ($user->role->nom == 'admin') {
                return redirect()->route('home')->with('success', 'Logged in successfully');
            }elseif ($user->role->nom == 'administarateur') {
                return redirect()->route('home')->with('success', 'Logged in successfully');
            }elseif ($user->role->nom == 'formateur') {
                return redirect()->route('teacher.dashboard')->with('success', 'Logged in successfully');
            }elseif ($user->role->nom == 'etudiant') {
                return redirect()->route('student.dashboard')->with('success', 'Logged in successfully');
            }
        }
        return redirect()->route('login')->with('error', 'Invalid credentials');        
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ResetPasswordMail($user));
            return back()->with('success', 'Password reset link sent to your email');
        }

        return back()->with('error', 'Email not found');
    }

    public function resetPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            return view('auth.new-password', ['token' => $token]);
        }
        return abort(404);
    }

    public function newPassword($token, Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'string|min:8'
        ]);

        $user = User::where('remember_token', $request->token)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect()->route('login')->with('success', 'Password updated successfully');
        }

        return abort(404);
    }
}
