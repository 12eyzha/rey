<?php
include('koneksi.php'); // Menghubungkan ke koneksi.php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Menghapus data pesanan dari database
    $sql = "DELETE FROM orders WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
