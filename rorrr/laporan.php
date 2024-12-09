<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $periode = $_POST['periode'];
    $pendapatan = $_POST['pendapatan'];
    $pesanan = $_POST['pesanan'];

    $query = "INSERT INTO tb_laporan (periode, total_pendapatan, total_pesanan) 
              VALUES ('$periode', $pendapatan, $pesanan)";

    if ($conn->query($query) === TRUE) {
        echo "Laporan berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    Periode: <input type="text" name="periode"><br>
    Total Pendapatan: <input type="number" name="pendapatan"><br>
    Total Pesanan: <input type="number" name="pesanan"><br>
    <button type="submit" name="submit">Tambah Laporan</button>
</form>
