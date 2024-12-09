<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id_pemesanan = $_POST['id_pemesanan'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $metode = $_POST['metode'];
    $jumlah = $_POST['jumlah'];

    $query = "INSERT INTO tb_pembayaran (id_pemesanan, tanggal_bayar, metode_bayar, jumlah_bayar) 
              VALUES ($id_pemesanan, '$tanggal_bayar', '$metode', $jumlah)";

    if ($conn->query($query) === TRUE) {
        echo "Pembayaran berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    ID Pemesanan: <input type="number" name="id_pemesanan"><br>
    Tanggal Bayar: <input type="datetime-local" name="tanggal_bayar"><br>
    Metode Bayar: <input type="text" name="metode"><br>
    Jumlah Bayar: <input type="number" name="jumlah"><br>
    <button type="submit" name="submit">Tambah Pembayaran</button>
</form>
