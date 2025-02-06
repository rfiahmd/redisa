<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'desa' => Desa::orderBy('nama_desa')->get()
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

        $data = [
            'nama_desa' => $request->desa,
            'nama_kecamatan' => $request->kecamatan,
            'nama_kabupaten' => 'Sumenep',
            'kode_desa' => Str::upper(Str::random(10)),
        ];

        Desa::create($data);
        return redirect()->route('desa')->with('success', 'Data desa berhasil ditambahkan');
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
        $request->validate([
            'desa' => 'required',
            'kecamatan' => 'required',
        ],[
            'desa.required' => 'Nama desa harus diisi',
            'kecamatan.required' => 'Nama kecamatan harus diisi',
        ]);

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
        Desa::where('kode_desa', $id)->delete();
        return redirect()->route('desa')->with('delete_success', 'Data desa berhasil dihapus');
    }
}
