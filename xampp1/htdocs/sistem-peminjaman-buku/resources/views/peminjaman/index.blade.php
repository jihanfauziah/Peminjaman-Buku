@extends('layouts.app')

@section('title', 'Peminjaman Buku')
@section('page_title', 'Transaksi Peminjaman')

@section('content')
<div class="card card-pos">
    <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <span class="fw-bold text-dark">Data Transaksi Peminjaman Buku</span>
        <div class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto">
            <!-- Form Pencarian -->
            <form action="{{ route('peminjaman.index') }}" method="GET" class="d-flex flex-grow-1 w-md-auto">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama anggota atau buku..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search)
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-danger d-flex align-items-center">Reset</a>
                    @endif
                </div>
            </form>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary d-flex align-items-center gap-1 justify-content-center">
                <i class="bi bi-plus-lg"></i> Tambah Transaksi
            </a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-modern align-middle">
            <thead>
                <tr>
                    <th style="width: 70px;">No</th>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $index => $pinjam)
                    <tr>
                        <td>{{ $peminjaman->firstItem() + $index }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $pinjam->anggota->nama }}</div>
                            <small class="text-muted">Kelas: {{ $pinjam->anggota->kelas }}</small>
                        </td>
                        <td>
                            <div class="fw-bold text-dark text-truncate" style="max-width: 220px;">{{ $pinjam->buku->judul_buku }}</div>
                            <small class="text-muted">Kode: {{ $pinjam->buku->kode_buku }}</small>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            @if($pinjam->tanggal_kembali)
                                {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->isoFormat('D MMMM Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($pinjam->status === 'dipinjam')
                                <span class="badge bg-warning text-dark badge-status">Dipinjam</span>
                            @else
                                <span class="badge bg-success badge-status">Kembali</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($pinjam->status === 'dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $pinjam->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm me-1" onclick="return confirm('Apakah buku ini sudah dikembalikan?')">
                                        <i class="bi bi-check2"></i> Kembalikan
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data transaksi ini? (Stok buku akan disesuaikan otomatis jika status masih dipinjam)')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            Tidak ada data transaksi peminjaman ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($peminjaman->hasPages())
        <div class="card-footer bg-white border-top-0 d-flex justify-content-center p-3">
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
