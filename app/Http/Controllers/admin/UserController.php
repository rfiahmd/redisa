<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\UserCreatedMail;
use App\Models\User;
use App\Models\VerifikatorDesa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function adminpusat()
    {
        $data = [
            'adminpusat' => User::role('adminpusat')->get(),
        ];

        return view('admin.customer-service.adminpusat_cs', $data);
    }

    public function verifikator()
    {
        $data = [
            'verifikator' => User::role('verifikator')->with(['verifikatorDesa'])->get(),
            'datadesa' => DB::table('desa')->get(),
            'desa_terpilih' => VerifikatorDesa::pluck('desa_id')->toArray(),
            'verifikator_desa' => VerifikatorDesa::all(),
        ];

        return view('admin.customer-service.verifikator_cs', $data);
    }

    public function petugasdesa()
    {
        $data = [
            'petugasdesa' => User::role('petugasdesa')->get(),
        ];

        return view('admin.customer-service.petugasdesa_cs', $data);
    }

    public function kadis()
    {
        $data = [
            'kadis' => User::role('kadis')->get(),
        ];

        return view('admin.customer-service.kadis_cs', $data);
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

            // Redirect berdasarkan role
            switch ($request->role) {
                case 'adminpusat':
                    return redirect()->route('users.adminpusat')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
                case 'verifikator':
                    return redirect()->route('users.verifikator')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
                case 'petugasdesa':
                    return redirect()->route('users.petugasdesa')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
                case 'kadis':
                    return redirect()->route('users.kadis')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
                default:
                    return redirect()->route('users.index')->with('success', 'User berhasil dibuat dan kredensial telah dikirim ke email.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(UserRequest $request, $users)
    {
        DB::beginTransaction();

        try {
            // dd($request->all());
            $user = User::findOrFail($users);

            // Ambil data yang boleh diperbarui
            $data = $request->only(['nama_lengkap', 'username', 'email']);

            if ($request->filled('password')) {
                $data['password'] = $request->password;
            }

            $user->update($data);

            // Update desa hanya jika role user adalah verifikator
            if ($user->hasRole('verifikator')) {
                $updatedDesaIds = $request->input('desa_id', []);

                // Ambil desa_id yang sudah ada di database
                $currentDesaIds = VerifikatorDesa::where('user_id', $user->id)->pluck('desa_id')->toArray();

                // Hapus desa yang tidak dipilih
                $desaToDelete = array_diff($currentDesaIds, $updatedDesaIds);
                VerifikatorDesa::whereIn('desa_id', $desaToDelete)->where('user_id', $user->id)->delete();

                // Tambah desa yang baru dipilih
                foreach (array_diff($updatedDesaIds, $currentDesaIds) as $desaId) {
                    VerifikatorDesa::create([
                        'token_verifikator' => Str::random(12),
                        'user_id' => $user->id,
                        'desa_id' => $desaId,
                        'jabatan' => $request->jabatan,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Update jabatan
                VerifikatorDesa::where('user_id', $user->id)->update(['jabatan' => $request->jabatan]);
            }

            DB::commit();
            return back()->with('success', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($users)
    {
        DB::beginTransaction();

        try {
            $user = User::where('token_users', $users)->firstOrFail();
            $role = $user->getRoleNames()->first();

            if ($user->hasRole('verifikator')) {
                VerifikatorDesa::where('user_id', $user->id)->delete();
            }

            // Hapus data di desa yang terkait dengan user sebelum menghapus user
            DB::table('desa')->where('user_id', $user->id)->delete();

            $user->delete();

            DB::commit();

            // Redirect berdasarkan role yang dihapus
            switch ($role) {
                case 'adminpusat':
                    return redirect()->route('users.adminpusat')->with('delete_success', 'User berhasil dihapus.');
                case 'verifikator':
                    return redirect()->route('users.verifikator')->with('delete_success', 'User berhasil dihapus.');
                case 'petugasdesa':
                    return redirect()->route('users.petugasdesa')->with('delete_success', 'User berhasil dihapus.');
                case 'kadis':
                    return redirect()->route('users.kadis')->with('delete_success', 'User berhasil dihapus.');
                default:
                    return redirect()->route('users.index')->with('delete_success', 'User berhasil dihapus.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
