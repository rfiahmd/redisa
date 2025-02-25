<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DisabilitasModel;
use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use App\Models\VerifikatorDesa;
use Illuminate\Http\Request;

class DisabilitasController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $userId = $user->id;

        if ($user->hasRole('petugasdesa')) {
            // ✅ Jika petugas desa, tampilkan semua data disabilitas di desanya
            $desa = Desa::where('user_id', $userId)->first();

            if (!$desa) {
                return abort(403, 'Anda tidak memiliki akses ke data ini.');
            }

            $disabilitas = DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')
                ->where('desa_id', $desa->id)
                ->get();
        } elseif ($user->hasRole('verifikator')) {
            // ✅ Jika verifikator desa, cari semua desa yang terhubung dengan user ini
            $verifikator = VerifikatorDesa::where('user_id', $userId)->pluck('desa_id');

            // ✅ Ambil hanya disabilitas yang "diterima" dan berasal dari desa-desa yang terhubung dengan verifikator
            $disabilitas = DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')
                ->whereIn('desa_id', $verifikator)
                ->where('status', 'diterima')
                ->get();
        } elseif ($user->hasRole('superadmin') || $user->hasRole('adminpusat') || $user->hasRole('kadis')) {
            // ✅ Jika superadmin, tampilkan semua disabilitas yang berstatus diterima dari semua desa
            $disabilitas = DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')
                ->where('status', 'diterima')
                ->get();
        } else {
            return abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('petugas-desa.disabilitas.disabilitas-view', compact('disabilitas'));
    }

    public function create()
    {
        $data = [
            'jenis' => JenisDisabilitas::all(),
        ];
        return view('petugas-desa.disabilitas.disabilitas-create', $data);
    }

    public function getSubJenis(request $request)
    {
        $id_jenis = $request->id_jenis;

        $subjenis = SubJenisDisabilitas::where('jenis_disabilitas_id', $id_jenis)->get();

        foreach ($subjenis as $sub) {
            echo "<option value='$sub->id'>$sub->nama_sub_jenis</option>";
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:data_disabilitas,nik|min:16',
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
            'usia' => 'required',
            'pendidikan' => 'required',
            'tingkat' => 'required',
            'jenis' => 'required',
            'subjenis' => 'required',
        ]);

        $desa = Desa::where('user_id', auth()->id())->first();

        // dd($desa);

        $data = [
            'desa_id' => $desa->id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'kelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
            'usia' => $request->usia,
            'pendidikan' => $request->pendidikan,
            'tingkat_disabilitas' => $request->tingkat,
            'id_jenis_disabilitas' => $request->jenis,
            'id_sub_jenis_disabilitas' => $request->subjenis,
            'deskripsi' => $request->deskripsi
        ];

        DisabilitasModel::create($data);
        return redirect('/datadisabilitas')->with('success', 'Berhasil Menambahkan data');
    }

    public function edit($id)
    {
        $data = [
            'disabilitas' => DisabilitasModel::where('nik', $id)->first(),
            'jenis' => JenisDisabilitas::all(),
            'sub' => SubJenisDisabilitas::all(),
        ];

        return view('petugas-desa.disabilitas.disabilitas-edit', $data);
    }

    public function update(Request $request, $nik)
    {
        $request->validate([
            'nik' => 'required|min:16',
            'nama' => 'required',
            'jeniskelamin' => 'required',
            'alamat' => 'required',
            'usia' => 'required',
            'pendidikan' => 'required',
            'tingkat' => 'required',
            'jenis' => 'required',
            'subjenis' => 'required',
        ]);

        $disabilitas = DisabilitasModel::where('nik', $nik)->first();

        if (!$disabilitas) {
            return redirect()->back()->with('error', 'Data tidak ditemukan!');
        }

        // Jika status saat ini adalah "direvisi", ubah ke "diproses"
        if ($disabilitas->status == 'direvisi' || $disabilitas->status == 'ditolak') {
            $status = 'diproses';
        } else {
            $status = $disabilitas->status; // Biarkan status tetap jika bukan "direvisi"
        }

        $disabilitas->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'kelamin' => $request->jeniskelamin,
            'alamat' => $request->alamat,
            'usia' => $request->usia,
            'pendidikan' => $request->pendidikan,
            'tingkat_disabilitas' => $request->tingkat,
            'id_jenis_disabilitas' => $request->jenis,
            'id_sub_jenis_disabilitas' => $request->subjenis,
            'deskripsi' => $request->deskripsi,
            'status' => $status, // Simpan status baru
        ]);

        return redirect()->route('disabilitas')->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($id)
    {
        DisabilitasModel::where('nik', $id)->delete();
        return redirect('/datadisabilitas')->with('delete_success', 'Berhasil Menghapus Data');
    }
}
