<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DisabilitasModel;
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
        return view('admin-pusat.dashboard');
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

            $data =[
                'disabilitas' => DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas')->where('desa_id', $desa->id)->get(),
                'total' => DisabilitasModel::where('desa_id', $desa->id)->count(),
                'diterima' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'diterima')->count(),
                'ditolak' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'ditolak')->count(),
                'direvisi' => DisabilitasModel::where('desa_id', $desa->id)->where('status', 'direvisi')->count(),
            ];
        return view('petugas-desa.dashboard', $data);
    }

    public function dskadis()
    {
        return view('kadis.dashboard');
    }
}
