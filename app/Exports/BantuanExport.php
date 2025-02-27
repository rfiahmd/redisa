<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Illuminate\Support\Str;

class BantuanExport implements FromCollection, WithMapping, WithEvents
{
    private $counter = 0;
    private $user;
    private $isPetugasDesa;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->isPetugasDesa = $this->user->hasRole('petugasdesa');
    }

    public function collection()
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

    public function map($row): array
    {
        $data = [
            ++$this->counter . '.',
            $row->nama,
            "\t" . $row->nik,
            $row->jenis_disabilitas,
            $row->tingkat_disabilitas,
            $row->statusbantuan,
        ];

        if (!$this->isPetugasDesa) {
            $data[] = Str::title($row->nama_desa);
            $data[] = Str::title($row->nama_kecamatan);
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Tentukan judul sesuai peran pengguna
                if ($this->isPetugasDesa) {
                    $judul = "Data Bantuan Disabilitas Desa " . Str::title($this->user->desa->nama_desa) . ",\n Kec. ". Str::title($this->user->desa->nama_kecamatan) . ", Kab. Sumenep";
                    $headerColumns = ['No', 'Nama', 'NIK', 'Jenis Disabilitas', 'Tingkat Disabilitas', 'Status Bantuan'];
                    $mergeRange = 'A1:F1';
                } else {
                    $judul = "Data Bantuan Disabilitas Kabupaten Sumenep";
                    $headerColumns = ['No', 'Nama', 'NIK', 'Jenis Disabilitas', 'Tingkat Disabilitas', 'Status Bantuan', 'Desa', 'Kecamatan'];
                    $mergeRange = 'A1:H1';
                }

                // Menetapkan judul di baris pertama
                $sheet->setCellValue('A1', $judul);
                $sheet->mergeCells($mergeRange);
                $sheet->getStyle('A1')->getAlignment()->setWrapText(true); 

                // Styling Judul (Baris 1)
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 20,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '008000'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Menetapkan header di baris kedua
                $sheet->fromArray([$headerColumns], null, 'A2');

                // Styling Header Tabel (Baris 2)
                $lastColumn = $this->isPetugasDesa ? 'F' : 'H';
                $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '1E90FF'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'FFFFFF'], // Garis putih transparan untuk header biru
                        ],
                    ],
                ]);

                // Mengatur tinggi baris header agar lebih besar
                $sheet->getRowDimension(2)->setRowHeight(20);
                if ($this->isPetugasDesa) { 
                    $sheet->getRowDimension(1)->setRowHeight(55);
                } else {
                    $sheet->getRowDimension(1)->setRowHeight(35);
                }
                // Mengatur lebar kolom agar sesuai isi
                foreach (range('A', $lastColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
