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
        ini_set('memory_limit', '1024M'); // Set batas memori agar cukup besar

        $kabupatenId = '3529'; // Kode Kabupaten Sumenep
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
                continue;
            }

            $desas = $desaResponse->json();

            foreach ($desas as $desa) {
                try {
                    DB::transaction(function () use ($desa, $kecamatan, $kabupatenId) {
                        $kodeDesa = $desa['id']; // Gunakan ID asli desa agar unik

                        // **1. Email Unik** (Tambahkan kode kecamatan supaya unik)
                        $email = strtolower(str_replace(' ', '', $desa['name'])) . $kecamatan['id'] . '@gmail.com';

                        // **2. Username Unik** (Tambahkan kode kecamatan jika ada yang sama)
                        $baseUsername = strtolower(str_replace(' ', '', $desa['name']));
                        $username = $baseUsername . $kecamatan['id'];
                        $counter = 1;
                        while (User::where('username', $username)->exists()) {
                            $username = $baseUsername . $kecamatan['id'] . $counter;
                            $counter++;
                        }

                        // **3. Nama Lengkap Unik** (Tambahkan nama kecamatan jika ada yang sama)
                        $namaLengkap = $desa['name'];
                        if (User::where('nama_lengkap', $namaLengkap)->exists()) {
                            $namaLengkap = $desa['name'] . ' - ' . $kecamatan['name'];
                        }

                        // Buat atau update user
                        $user = User::updateOrCreate(
                            ['email' => $email],
                            [
                                'token_users' => Str::random(12),
                                'nama_lengkap' => $namaLengkap,
                                'username' => $username,
                                'password' => 'redisa123',
                            ]
                        );

                        if ($user->wasRecentlyCreated) {
                            $user->assignRole('petugasdesa');
                        }

                        // Simpan data desa
                        Desa::updateOrCreate(
                            ['kode_desa' => $kodeDesa],
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
