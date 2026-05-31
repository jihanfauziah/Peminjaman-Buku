@extends('layouts.app')

@section('title', 'Tambah Peminjaman')
@section('page_title', 'Tambah Peminjaman Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card card-pos">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold text-dark">Form Transaksi Peminjaman</span>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <!-- Pilih Anggota -->
                    <div class="mb-3">
                        <label for="anggota_id" class="form-label fw-semibold">Pilih Anggota</label>
                        <select class="form-select @error('anggota_id') is-invalid @enderror" id="anggota_id" name="anggota_id" required>
                            <option value="" disabled selected>-- Pilih Anggota --</option>
                            @foreach($anggota as $a)
                                <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama }} ({{ $a->kelas }})
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Buku -->
                    <div class="mb-3">
                        <label for="buku_id" class="form-label fw-semibold">Pilih Buku</label>
                        <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id" required>
                            <option value="" disabled selected>-- Pilih Buku --</option>
                            @foreach($buku as $b)
                                <option value="{{ $b->id }}" {{ old('buku_id') == $b->id ? 'selected' : '' }} {{ $b->stok <= 0 ? 'disabled' : '' }}>
                                    {{ $b->judul_buku }} - {{ $b->penulis }} (Stok: {{ $b->stok }})
                                    @if($b->stok <= 0)
                                        -- [STOK HABIS]
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pinjam -->
                    <div class="mb-4">
                        <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                        <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                        @error('tanggal_pinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="bi bi-cart-plus"></i> Buat Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
