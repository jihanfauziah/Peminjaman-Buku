<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Buku Bacaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>📚 Daftar Buku Bacaan</h2>
    <a href="tambah.php">+ Tambah Buku</a>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $result = mysqli_query($koneksi, "SELECT * FROM buku");
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>
                <td>".$no++."</td>
                <td>".$row['judul']."</td>
                <td>".$row['penulis']."</td>
                <td>".$row['keterangan']."</td>
                <td>
                    <a href='edit.php?id=".$row['id']."'>Edit</a> 
                    <a href='hapus.php?id=".$row['id']."' style='background:red;'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
