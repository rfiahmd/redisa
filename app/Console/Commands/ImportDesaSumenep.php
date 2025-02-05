<?php

namespace App\Console\Commands;

use App\Models\Desa;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ImportDesaSumenep extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:desa-sumenep';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengimpor data desa di Kabupaten Sumenep dari API Emsifa';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $kabupatenId = '3529'; // Kode Kabupaten Sumenep

        // Ambil data kecamatan di Sumenep
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$kabupatenId}.json");

        if ($response->successful()) {
            $kecamatans = $response->json();

            foreach ($kecamatans as $kecamatan) {
                $desaResponse = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$kecamatan['id']}.json");

                if ($desaResponse->successful()) {
                    $desas = $desaResponse->json();

                    foreach ($desas as $desa) {
                        Desa::updateOrCreate(
                            ['kode_desa' => $desa['id']],
                            [
                                'nama_desa' => $desa['name'],
                                'kode_kecamatan' => $kecamatan['id'],
                                'nama_kecamatan' => $kecamatan['name'],
                                'kode_kabupaten' => $kabupatenId,
                                'nama_kabupaten' => 'Sumenep'
                            ]
                        );
                    }
                    $this->info("Berhasil menyimpan desa untuk kecamatan: {$kecamatan['name']}");
                } else {
                    $this->error("Gagal mengambil data desa untuk Kecamatan: {$kecamatan['name']}");
                }
            }
            $this->info('Semua data desa di Kabupaten Sumenep berhasil diimpor.');
        } else {
            $this->error('Gagal mengambil data kecamatan di Kabupaten Sumenep.');
        }
    }
}
