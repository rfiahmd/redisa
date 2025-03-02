<?php

namespace App\Http\Controllers;

use App\Exports\DisabilitasExport;
use App\Models\Desa;
use App\Models\DisabilitasModel;
use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use App\Models\VerifikatorDesa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DisabilitasController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;

        // Ambil daftar desa & kecamatan untuk filter
        $desaList = Desa::select('nama_desa')->distinct()->get();
        $kecamatanList = Desa::select('nama_kecamatan')->distinct()->get();

        // Query dasar
        $query = DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas');

        if ($user->hasRole('petugasdesa')) {
            $desa = Desa::where('user_id', $userId)->first();
            if (!$desa) {
                return abort(403, 'Anda tidak memiliki akses ke data ini.');
            }
            $query->where('desa_id', $desa->id);
        } elseif ($user->hasRole('verifikator')) {
            $desaIds = VerifikatorDesa::where('user_id', $userId)->pluck('desa_id');
            $query->whereIn('desa_id', $desaIds)->where('status', 'diterima');
        } elseif ($user->hasRole(['superadmin', 'adminpusat', 'kadis'])) {
            $query->where('status', 'diterima');
        } else {
            return abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        // Tambahkan filter berdasarkan desa dan/atau kecamatan
        if ($request->filled('desa') && $request->filled('kecamatan')) {
            // Filter berdasarkan desa & kecamatan yang sesuai
            $desaIds = Desa::where('nama_desa', $request->desa)
                ->where('nama_kecamatan', $request->kecamatan)
                ->pluck('id');

            $query->whereIn('desa_id', $desaIds);
        } elseif ($request->filled('desa')) {
            // Jika hanya filter desa
            $desaIds = Desa::where('nama_desa', $request->desa)->pluck('id');

            if ($desaIds->isNotEmpty()) {
                $query->whereIn('desa_id', $desaIds);
            }
        } elseif ($request->filled('kecamatan')) {
            // Jika hanya filter kecamatan
            $desaIds = Desa::where('nama_kecamatan', $request->kecamatan)->pluck('id');

            if ($desaIds->isNotEmpty()) {
                $query->whereIn('desa_id', $desaIds);
            }
        }


        $disabilitas = $query->get();

        return view('petugas-desa.disabilitas.disabilitas-view', compact('disabilitas', 'desaList', 'kecamatanList'));
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
            'deskripsi' => $request->deskripsi,
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

    public function exportExcel()
    {
        $user = auth()->user();
        $namaFile = 'data_disabilitas.xlsx';

        if ($user->hasRole('petugasdesa')) {
            $desa = $user->desa->nama_desa;
            $kecamatan = $user->desa->nama_kecamatan;

            $desaDuplikat = Desa::where('nama_desa', $desa)->count() > 1;

            if ($desaDuplikat) {
                $namaFile = 'data_disabilitas_' . str_replace(' ', '_', strtolower($desa)) . '_' . str_replace(' ', '_', strtolower($kecamatan)) . '.xlsx';
            } else {
                $namaFile = 'data_disabilitas_' . str_replace(' ', '_', strtolower($desa)) . '.xlsx';
            }
        }

        return Excel::download(new DisabilitasExport, $namaFile);
    }
}
