<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Desa;
use App\Models\DisabilitasModel;
use App\Models\Jenis\JenisDisabilitas;
use App\Models\User;
use App\Models\VerifikatorDesa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dssuperadmin()
    {
        return view('admin.dashboard');
    }

    public function dsadminpusat()
    {
        // Ambil data yang diperlukan untuk dashboard admin pusat
        $data = [ 
            'totalKategori' => JenisDisabilitas::count(),
            'totalDesa' => Desa::count(),
            'totalBantuan' => Bantuan::count(),
            'totalVerifikator' => User::role('verifikator')->count(),
            'disabilitasDiterima' => DisabilitasModel::where('status', 'diterima')->count(),
            'disabilitas' => DisabilitasModel::orderBy('created_at', 'desc')->take(10)->get(),
            'bantuan' => Bantuan::orderBy('created_at', 'desc')->take(10)->get(),
        ];
        return view('admin-pusat.dashboard', $data);
    }

    public function dsverifikator()
    {
        $user = auth()->user();
        $key = request('key');
        $verifikator = VerifikatorDesa::where('user_id', $user->id)->get();
        $desaIds = $verifikator->pluck('desa_id');

        $data = [
            'disabilitas' => DisabilitasModel::with('desa')->whereIn('desa_id', $desaIds)->get(),
            'total' => DisabilitasModel::with('desa')->whereIn('desa_id', $desaIds)->count(),
            'diterima' => DisabilitasModel::with('desa')->whereIn('desa_id', $desaIds)->where('status', 'diterima')->count(),
            'ditolak' => DisabilitasModel::with('desa')->whereIn('desa_id', $desaIds)->where('status', 'ditolak')->count(),
            'bantuan' => Bantuan::whereHas('disabilitas', function ($query) use ($desaIds) {
                $query->whereIn('desa_id', $desaIds);
            })->count(),
        ];
        return view('verifikator.dashboard', $data);
    }

    public function dspetugasdesa()
    {
        $user = auth()->user(); // Ambil user yang sedang login
        $userId = $user->id;
        // ✅ Jika petugas desa, tampilkan semua data disabilitas di desanya
        $desa = Desa::where('user_id', $userId)->first();

        if (!$desa) {
            return abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        $data = [
            'disabilitas' => DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')->where('desa_id', $desa->id)->get(),
            'total' => DisabilitasModel::where('desa_id', $desa->id)->count(),
            'diterima' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'diterima')->count(),
            'ditolak' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'ditolak')->count(),
            'direvisi' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'direvisi')->count(),
        ];
        return view('petugas-desa.dashboard', $data);
    }

    public function dskadis(Request $request)
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
        $desaIds = Desa::where('nama_desa', $request->desa)
            ->where('nama_kecamatan', $request->kecamatan)
            ->pluck('id');

        $query->whereIn('desa_id', $desaIds);
    } elseif ($request->filled('desa')) {
        $desaIds = Desa::where('nama_desa', $request->desa)->pluck('id');

        if ($desaIds->isNotEmpty()) {
            $query->whereIn('desa_id', $desaIds);
        }
    } elseif ($request->filled('kecamatan')) {
        $desaIds = Desa::where('nama_kecamatan', $request->kecamatan)->pluck('id');

        if ($desaIds->isNotEmpty()) {
            $query->whereIn('desa_id', $desaIds);
        }
    }

    $disabilitas = $query->get();

    // **Tambahkan jumlah desa yang memiliki data disabilitas**
    $desa_dengan_disabilitas = DisabilitasModel::distinct('desa_id')->count('desa_id');
    $desa = Desa::all()->count();
    $disabilitasdata = DisabilitasModel::where('status', 'diterima')->count();
    $verifikator = VerifikatorDesa::all()->count();
    $disabilitas_tolak = DisabilitasModel::where('status', 'ditolak')->count();

    return view('kadis.dashboard', compact(
        'disabilitas',
        'desaList',
        'kecamatanList',
        'desa',
        'disabilitasdata',
        'verifikator',
        'desa_dengan_disabilitas',
        'disabilitas_tolak'
    ));
}

}
