<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            $user = Auth::user();

            if ($user->hasRole('adminpusat')) {
                return redirect('/adminpusat');
            } elseif ($user->hasRole('superadmin')) {
                return redirect('/superadmin');
            } elseif ($user->hasRole('petugasdesa')) {
                return redirect('/petugasdesa');
            } elseif ($user->hasRole('verifikator')) {
                return redirect('/verifikator');
            } elseif ($user->hasRole('kadis')) {
                return redirect('/kadis');
            } else {
                return redirect('/login');
            }
        }
    }
}
