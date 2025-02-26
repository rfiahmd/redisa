<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Desa;
use App\Models\Jenis\JenisDisabilitas;

class DisabilitasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $desaIds = Desa::pluck('id')->toArray();
        $jenisDisabilitas = JenisDisabilitas::with('subJenis')->get();

        foreach (range(1, 500) as $index) {
            $jenis = $jenisDisabilitas->random();
            $subJenis = $jenis->subJenis()->inRandomOrder()->first();

            if (!$subJenis) {
                continue; // Skip if no subjenis found
            }

            DB::table('data_disabilitas')->insert([
                'desa_id' => $faker->randomElement($desaIds),
                'status' => $faker->randomElement(['diterima', 'direvisi', 'diproses']),
                'nik' => $faker->numerify('##############'),
                'nama' => $faker->name,
                'kelamin' => $faker->randomElement(['laki-laki', 'perempuan']),
                'alamat' => $faker->address,
                'usia' => $faker->numberBetween(5, 80),
                'pendidikan' => $faker->randomElement(['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Tidak Sekolah']),
                'tingkat_disabilitas' => $faker->randomElement(['Ringan', 'Sedang', 'Berat']),
                'id_jenis_disabilitas' => $jenis->id,
                'id_sub_jenis_disabilitas' => $subJenis->id,
                'keterangan' => $faker->sentence,
                'deskripsi' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
