<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
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
                        'jabatan' => $request->jabatan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Kirim email dengan kredensial login
            Mail::to($user->email)->send(new UserCreatedMail($user, $request->password));

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(UserRequest $request, $user)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($user);

            // Siapkan data untuk update
            $data = $request->only(['nama_lengkap', 'username', 'email']);

            // Update password jika diisi
            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            // Update user
            $user->update($data);

            // Ambil role lama
            $currentRole = $user->getRoleNames()->first();

            // Ambil role baru (default ke role lama jika kosong)
            $newRole = $request->input('role', $currentRole);

            // Update role hanya jika berubah
            if ($currentRole !== $newRole) {
                $user->syncRoles([$newRole]);
            }

            // Update tabel pivot jika role adalah verifikator
            if ($newRole === 'verifikator') {
                // Menghapus data desa yang dihapus oleh user
                $currentDesaIds = VerifikatorDesa::where('user_id', $user->id)->pluck('desa_id')->toArray();
                $updatedDesaIds = $request->desa_id;

                // Desa yang dihapus
                $desaToDelete = array_diff($currentDesaIds, $updatedDesaIds);
                VerifikatorDesa::whereIn('desa_id', $desaToDelete)->where('user_id', $user->id)->delete();

                // Desa yang baru atau yang belum ada
                $desaToAdd = array_diff($updatedDesaIds, $currentDesaIds);

                // Mengupdate atau menambah desa yang baru
                $desaData = collect($updatedDesaIds)->map(
                    fn($desaId) => [
                        'token_verifikator' => Str::random(12),
                        'user_id' => $user->id,
                        'desa_id' => $desaId,
                        'jabatan' => $request->jabatan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                );

                // Menambahkan desa baru ke pivot
                VerifikatorDesa::insert($desaData->toArray());
            }

            DB::commit();
            return back()->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    public function destroy($user)
    {
        $user = User::findOrFail($user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
