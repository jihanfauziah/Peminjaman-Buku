<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        Anggota::query()->delete();

        Anggota::create([
            'nama' => 'Budi Santoso',
            'kelas' => 'XII RPL 1',
            'no_hp' => '081234567890',
        ]);

        Anggota::create([
            'nama' => 'Siti Aminah',
            'kelas' => 'XI TKJ 2',
            'no_hp' => '082345678901',
        ]);

        Anggota::create([
            'nama' => 'Rian Hidayat',
            'kelas' => 'X MM 3',
            'no_hp' => '083456789012',
        ]);

        Anggota::create([
            'nama' => 'Dewi Lestari',
            'kelas' => 'XII RPL 2',
            'no_hp' => '084567890123',
        ]);
    }
}
