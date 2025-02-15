<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCreatedMail;
use App\Models\Desa;
use App\Models\User;
use App\Models\VerifikatorDesa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // Validasi input dasar
        $rules = [
            'nama_lengkap' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:adminpusat,petugasdesa,verifikator,kadis',
            'password' => 'required|string|min:8', // Tambahkan validasi password
        ];

        // Jika role verifikator, tambahkan validasi tambahan
        if ($request->role === 'verifikator') {
            $rules['jabatan'] = 'required|string|max:100';
            $rules['desa_id'] = 'required|array|min:1';
        }

        // Custom error messages
        $messages = [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 50 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan, silakan gunakan email lain.',
            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'jabatan.required' => 'Jabatan wajib diisi untuk verifikator.',
            'desa_id.required' => 'Desa wajib dipilih untuk verifikator.',
            'desa_id.array' => 'Format desa tidak valid.',
            'desa_id.min' => 'Minimal satu desa harus dipilih untuk verifikator.',
        ];

        // Jalankan validasi
        $request->validate($rules, $messages);

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

        // Jika role verifikator, simpan ke tabel pivot
        if ($request->role === 'verifikator' && isset($request->desa_id)) {
            foreach ($request->desa_id as $desaId) {
                VerifikatorDesa::create([
                    'token_verifikator' => Str::random(12),
                    'user_id' => $user->id,
                    'desa_id' => $desaId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

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

    public function search(Request $request)
    {
        $query = $request->q;

        $desaTerverifikasi = VerifikatorDesa::pluck('desa_id')->toArray();

        // Cari desa yang belum ada di verifikator_desa
        $desa = Desa::where('nama_desa', 'like', "%{$query}%")
            ->whereNotIn('id', $desaTerverifikasi)
            ->limit(10)
            ->get();

        return response()->json($desa);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
