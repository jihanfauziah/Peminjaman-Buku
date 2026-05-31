@extends('layouts.app')

@section('title', 'Data Anggota')
@section('page_title', 'Kelola Data Anggota')

@section('content')
<div class="card card-pos">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <span class="fw-bold text-dark">Daftar Anggota Perpustakaan</span>
        <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('anggota.index') }}" method="GET" class="d-flex flex-grow-1 w-md-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, kelas, atau HP..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search)
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline-danger d-flex align-items-center">Reset</a>
                    @endif
                </div>
            </form>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary d-flex align-items-center gap-1 justify-content-center">
                <i class="bi bi-plus-lg"></i> Tambah Anggota
            </a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-modern align-middle">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>No. HP</th>
                    <th class="text-end" style="width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggota as $index => $a)
                    <tr>
                        <td>{{ $anggota->firstItem() + $index }}</td>
                        <td class="fw-bold text-dark">{{ $a->nama }}</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.85rem;">{{ $a->kelas }}</span></td>
                        <td><i class="bi bi-telephone text-muted me-1"></i> {{ $a->no_hp }}</td>
                        <td class="text-end">
                            <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            Tidak ada data anggota ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($anggota->hasPages())
        <div class="card-footer bg-white border-top-0 d-flex justify-content-center p-3">
            {{ $anggota->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
