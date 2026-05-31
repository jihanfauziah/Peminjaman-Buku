<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        // Gunakan delete() agar kompatibel dengan SQLite dan MySQL
        Buku::query()->delete();

        Buku::create([
            'kode_buku' => 'BK001',
            'judul_buku' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'stok' => 10,
        ]);

        Buku::create([
            'kode_buku' => 'BK002',
            'judul_buku' => 'Bumi',
            'penulis' => 'Tere Liye',
            'stok' => 5,
        ]);

        Buku::create([
            'kode_buku' => 'BK003',
            'judul_buku' => 'Filosofi Teras',
            'penulis' => 'Henry Manampiring',
            'stok' => 8,
        ]);

        Buku::create([
            'kode_buku' => 'BK004',
            'judul_buku' => 'Dilan 1990',
            'penulis' => 'Pidi Baiq',
            'stok' => 3,
        ]);

        Buku::create([
            'kode_buku' => 'BK005',
            'judul_buku' => 'Negeri 5 Menara',
            'penulis' => 'Ahmad Fuadi',
            'stok' => 0, // Sengaja dibuat 0 untuk tes validasi stok habis
        ]);
    }
}
