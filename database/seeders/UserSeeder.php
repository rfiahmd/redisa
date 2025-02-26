<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat pengguna untuk super-admin
        $superAdmin = User::create(
            [
                'token_users' => Str::random(12),
                'nama_lengkap' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => '123',
            ]
        );
        $superAdmin->assignRole('superadmin');
        $adminpusat = User::create(
            [
                'token_users' => Str::random(12),
                'nama_lengkap' => 'Admin Pusat',
                'username' => 'adminpusat',
                'email' => 'adminpusat@gmail.com',
                'password' => '123',
            ]
        );
        $adminpusat->assignRole('adminpusat');
        // $petugasdesa = User::create(
        //     [
        //         'token_users' => Str::random(12),
        //         'nama_lengkap' => 'Petugas Desa',
        //         'username' => 'petugasdesa',
        //         'email' => 'petugasdesa@gmail.com',
        //         'password' => '123',
        //     ]
        // );
        // $petugasdesa->assignRole('petugasdesa');
        // $verifikator = User::create(
        //     [
        //         'token_users' => Str::random(12),
        //         'nama_lengkap' => 'Verifikator',
        //         'username' => 'verifikator',
        //         'email' => 'verifikator@gmail.com',
        //         'password' => '123',
        //     ]
        // );
        // $verifikator->assignRole('verifikator');
        $kadis = User::create(
            [
                'token_users' => Str::random(12),
                'nama_lengkap' => 'Kepala Dinas',
                'username' => 'kadis',
                'email' => 'kadis@gmail.com',
                'password' => '123',
            ]
        );
        $kadis->assignRole('kadis');

    }
}
