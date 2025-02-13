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
                        DB::transaction(function () use ($desa, $kecamatan, $kabupatenId) {
                            $kodeDesa = substr($desa['id'], -3);

                            $email = strtolower(str_replace(' ', '', $desa['name'])) . $kodeDesa . '@gmail.com';

                            $baseUsername = strtolower(str_replace(' ', '', $desa['name']));
                            $username = $baseUsername;
                            $counter = 1;
                            while (User::where('username', $username)->exists()) {
                                $username = $baseUsername . $counter;
                                $counter++;
                            }

                            $user = User::updateOrCreate(
                                ['email' => $email],
                                [
                                    'token_users' => Str::random(12),
                                    'nama_lengkap' => $desa['name'],
                                    'username' => $username,
                                    'password' => 'redisa123',
                                ]
                            );

                            if ($user->wasRecentlyCreated) {
                                $user->assignRole('petugasdesa');
                            }

                            Desa::updateOrCreate(
                                ['kode_desa' => $kodeDesa], // Menggunakan kode desa 3 karakter
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

                        $this->info("Data desa '{$desa['name']}' berhasil disimpan beserta akun user.");
                    }
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
