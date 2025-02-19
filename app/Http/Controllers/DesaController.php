<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'desa' => Desa::orderBy('nama_desa')->get(),
        ];

        return view('admin.desa.desa-view', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'desa' => 'required|unique:desa,nama_desa',
        'kecamatan' => 'required',
    ],[
        'desa.required' => 'Nama desa harus diisi',
        'desa.unique' => 'Nama desa sudah terdaftar, silakan gunakan nama lain.',
        'kecamatan.required' => 'Nama kecamatan harus diisi',
    ]);

    DB::transaction(function () use ($request) {
        // **1. Generate Email Unik**
        $baseEmail = strtolower(str_replace(' ', '', $request->desa . '_' . $request->kecamatan));
        $email = $baseEmail . '@gmail.com';

        $counter = 1;
        while (User::where('email', $email)->exists()) {
            $email = $baseEmail . $counter . '@gmail.com';
            $counter++;
        }

        // **2. Generate Username Unik**
        $baseUsername = strtolower(str_replace(' ', '', $request->desa));
        $username = $baseUsername . Str::random(3);

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . Str::random(3);
        }

        // **3. Buat User Baru**
        $user = User::create([
            'token_users' => Str::random(12),
            'nama_lengkap' => $request->desa,
            'username' => $username,
            'password' => 'redisa123',
            'email' => $email,
        ]);

        // **4. Assign Role "petugasdesa" jika user baru**
        $user->assignRole('petugasdesa');

        // **5. Simpan Data Desa dengan user_id**
        Desa::create([
            'nama_desa' => $request->desa,
            'nama_kecamatan' => $request->kecamatan,
            'nama_kabupaten' => 'Sumenep',
            'kode_desa' => Str::upper(Str::random(10)),
            'user_id' => $user->id, // Hubungkan desa dengan user yang baru dibuat
        ]);
    });

    return redirect()->route('desa')->with('success', 'Data desa & akun user berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desa $desa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'desa' => 'required',
                'kecamatan' => 'required',
            ],
            [
                'desa.required' => 'Nama desa harus diisi',
                'kecamatan.required' => 'Nama kecamatan harus diisi',
            ],
        );

        $data = [
            'nama_desa' => $request->desa,
            'nama_kecamatan' => $request->kecamatan,
            'nama_kabupaten' => 'Sumenep',
            'kode_desa' => Str::upper(Str::random(10)),
        ];

        Desa::where('kode_desa', $id)->update($data);
        return redirect()->route('desa')->with('success', 'Data desa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $desa = Desa::where('kode_desa', $id)->first();
        User::where('id', $desa->user_id)->delete();
        $desa->delete();
        return redirect()->route('desa')->with('delete_success', 'Data desa berhasil dihapus');
    }
}
