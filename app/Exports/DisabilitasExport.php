<?php

namespace App\Exports;

use App\Models\DisabilitasModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Illuminate\Support\Str;

class DisabilitasExport implements FromCollection, WithMapping, WithEvents
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
        return DisabilitasModel::with('jenisDisabilitas', 'subJenisDisabilitas', 'desa')
            ->when(!$this->isPetugasDesa, function ($query) {
                return $query->where('status', 'diterima');
            })
            ->when($this->isPetugasDesa, function ($query) {
                return $query->where('desa_id', $this->user->desa->id);
            })
            ->get();
    }

    public function map($row): array
    {
        $data = [
            ++$this->counter . '.',
            $row->nama,
            "\t" . $row->nik,
            $row->kelamin,
            $row->alamat,
            $row->usia,
            $row->pendidikan,
            $row->jenisDisabilitas->nama_jenis . ', ' . $row->subJenisDisabilitas->nama_sub_jenis,
            $row->tingkat_disabilitas,
        ];

        if ($this->isPetugasDesa) {
            $data[] = $row->status;
        } else {
            $data[] = Str::title($row->desa->nama_desa);
            $data[] = Str::title($row->desa->nama_kecamatan);
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $headerColumns = $this->isPetugasDesa
                    ? ['No', 'Nama', 'NIK', 'Jenis Kelamin', 'Alamat', 'Usia', 'Pendidikan', 'Jenis Disabilitas', 'Tingkat Disabilitas', 'Status']
                    : ['No', 'Nama', 'NIK', 'Jenis Kelamin', 'Alamat', 'Usia', 'Pendidikan', 'Jenis Disabilitas', 'Tingkat Disabilitas', 'Desa', 'Kecamatan'];

                $mergeRange = $this->isPetugasDesa ? 'A1:J1' : 'A1:K1';
                $judul = $this->isPetugasDesa
                    ? "Data Disabilitas Desa " . Str::title($this->user->desa->nama_desa) . ", Kec. " . Str::title($this->user->desa->nama_kecamatan) . ", Kab. Sumenep"
                    : "Data Disabilitas Kabupaten Sumenep";

                $sheet->setCellValue('A1', $judul);
                $sheet->mergeCells($mergeRange);
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 20, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '008000']],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                $sheet->fromArray([$headerColumns], null, 'A2');
                $lastColumn = $this->isPetugasDesa ? 'J' : 'K';
                $sheet->getStyle("A2:{$lastColumn}2")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '1E90FF']],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 'wrapText' => true],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => 'FFFFFF'],
                        ],
                    ],
                ]);

                foreach (range('A', $lastColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
