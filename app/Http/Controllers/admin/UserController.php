<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'adminpusat' => User::role('adminpusat')->get(),
            'verifikator' => User::role('verifikator')->get(),
            'petugasdesa' => User::role('petugasdesa')->get(),
            'kadis' => User::role('kadis')->get(),
        ];

        return view('admin.customer-service.cs_view', $data);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:adminpusat,petugasdesa,verifikator,kadis', // Role yang valid
            'password' => 'required',
        ]);

        // Generate username unik
        $baseUsername = strtolower(str_replace(' ', '', $request->nama_lengkap));
        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        // Simpan user
        $user = User::create([
            'token_users' => Str::random(12),
            'username' => $username,
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => $request->password,
        ]);

        // Menetapkan role
        $user->assignRole($request->role);

        // Kirim email dengan kredensial login
        Mail::to($user->email)->send(new UserCreatedMail($user, $request->password));

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    
}
