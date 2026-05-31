<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $value) {
            $value->id();
            $value->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
            $value->foreignId('buku_id')->constrained('buku')->onDelete('cascade');
            $value->date('tanggal_pinjam');
            $value->date('tanggal_kembali')->nullable();
            $value->enum('status', ['dipinjam', 'kembali'])->default('dipinjam');
            $value->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
