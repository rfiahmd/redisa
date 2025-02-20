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
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'adminpusat' => User::role('adminpusat')->get(),
            'verifikator' => User::role('verifikator')->get(),
            'petugasdesa' => User::role('petugasdesa')->get(),
            'kadis' => User::role('kadis')->get(),
            'datadesa' => DB::table('desa')->get(),
            'desa_terpilih' => VerifikatorDesa::pluck('desa_id')->toArray(),
            'verifikator_desa' => VerifikatorDesa::all(),
        ];

        return view('admin.customer-service.cs_view', $data);
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $baseUsername = strtolower(str_replace(' ', '', $request->nama_lengkap));
            $username = $baseUsername;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $user = User::create([
                'token_users' => Str::random(12),
                'username' => $username,
                'email' => $request->email,
                'nama_lengkap' => $request->nama_lengkap,
                'password' => $request->password,
            ]);

            $user->assignRole($request->role);

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
            dd($request->all());
            $user = User::findOrFail($user);

            // Siapkan data untuk update
            $data = $request->only(['nama_lengkap', 'username', 'email']);

            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            $user->update($data);

            // Ambil role lama
            $currentRole = $user->getRoleNames()->first();
            $newRole = $request->input('role', $currentRole);

            if ($newRole === 'verifikator') {
                // Pastikan $updatedDesaIds selalu berupa array
                $updatedDesaIds = $request->input('states', []);

                // Ambil desa_id yang sudah ada di database
                $currentDesaIds = VerifikatorDesa::where('user_id', $user->id)->pluck('desa_id')->toArray();

                // Menghapus desa yang tidak lagi dipilih
                $desaToDelete = array_diff($currentDesaIds, $updatedDesaIds);
                VerifikatorDesa::whereIn('desa_id', $desaToDelete)->where('user_id', $user->id)->delete();

                // Menambahkan desa yang baru dipilih
                $desaToAdd = array_diff($updatedDesaIds, $currentDesaIds);
                foreach ($desaToAdd as $desaId) {
                    if (!VerifikatorDesa::where('user_id', $user->id)->where('desa_id', $desaId)->exists()) {
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

                // Update jabatan untuk desa yang masih ada
                foreach ($updatedDesaIds as $desaId) {
                    $verifikatorDesa = VerifikatorDesa::where('user_id', $user->id)->where('desa_id', $desaId)->first();
                    if ($verifikatorDesa) {
                        $verifikatorDesa->update([
                            'jabatan' => $request->jabatan
                        ]);
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($users)
    {
        DB::beginTransaction();

        try {
            $user = User::where('token_users', $users)->firstOrFail();

            if ($user->hasRole('verifikator')) {
                VerifikatorDesa::where('user_id', $user->id)->delete();
            }

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('delete_success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
