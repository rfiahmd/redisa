<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Desa;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class VerifikatorDesaSeeder extends Seeder
{
    public function run()
    {
        DB::beginTransaction();

        try {
            $faker = Faker::create('id_ID'); // Gunakan bahasa Indonesia
            $allDesaIds = Desa::pluck('id')->toArray();
            shuffle($allDesaIds); // Acak daftar desa agar distribusi lebih alami
            $totalDesa = count($allDesaIds);
            $totalVerifikator = 30; // Hanya buat 30 verifikator

            // Buat 30 user dengan data realistis
            $verifikatorUsers = [];
            for ($i = 0; $i < $totalVerifikator; $i++) {
                $namaLengkap = $faker->name;
                $username = strtolower(str_replace(' ', '', $namaLengkap));
                $email = $username . '@example.com';

                $user = User::create([
                    'token_users' => Str::random(12),
                    'username' => $username,
                    'email' => $email,
                    'nama_lengkap' => $namaLengkap,
                    'password' => 'redisa123',
                ]);

                $user->assignRole('verifikator');

                $verifikatorUsers[] = $user->id;
            }

            // Distribusi desa ke verifikator secara acak
            $desaIndex = 0;
            $desaTerpakai = []; // Menyimpan desa yang sudah memiliki verifikator

            foreach ($verifikatorUsers as $userId) {
                if ($desaIndex >= $totalDesa) {
                    break; // Jika semua desa sudah terisi, hentikan
                }

                // Setiap verifikator mendapatkan 1 desa secara acak
                $desaAssignments = [$allDesaIds[$desaIndex]];
                $desaTerpakai[] = $allDesaIds[$desaIndex];
                $desaIndex++;

                // 50% kemungkinan mendapatkan desa tambahan jika masih ada desa yang tersisa
                if ($desaIndex < $totalDesa && rand(0, 1)) {
                    $desaAssignments[] = $allDesaIds[$desaIndex];
                    $desaTerpakai[] = $allDesaIds[$desaIndex];
                    $desaIndex++;
                }

                foreach ($desaAssignments as $desaId) {
                    DB::table('verifikator_desa')->insert([
                        'token_verifikator' => Str::random(12),
                        'user_id' => $userId,
                        'desa_id' => $desaId,
                        'jabatan' => $faker->jobTitle, // Gunakan jabatan acak dalam bahasa Indonesia
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Jika masih ada desa yang belum memiliki verifikator, tambahkan ke verifikator secara acak
            $desaBelumTerisi = array_diff($allDesaIds, $desaTerpakai);
            if (!empty($desaBelumTerisi)) {
                $desaBelumTerisi = array_values($desaBelumTerisi);
                shuffle($desaBelumTerisi); // Acak agar lebih alami

                foreach ($desaBelumTerisi as $desaId) {
                    $randomUserId = $verifikatorUsers[array_rand($verifikatorUsers)]; // Pilih verifikator secara acak

                    DB::table('verifikator_desa')->insert([
                        'token_verifikator' => Str::random(12),
                        'user_id' => $randomUserId,
                        'desa_id' => $desaId,
                        'jabatan' => $faker->jobTitle,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit();
            echo "Seeder berhasil dijalankan. 30 Verifikator telah dibuat dan semua desa memiliki verifikator.\n";
        } catch (\Exception $e) {
            DB::rollBack();
            echo "Seeder gagal dijalankan: " . $e->getMessage() . "\n";
        }
    }
}
