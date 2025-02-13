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
        $request->validate(
            [
                'nama_lengkap' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email',
                'role' => 'required|in:adminpusat,petugasdesa,verifikator,kadis',
            ],
            [
                'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
                'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
                'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 50 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',
                'role.required' => 'Peran wajib dipilih.',
                'role.in' => 'Peran yang dipilih tidak valid.',
            ],
        );

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

    public function update(Request $request, User $users)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $users->id,
        ]);

        $baseUsername = strtolower(str_replace(' ', '', $request->nama_lengkap));
        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->where('id', '!=', $users->id)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $updateData = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'username' => $username,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
            Mail::to($users->email)->send(new UserCreatedMail($users, $request->password));
        }

        $users->update($updateData);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
