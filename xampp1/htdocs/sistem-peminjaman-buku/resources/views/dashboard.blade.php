@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Card Total Buku -->
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card card-stat h-100 border-start border-4 border-info">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-muted text-uppercase mb-2 fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">Total Koleksi Buku</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $totalBuku }}</h3>
                </div>
                <div class="bg-info bg-opacity-10 text-info rounded p-3">
                    <i class="bi bi-journal-text fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Anggota -->
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card card-stat h-100 border-start border-4 border-success">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-muted text-uppercase mb-2 fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">Total Anggota Aktif</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $totalAnggota }}</h3>
                </div>
                <div class="bg-success bg-opacity-10 text-success rounded p-3">
                    <i class="bi bi-people fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Peminjaman -->
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card card-stat h-100 border-start border-4" style="border-left-color: var(--primary-color) !important;">
            <div class="card-body d-flex align-items-center justify-content-between p-4">
                <div>
                    <h6 class="text-muted text-uppercase mb-2 fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.05em;">Buku Sedang Dipinjam</h6>
                    <h3 class="mb-0 fw-bold text-dark">{{ $totalDipinjam }} <span class="text-muted fw-normal" style="font-size: 0.9rem;">/ {{ $totalPeminjaman }} total</span></h3>
                </div>
                <div class="bg-opacity-10 rounded p-3" style="background-color: var(--primary-light); color: var(--primary-color);">
                    <i class="bi bi-arrow-left-right fs-2"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Peminjaman Terbaru -->
    <div class="col-12">
        <div class="card card-pos">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Peminjaman Terbaru</span>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-plus-lg"></i> Transaksi Baru
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-modern align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamanTerbaru as $index => $pinjam)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $pinjam->anggota->nama }}</div>
                                    <small class="text-muted">{{ $pinjam->anggota->kelas }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-truncate" style="max-width: 250px;">{{ $pinjam->buku->judul_buku }}</div>
                                    <small class="text-muted">Kode: {{ $pinjam->buku->kode_buku }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->isoFormat('D MMM Y') }}</td>
                                <td>
                                    @if($pinjam->tanggal_kembali)
                                        {{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->isoFormat('D MMM Y') }}
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
                                            <button type="submit" class="btn btn-success btn-sm py-1 px-2 d-inline-flex align-items-center gap-1" onclick="return confirm('Apakah buku ini sudah dikembalikan?')">
                                                <i class="bi bi-check2"></i> Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted" style="font-size: 0.85rem;"><i class="bi bi-check-all text-success fs-5"></i> Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                                    Belum ada transaksi peminjaman terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
