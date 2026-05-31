<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Buku Baru</h2>
    <form method="post">
        <input type="text" name="judul" placeholder="Judul Buku" required><br><br>
        <input type="text" name="penulis" placeholder="Penulis" required><br><br>
        <textarea name="keterangan" placeholder="Keterangan" required></textarea><br><br>
        <button type="submit" name="simpan">Simpan</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</div>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO buku (judul, penulis, keterangan) VALUES ('$judul','$penulis','$keterangan')");
    header("Location: index.php");
}
?>
