<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin 1
        User::create([
            'nama' => 'Admin Sekolah',
            'username' => 'admin',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Admin 2
        User::create([
            'nama' => 'Admin Wakil',
            'username' => 'admin2',
            'email' => 'admin2@sekolah.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Siswa 1
        User::create([
            'nama' => 'Budi Santoso',
            'username' => 'budi',
            'email' => 'budi@siswa.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);

        // Siswa 2
        User::create([
            'nama' => 'Siti Nurhaliza',
            'username' => 'siti',
            'email' => 'siti@siswa.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);

        // Siswa 3
        User::create([
            'nama' => 'Ahmad Rahman',
            'username' => 'ahmad',
            'email' => 'ahmad@siswa.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa'
        ]);
    }
}
