<?php include "koneksi.php"; 
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$row = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Buku</h2>
    <form method="post">
        <input type="text" name="judul" value="<?php echo $row['judul']; ?>" required><br><br>
        <input type="text" name="penulis" value="<?php echo $row['penulis']; ?>" required><br><br>
        <textarea name="keterangan" required><?php echo $row['keterangan']; ?></textarea><br><br>
        <button type="submit" name="update">Update</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE buku SET judul='$judul', penulis='$penulis', keterangan='$keterangan' WHERE id='$id'");
    header("Location: index.php");
}
?>
