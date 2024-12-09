<?php
include('koneksi.php'); // Menghubungkan ke koneksi.php

// Mengambil data pesanan dari database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data pesanan
    while($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h3>Menu Item: " . $row['menu_item'] . "</h3>";
        echo "<p>Jumlah: " . $row['quantity'] . "</p>";
        echo "<p>Harga per Item: " . $row['price'] . "</p>";
        echo "<p>Total Harga: " . $row['total_price'] . "</p>";
        echo "<p>Tanggal Pesan: " . $row['order_date'] . "</p>";
        echo "<a href='delete.php?id=" . $row['id'] . "'>Hapus</a> | ";
        echo "<a href='update.php?id=" . $row['id'] . "'>Update</a>";
        echo "</div>";
    }
} else {
    echo "Tidak ada pesanan.";
}

$conn->close();
?>
