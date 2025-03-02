<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BantuanPDF
{
    private $user;
    private $isPetugasDesa;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->isPetugasDesa = $this->user->hasRole('petugasdesa');
    }

    public function getData()
    {
        $query = DB::table('data_disabilitas')
            ->join('jenis_disabilitas', 'data_disabilitas.id_jenis_disabilitas', '=', 'jenis_disabilitas.id')
            ->join('sub_jenis_disabilitas', 'data_disabilitas.id_sub_jenis_disabilitas', '=', 'sub_jenis_disabilitas.id')
            ->join('desa', 'data_disabilitas.desa_id', '=', 'desa.id')
            ->leftJoin('bantuan', 'data_disabilitas.id', '=', 'bantuan.disabilitas_id')
            ->select(
                'data_disabilitas.id',
                'data_disabilitas.nama',
                'data_disabilitas.nik',
                DB::raw("CONCAT(jenis_disabilitas.nama_jenis, ', ', sub_jenis_disabilitas.nama_sub_jenis) as jenis_disabilitas"),
                'data_disabilitas.tingkat_disabilitas',
                DB::raw("CASE WHEN bantuan.id IS NOT NULL THEN 'Menerima' ELSE 'Belum Menerima' END as statusbantuan"),
                'desa.nama_desa',
                'desa.nama_kecamatan'
            )
            ->where('data_disabilitas.status', 'diterima');

        if ($this->isPetugasDesa) {
            $desa = $this->user->desa;
            if ($desa) {
                $query->where('desa.id', $desa->id);
            }
        }

        return $query->get();
    }

    public function downloadPDF()
    {
        $data = $this->getData();
        $judul = $this->isPetugasDesa
            ? "Data Bantuan Disabilitas Desa " . Str::title($this->user->desa->nama_desa) . ",\nKec. " . Str::title($this->user->desa->nama_kecamatan) . ", Kab. Sumenep"
            : "Data Bantuan Disabilitas Kabupaten Sumenep";

        $pdf = Pdf::loadView('exports.bantuan_pdf', compact('data', 'judul'));
        return $pdf->download('data_bantuan_disabilitas.pdf');
    }
}
