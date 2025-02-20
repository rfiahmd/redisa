<?php

namespace App\Http\Controllers;

use App\Models\DisabilitasModel;
use App\Models\VerifikatorDesa;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $key = request('key');

        if ($user->role === 'superadmin' || $user->role === 'adminpusat') {
            $data = [
                'disabilitas' => DisabilitasModel::all(),
            ];
        } else {
            $verifikator = VerifikatorDesa::where('user_id', $user->id)->get();

            if ($verifikator->isEmpty()) {
                return redirect()->route('verifikasi.index')->with('error', 'Anda tidak memiliki akses ke data desa manapun.');
            }

            // Ambil ID desa yang terhubung dengan verifikator
            $desaIds = $verifikator->pluck('desa_id');

            if ($key) {
                $desa = VerifikatorDesa::where('token_verifikator', $key)->first();

                if (!$desa || !$desaIds->contains($desa->desa_id)) {
                    return redirect()->route('verifikasi.index')->with('error', 'Akses tidak diizinkan.');
                }

                $data = [
                    'disabilitas' => DisabilitasModel::where('desa_id', $desa->desa_id)->get(),
                    'key' => $desa,
                ];
            } else {
                $data = [
                    'disabilitas' => DisabilitasModel::whereIn('desa_id', $desaIds)->get(),
                ];
            }
        }

        return view('admin.verifikasi.verifikasi', $data);
    }
}
