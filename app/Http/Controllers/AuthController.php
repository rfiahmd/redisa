<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_action(LoginRequest $request)
    {
        // Cek apakah input adalah email atau username
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek role pengguna dan arahkan sesuai role
            if ($user->hasRole('superadmin')) {
                session()->flash('login_success', 'Selamat Anda berhasil login sebagai Super Admin!');
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->hasRole('adminpusat')) {
                session()->flash('login_success', 'Selamat Anda berhasil login sebagai Admin Pusat!');
                return redirect()->route('adminpusat.dashboard');
            } elseif ($user->hasRole('petugasdesa')) {
                session()->flash('login_success', 'Selamat Anda berhasil login sebagai Petugas Desa!');
                return redirect()->route('petugasdesa.dashboard');
            } elseif ($user->hasRole('verifikator')) {
                session()->flash('login_success', 'Selamat Anda berhasil login sebagai Verifikator!');
                return redirect()->route('verifikator.dashboard');
            } elseif ($user->hasRole('kadis')) {
                session()->flash('login_success', 'Selamat Anda berhasil login sebagai Kepala Dinas!');
                return redirect()->route('kadis.dashboard');
            }

            return redirect()->route('login');
        }

        return back()
            ->withErrors(['login' => 'Email/Username atau Password salah.'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('logout_success', 'Anda telah berhasil logout.');

        return redirect()->route('login');
    }

    public function profile()
    {
        $data=[
            'user' => Auth::user()
        ];
        return view('profile.profile', $data);
    }
}
