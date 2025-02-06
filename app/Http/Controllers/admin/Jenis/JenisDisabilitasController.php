<?php

namespace App\Http\Controllers\admin\Jenis;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jenis\JenisDisabilitasRequest; // Menggunakan request yang benar
use App\Models\Jenis\JenisDisabilitas; // Model untuk JenisDisabilitas
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JenisDisabilitasController extends Controller
{
    public function index()
    {
        $data = JenisDisabilitas::with('subJenis')->get();

        return view('admin.jenis-disabilitas.jenis_disabilitas_view', compact('data'));
    }

    public function store(JenisDisabilitasRequest $request)
    {
        $jenisDisabilitas = new JenisDisabilitas();
        $jenisDisabilitas->token_jenis = Str::uuid()->toString();
        $jenisDisabilitas->fill($request->validated());
        $jenisDisabilitas->save();

        return redirect()->route('jenis.index')->with('success', 'Jenis Disabilitas berhasil ditambahkan');
    }

    public function update(JenisDisabilitasRequest $request, JenisDisabilitas $jenisDisabilitas)
    {
        $jenisDisabilitas->update($request->validated());
        return redirect()->route('jenis.index')->with('success', 'Jenis Disabilitas berhasil diperbarui');
    }

    public function destroy($token)
    {
        $jenisDisabilitas = JenisDisabilitas::where('token_jenis', $token)->firstOrFail();

        // Hapus semua Sub Jenis yang terkait
        $jenisDisabilitas->subJenis()->delete();

        // Hapus jenis utama
        $jenisDisabilitas->delete();

        return redirect()->route('jenis.index')->with('delete_success', 'Jenis Disabilitas dan semua sub jenis terkait berhasil dihapus.');
    }
}
