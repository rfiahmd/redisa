<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BantuanRequest;
use App\Models\Bantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BantuanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $key = $request->query('key');
        $desaFilter = $request->query('desa');
        $kecamatanFilter = $request->query('kecamatan');

        $queryMenerima = DB::table('bantuan')
            ->join('data_disabilitas', 'bantuan.disabilitas_id', '=', 'data_disabilitas.id')
            ->join('jenis_disabilitas', 'data_disabilitas.id_jenis_disabilitas', '=', 'jenis_disabilitas.id')
            ->join('sub_jenis_disabilitas', 'data_disabilitas.id_sub_jenis_disabilitas', '=', 'sub_jenis_disabilitas.id')
            ->join('desa', 'data_disabilitas.desa_id', '=', 'desa.id')
            ->select(
                'bantuan.id',
                'data_disabilitas.*',
                'jenis_disabilitas.nama_jenis as jenis_disabilitas',
                'sub_jenis_disabilitas.nama_sub_jenis as sub_disabilitas',
                'bantuan.*',
                'desa.nama_desa',
                'desa.nama_kecamatan'
            );

        $queryBelum = DB::table('data_disabilitas')
            ->join('jenis_disabilitas', 'data_disabilitas.id_jenis_disabilitas', '=', 'jenis_disabilitas.id')
            ->join('sub_jenis_disabilitas', 'data_disabilitas.id_sub_jenis_disabilitas', '=', 'sub_jenis_disabilitas.id')
            ->join('desa', 'data_disabilitas.desa_id', '=', 'desa.id')
            ->leftJoin('bantuan', 'data_disabilitas.id', '=', 'bantuan.disabilitas_id')
            ->whereNull('bantuan.id')
            ->where('data_disabilitas.status', 'diterima')
            ->select(
                'data_disabilitas.id',
                'data_disabilitas.nama',
                'data_disabilitas.nik',
                'data_disabilitas.tingkat_disabilitas',
                'jenis_disabilitas.nama_jenis as jenis_disabilitas',
                'sub_jenis_disabilitas.nama_sub_jenis as sub_disabilitas',
                'desa.nama_desa',
                'desa.nama_kecamatan'
            );

        if ($user->hasRole('verifikator')) {
            $desaIds = DB::table('verifikator_desa')
                ->where('user_id', $user->id)
                ->pluck('desa_id')
                ->toArray();

            if ($key) {
                $desaIds = DB::table('verifikator_desa')
                    ->where('token_verifikator', $key)
                    ->pluck('desa_id')
                    ->toArray();
            }

            if (!empty($desaIds)) {
                $queryMenerima->whereIn('desa.id', $desaIds);
                $queryBelum->whereIn('desa.id', $desaIds);
            }
        } elseif ($user->hasRole('petugasdesa')) {
            $desa = $user->desa;

            if (!$desa) {
                abort(403, 'User tidak memiliki desa terkait.');
            }

            $queryMenerima->where('desa.id', $desa->id);
            $queryBelum->where('desa.id', $desa->id);
        } else {
            // Jika user bukan verifikator atau petugasdesa, terapkan filter desa dan kecamatan
            if (!empty($desaFilter)) {
                $queryMenerima->where('desa.nama_desa', 'LIKE', "%$desaFilter%");
                $queryBelum->where('desa.nama_desa', 'LIKE', "%$desaFilter%");
            }
            if (!empty($kecamatanFilter)) {
                $queryMenerima->where('desa.nama_kecamatan', 'LIKE', "%$kecamatanFilter%");
                $queryBelum->where('desa.nama_kecamatan', 'LIKE', "%$kecamatanFilter%");
            }
        }

        $desaList = DB::table('desa')->select('nama_desa')->get();
        $kecamatanList = DB::table('desa')->select('nama_kecamatan')->distinct()->get();

        return view('admin.bantuan-disabilitas.bantuan_view', [
            'dataMenerima' => $queryMenerima->get(),
            'dataBelum' => $queryBelum->get(),
            'desaList' => $desaList,
            'kecamatanList' => $kecamatanList,
            'key' => $key ?? '',
        ]);
    }

    public function store(BantuanRequest $request)
    {
        Bantuan::create([
            'token_bantuan' => Str::random(12),
            'disabilitas_id' => $request->disabilitas_id,
            'jenis_bantuan' => $request->jenis_bantuan,
            'type_bantuan' => $request->type_bantuan,
            'nominal' => $request->type_bantuan === 'tunai' ? intval($request->nominal) : null,
            'nama_barang' => $request->type_bantuan === 'barang' ? $request->nama_barang : null,
            'jumlah_barang' => $request->type_bantuan === 'barang' ? $request->jumlah_barang : null,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Bantuan berhasil ditambahkan!');
    }

    public function update(BantuanRequest $request, $id)
    {
        $bantuan = Bantuan::findOrFail($id);
        $bantuan->update([
            'jenis_bantuan' => $request->jenis_bantuan,
            'type_bantuan' => $request->type_bantuan,
            'nominal' => $request->type_bantuan === 'tunai' ? intval($request->nominal) : null,
            'nama_barang' => $request->type_bantuan === 'barang' ? $request->nama_barang : null,
            'jumlah_barang' => $request->type_bantuan === 'barang' ? $request->jumlah_barang : null,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Bantuan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Bantuan berhasil dibatalkan/dihapus!');
    }
}
