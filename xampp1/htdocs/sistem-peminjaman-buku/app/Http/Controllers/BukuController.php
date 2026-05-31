<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Pencarian buku berdasarkan judul, kode, atau penulis
        $buku = Buku::when($search, function ($query, $search) {
            return $query->where('judul_buku', 'like', "%{$search}%")
                ->orWhere('kode_buku', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(5) // Pagination 5 data per halaman agar terlihat rapi
        ->withQueryString();

        return view('buku.index', compact('buku', 'search'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul_buku' => 'required',
            'penulis' => 'required',
            'stok' => 'required|integer|min:0',
        ], [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'judul_buku.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok minimal 0.',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $buku->id,
            'judul_buku' => 'required',
            'penulis' => 'required',
            'stok' => 'required|integer|min:0',
        ], [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan oleh buku lain.',
            'judul_buku.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Penulis wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka.',
            'stok.min' => 'Stok minimal 0.',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
