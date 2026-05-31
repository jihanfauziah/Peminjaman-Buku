# Sistem Peminjaman Buku Sekolah (SIPEMBU)

Project Sistem Peminjaman Buku berbasis **Laravel 11**, **Blade Template**, dan **Bootstrap 5**. Project ini dirancang dengan gaya dashboard POS (Point of Sale) kasir yang modern, bersih, dan responsif menggunakan skema warna Turquoise dan Dark Blue Slate. 

Sistem ini sangat cocok untuk tugas sekolah SMK karena kodenya dirancang sederhana, mudah dipahami pemula, dan bebas dari konfigurasi build asset frontend yang rumit (menggunakan CDN untuk Bootstrap).

---

## 🚀 Panduan Instalasi Cepat

Ikuti langkah-langkah di bawah ini untuk menjalankan project di komputer Anda:

### 1. Ekstrak & Masuk ke Folder Project
Buka terminal (Command Prompt, PowerShell, atau Git Bash) dan pastikan Anda berada di direktori project:
```bash
cd sistem-peminjaman-buku
```

### 2. Install Dependensi PHP (Composer)
Unduh semua library/dependensi yang diperlukan project:
```bash
composer install
```

### 3. Duplikat File Environment
Salin file konfigurasi `.env.example` menjadi `.env`:
* **Di Windows (Command Prompt)**:
  ```cmd
  copy .env.example .env
  ```
* **Di Git Bash / Linux / macOS**:
  ```bash
  cp .env.example .env
  ```

### 4. Buat Application Key
Generate key keamanan untuk enkripsi Laravel:
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database & Seeder Data Dummy
Membuat tabel dan memasukkan data admin serta data dummy buku/anggota ke dalam database (SQLite secara default):
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Lokal
Mulai jalankan server lokal Laravel:
```bash
php artisan serve
```

Buka browser Anda dan akses alamat:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🔑 Akun Login Admin

Gunakan akun di bawah ini untuk login ke halaman admin:
- **Email**: `admin@gmail.com`
- **Password**: `admin123`

---

## ✨ Fitur Utama Project

1. **Login & Logout Admin**: Dilengkapi proteksi Middleware Auth sederhana (mencegah akses langsung ke dashboard tanpa login).
2. **Dashboard Modern**: Tampilan mirip POS kasir dengan card statistik (Total Buku, Total Anggota, Total Peminjaman Aktif) dan daftar 5 aktivitas peminjaman terbaru serta tombol jalan pintas pengembalian buku.
3. **CRUD Buku**: Kelola kode buku, judul, penulis, dan stok. Dilengkapi fitur pencarian (*search*) dan navigasi halaman (*pagination*).
4. **CRUD Anggota**: Kelola nama, kelas, dan nomor HP anggota perpustakaan.
5. **Transaksi Peminjaman**:
   - Pilih anggota dan buku melalui dropdown dinamis (menampilkan sisa stok).
   - Validasi otomatis: jika stok buku `0` (habis), buku tidak bisa dipilih/dipinjam dan memicu pesan error.
   - Stok buku otomatis **berkurang 1** saat berhasil dipinjam.
   - Stok buku otomatis **bertambah 1** saat buku dikembalikan (melalui tombol "Kembalikan" di dashboard atau list transaksi).
6. **Data Dummy (Seeders)**: Sistem langsung memiliki data sampel yang rapi setelah instalasi untuk kebutuhan presentasi.
7. **Notifikasi Cantik**: Alert notifikasi Bootstrap 5 saat proses tambah, edit, hapus, dan pengembalian berhasil atau gagal.

---

## 📁 Struktur Folder Project Penting (Untuk Bahan Presentasi)

Berikut adalah struktur file penting yang telah dibuat dan disesuaikan untuk dipelajari:

* 📂 **`app/Http/Controllers/`** *(Logika Bisnis)*
  * 📄 `AuthController.php` - Mengatur login admin, autentikasi sesi, dan logout.
  * 📄 `DashboardController.php` - Mengambil data statistik dan peminjaman terbaru untuk dashboard.
  * 📄 `BukuController.php` - Logika CRUD & Pencarian data buku.
  * 📄 `AnggotaController.php` - Logika CRUD & Pencarian data anggota.
  * 📄 `PeminjamanController.php` - Logika transaksi pinjam (mengurangi stok) & kembali (menambah stok).
* 📂 **`app/Models/`** *(Struktur & Relasi Tabel)*
  * 📄 `Buku.php` - Definisi tabel buku.
  * 📄 `Anggota.php` - Definisi tabel anggota.
  * 📄 `Peminjaman.php` - Mengatur relasi `belongsTo` ke Anggota dan Buku.
  * 📄 `User.php` - Model bawaan Laravel untuk login Admin.
* 📂 **`database/migrations/`** *(Struktur Database)*
  * 📄 `2026_05_31_000001_create_buku_table.php` - Migrasi tabel buku.
  * 📄 `2026_05_31_000002_create_anggota_table.php` - Migrasi tabel anggota.
  * 📄 `2026_05_31_000003_create_peminjaman_table.php` - Migrasi tabel peminjaman lengkap dengan foreign key.
* 📂 **`database/seeders/`** *(Pengisian Data Dummy)*
  * 📄 `UserSeeder.php` - Pengisi data admin (`admin@gmail.com`).
  * 📄 `BukuSeeder.php` - Pengisi data dummy 5 buku awal.
  * 📄 `AnggotaSeeder.php` - Pengisi data dummy 4 anggota awal.
  * 📄 `DatabaseSeeder.php` - Pusat pemanggilan seeder.
* 📂 **`routes/`** *(Routing URL)*
  * 📄 `web.php` - Kumpulan rute URL dengan middleware `auth` dan `guest` menggunakan `Route::resource()`.
* 📂 **`resources/views/`** *(Tampilan Blade HTML)*
  * 📄 `layouts/app.blade.php` - Layout utama (Sidebar, Navbar, Alert, Jam dinamis, CDN Bootstrap).
  * 📄 `dashboard.blade.php` - Halaman statistik utama.
  * 📂 `auth/login.blade.php` - Form login modern bergradasi.
  * 📂 `buku/` - Tampilan `index.blade.php` (list & search), `create.blade.php` (tambah), `edit.blade.php` (edit).
  * 📂 `anggota/` - Tampilan `index` (list), `create`, `edit`.
  * 📂 `peminjaman/` - Tampilan `index` (list transaksi), `create` (form pinjam).
* 📂 **`public/css/`** *(Tampilan CSS Tambahan)*
  * 📄 `custom.css` - Custom styling untuk POS layout sidebar gelap, turquoise hover shadow, dan card modern.
