@extends('layouts.app')

@section('title', 'Data Buku')
@section('page_title', 'Kelola Data Buku')

@section('content')
<div class="card card-pos">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <span class="fw-bold">Daftar Koleksi Buku</span>
        <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('buku.index') }}" method="GET" class="d-flex flex-grow-1 w-md-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari kode, judul, atau penulis..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search)
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-danger d-flex align-items-center">Reset</a>
                    @endif
                </div>
            </form>
            <a href="{{ route('buku.create') }}" class="btn btn-primary d-flex align-items-center gap-1 justify-content-center">
                <i class="bi bi-plus-lg"></i> Tambah Buku
            </a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-modern align-middle">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th class="text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($buku as $index => $b)
                    <tr>
                        <td>{{ $buku->firstItem() + $index }}</td>
                        <td><span class="badge bg-secondary font-monospace" style="font-size: 0.85rem; letter-spacing: 0.05em;">{{ $b->kode_buku }}</span></td>
                        <td class="fw-bold text-dark">{{ $b->judul_buku }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td>
                            @if($b->stok > 0)
                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2" style="font-size: 0.85rem; border-radius: 6px;">{{ $b->stok }} Buku</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2" style="font-size: 0.85rem; border-radius: 6px;">Habis</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('buku.destroy', $b->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            Tidak ada data buku ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($buku->hasPages())
        <div class="card-footer bg-white border-top-0 d-flex justify-content-center p-3">
            {{ $buku->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
