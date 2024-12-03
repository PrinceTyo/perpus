<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'author',
            'is_approved' => false,
        ]);

        return redirect('/login')->with('success', 'Registration Successful');
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if($user->usertype === 'author' && !$user->is_approved){
                Auth::logout();
                return back()->withErrors(['message' => 'Akun Anda belum disetujui oleh admin.'])->withInput();
            }

            if($user->usertype === 'author'){
                return redirect()->route('author.dashboard');
            } elseif($user->usertype === 'admin'){
                return redirect()->route('admin.dashboard');
            }
        }
        return back()->withErrors(['email' => 'invalid credentials'])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
