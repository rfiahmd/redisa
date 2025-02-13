<?php

namespace App\Console\Commands;

use App\Models\Desa;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    protected $description = 'Mengimpor data desa di Kabupaten Sumenep dari API Emsifa dan membuat akun untuk setiap desa.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('max_execution_time', 600); // Set batas waktu eksekusi ke 10 menit
        ini_set('memory_limit', '512M'); // Set batas memori agar cukup besar

        $kabupatenId = '3529'; // Kode Kabupaten Sumenep

        // Ambil data kecamatan di Sumenep
        $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$kabupatenId}.json");

        if (!$response->successful()) {
            $this->error('Gagal mengambil data kecamatan di Kabupaten Sumenep.');
            return;
        }

        $kecamatans = $response->json();

        foreach ($kecamatans as $kecamatan) {
            $desaResponse = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$kecamatan['id']}.json");

            if (!$desaResponse->successful()) {
                $this->error("Gagal mengambil data desa untuk Kecamatan: {$kecamatan['name']} (ID: {$kecamatan['id']})");
                continue; // Lanjut ke kecamatan berikutnya
            }

            $desas = $desaResponse->json();

            foreach ($desas as $desa) {
                try {
                    DB::transaction(function () use ($desa, $kecamatan, $kabupatenId) {
                        $kodeDesa = $desa['id']; // Gunakan ID asli desa agar unik

                        // Membuat email unik berdasarkan nama desa
                        $email = strtolower(str_replace(' ', '', $desa['name'])) . '@gmail.com';

                        // Pastikan username unik
                        $baseUsername = strtolower(str_replace(' ', '', $desa['name']));
                        $username = $baseUsername;
                        $counter = 1;
                        while (User::where('username', $username)->exists()) {
                            $username = $baseUsername . $counter;
                            $counter++;
                        }

                        // Buat user baru atau perbarui jika sudah ada
                        $user = User::updateOrCreate(
                            ['email' => $email],
                            [
                                'token_users' => Str::random(12),
                                'nama_lengkap' => $desa['name'],
                                'username' => $username,
                                'password' => 'redisa123',
                            ]
                        );

                        // Berikan role jika user baru
                        if ($user->wasRecentlyCreated) {
                            $user->assignRole('petugasdesa');
                        }

                        // Simpan data desa
                        Desa::updateOrCreate(
                            ['kode_desa' => $kodeDesa], // Pastikan unik
                            [
                                'nama_desa' => $desa['name'],
                                'kode_kecamatan' => $kecamatan['id'],
                                'nama_kecamatan' => $kecamatan['name'],
                                'kode_kabupaten' => $kabupatenId,
                                'nama_kabupaten' => 'Sumenep',
                                'user_id' => $user->id,
                            ]
                        );
                    });

                    $this->info("✅ Desa '{$desa['name']}' berhasil disimpan beserta akun user.");
                } catch (\Exception $e) {
                    $this->error("❌ Gagal menyimpan desa '{$desa['name']}': " . $e->getMessage());
                }
            }
        }

        $this->info('🎉 Semua data desa di Kabupaten Sumenep berhasil diimpor.');
    }
}
