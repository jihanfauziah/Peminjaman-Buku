<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Mengambil data peminjaman beserta relasi anggota dan buku
        $peminjaman = Peminjaman::with(['anggota', 'buku'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('anggota', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judul_buku', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjaman', 'search'));
    }

    public function create()
    {
        $anggota = Anggota::orderBy('nama', 'asc')->get();
        $buku = Buku::orderBy('judul_buku', 'asc')->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
        ], [
            'anggota_id.required' => 'Anggota harus dipilih.',
            'anggota_id.exists' => 'Anggota tidak terdaftar.',
            'buku_id.required' => 'Buku harus dipilih.',
            'buku_id.exists' => 'Buku tidak terdaftar.',
            'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi.',
            'tanggal_pinjam.date' => 'Format tanggal tidak valid.',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        // Validasi stok buku sebelum meminjam
        if ($buku->stok <= 0) {
            return back()->withErrors([
                'buku_id' => 'Stok buku ini sudah habis! Pilih buku lain.',
            ])->withInput();
        }

        // Buat data peminjaman
        Peminjaman::create([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        // Kurangi stok buku secara otomatis
        $buku->decrement('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dipinjam dan stok berkurang.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'kembali') {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Update status dan tanggal kembali
        $peminjaman->update([
            'status' => 'kembali',
            'tanggal_kembali' => now()->toDateString(),
        ]);

        // Kembalikan stok buku
        $peminjaman->buku->increment('stok');

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok bertambah.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Jika data dihapus tapi statusnya masih dipinjam, kembalikan stok buku
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->increment('stok');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
