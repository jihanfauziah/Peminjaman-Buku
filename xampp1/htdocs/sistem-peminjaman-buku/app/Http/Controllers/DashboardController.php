<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalPeminjaman = Peminjaman::count();
        $totalDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // 5 Peminjaman terbaru dengan relasi anggota dan buku
        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'totalDipinjam',
            'peminjamanTerbaru'
        ));
    }
}
