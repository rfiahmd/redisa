<?php

namespace App\Http\Controllers;

use App\Models\DisabilitasModel;
use App\Models\VerifikatorDesa;
use Illuminate\Http\Request;
use App\Http\Controllers\match;

class VerifikasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $key = request('key');

        if ($user->hasRole('superadmin') || $user->hasRole('adminpusat')) {
            // Superadmin & Admin Pusat dapat melihat semua data
            $data = [
                'disabilitas' => DisabilitasModel::all(),
                'key' => null,
            ];
        } else {
            // Ambil semua desa yang terkait dengan verifikator
            $verifikator = VerifikatorDesa::where('user_id', $user->id)->get();

            if ($verifikator->isEmpty()) {
                return redirect()->route('verifikasi.index')->with('error', 'Anda tidak memiliki akses ke data desa manapun.');
            }

            // Ambil ID semua desa yang bisa diakses oleh verifikator
            $desaIds = $verifikator->pluck('desa_id');

            if ($key) {
                $desa = VerifikatorDesa::where('token_verifikator', $key)->first();

                // Cek apakah desa yang dipilih sesuai dengan akses verifikator
                if (!$desa || !$desaIds->contains($desa->desa_id)) {
                    return redirect()->route('verifikasi.index')->with('error', 'Akses tidak diizinkan.');
                }

                // Jika key valid, tampilkan hanya data desa terkait
                $data = [
                    'disabilitas' => DisabilitasModel::where('desa_id', $desa->desa_id)->get(),
                    'key' => $desa,
                ];
            } else {
                // Jika tidak ada key, tampilkan semua desa yang terhubung ke verifikator
                $data = [
                    'disabilitas' => DisabilitasModel::whereIn('desa_id', $desaIds)->get(),
                    'key' => null,
                ];
            }
        }

        return view('admin.verifikasi.verifikasi', $data);
    }

    public function updateStatus($id, $action, Request $request)
    {
        $disabilitas = DisabilitasModel::find($id);

        if (!$disabilitas) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        switch ($action) {
            case 'terima':
                $disabilitas->status = 'diterima';
                $disabilitas->keterangan = 'Sudah selesai direvisi & diterima';
                $message = 'Data berhasil diterima.';
                break;

            case 'tolak':
                $disabilitas->status = 'ditolak';
                $message = 'Data berhasil ditolak.';
                break;

            case 'revisi':
                $disabilitas->status = 'direvisi';
                $disabilitas->keterangan = $request->keterangan;
                $message = 'Data berhasil direvisi.';
                break;

            default:
                return response()->json(['success' => false, 'message' => 'Aksi tidak valid.']);
        }

        $disabilitas->save();

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function updateRevision(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:data_disabilitas,id',
            'keterangan' => 'required|string',
        ]);

        $disabilitas = DisabilitasModel::find($request->id);

        if (!$disabilitas) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan!'], 404);
        }

        $disabilitas->keterangan = $request->keterangan;
        $disabilitas->save();

        return response()->json(['success' => true, 'message' => 'Revisi berhasil diperbarui']);
    }

    public function bulkAction(Request $request, $action)
    {
        $user = auth()->user(); // Ambil user yang sedang login

        if (!in_array($action, ['terima', 'tolak', 'revisi'])) {
            return response()->json(['success' => false, 'message' => 'Aksi tidak valid.'], 400);
        }

        // Tentukan status baru berdasarkan aksi
        switch ($action) {
            case 'terima':
                $status = 'diterima';
                break;
            case 'tolak':
                $status = 'ditolak';
                break;
            case 'revisi':
                $status = 'direvisi';
                break;
            default:
                $status = 'diproses';
        }

        // Jika user adalah verifikator desa, hanya bisa update data dari desa yang terkait
        if ($user->hasRole('verifikatordesa')) {
            $desaIds = VerifikatorDesa::where('user_id', $user->id)->pluck('desa_id');

            $query = DisabilitasModel::whereIn('desa_id', $desaIds)->where('status', '!=', $status);
        } elseif ($user->hasRole('superadmin')) {
            // Jika superadmin, update semua data tanpa filter desa
            $query = DisabilitasModel::where('status', '!=', $status);
        } else {
            return response()->json(['success' => false, 'message' => 'Anda tidak memiliki izin untuk melakukan aksi ini.'], 403);
        }

        // Cek apakah ada data yang bisa diperbarui
        $count = $query->count();

        if ($count === 0) {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dapat diperbarui.'], 400);
        }

        // Siapkan data update
        $updateData = ['status' => $status];

        if ($action === 'revisi') {
            $updateData['keterangan'] = $request->keterangan;
        }

        // Update data
        $query->update($updateData);

        return response()->json(['success' => true, 'message' => "Sebanyak $count data berhasil diperbarui."]);
    }
}
