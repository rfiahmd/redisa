<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'superadmin'
        ]);
        Role::create([
            'name' => 'adminpusat'
        ]);
        Role::create([
            'name' => 'petugasdesa'
        ]);
        Role::create([
            'name' => 'verifikator'
        ]);
        Role::create([
            'name' => 'kadis'
        ]);
        
    }
}
