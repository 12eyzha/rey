<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO tb_produk (nama_produk, kategori, harga, stok, deskripsi) 
              VALUES ('$nama_produk', '$kategori', $harga, $stok, '$deskripsi')";

    if ($conn->query($query) === TRUE) {
        echo "Produk berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    Nama Produk: <input type="text" name="nama_produk"><br>
    Kategori: <input type="text" name="kategori"><br>
    Harga: <input type="number" name="harga"><br>
    Stok: <input type="number" name="stok"><br>
    Deskripsi: <textarea name="deskripsi"></textarea><br>
    <button type="submit" name="submit">Tambah Produk</button>
</form>
