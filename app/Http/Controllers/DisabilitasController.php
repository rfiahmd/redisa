<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DisabilitasModel;
use App\Models\Jenis\JenisDisabilitas;
use App\Models\Jenis\SubJenis\SubJenisDisabilitas;
use Illuminate\Http\Request;

class DisabilitasController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id; // Ambil ID user yang sedang login

        // Ambil desa yang terkait dengan user
        $desa = Desa::where('user_id', $userId)->first();

        if (!$desa) {
            return abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $data = [
            'disabilitas' => DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')
                ->where('desa_id', $desa->id) // Gunakan desa_id untuk filter
                ->get(),
        ];

        return view('petugas-desa.disabilitas.disabilitas-view', $data);
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

        $desa = Desa::where('nama_desa', auth()->user()->nama_lengkap)->first();

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
            'keterangan' => $request->keterangan,
        ];

        // dd($data);

        DisabilitasModel::create($data);
        return redirect('/datadisabilitas')->with('success', 'Berhasil Menambahkan data');
    }
}
