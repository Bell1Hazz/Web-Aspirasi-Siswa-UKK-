<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Ruang Kelas'],
            ['nama_kategori' => 'Perpustakaan'],
            ['nama_kategori' => 'Laboratorium'],
            ['nama_kategori' => 'Kantor'],
            ['nama_kategori' => 'Toilet/Kamar Mandi'],
            ['nama_kategori' => 'Lapangan Olahraga'],
            ['nama_kategori' => 'Kantin'],
            ['nama_kategori' => 'Tempat Parkir'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
