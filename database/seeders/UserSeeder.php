<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('123'),
            ]
        );
        $superAdmin->assignRole('superadmin');
        $adminpusat = User::create(
            [
                'name' => 'Admin Pusat',
                'email' => 'adminpusat@gmail.com',
                'password' => bcrypt('123'),
            ]
        );
        $adminpusat->assignRole('adminpusat');
        $petugasdesa = User::create(
            [
                'name' => 'Petugas Desa',
                'email' => 'petugasdesa@gmail.com',
                'password' => bcrypt('123'),
            ]
        );
        $petugasdesa->assignRole('petugasdesa');
        $verifikator = User::create(
            [
                'name' => 'Verifikator',
                'email' => 'verifikator@gmail.com',
                'password' => bcrypt('123'),
            ]
        );
        $verifikator->assignRole('verifikator');
        $kadis = User::create(
            [
                'name' => 'Kepala Dinas',
                'email' => 'kadis@gmail.com',
                'password' => bcrypt('123'),
            ]
        );
        $kadis->assignRole('kadis');

    }
}
