<?php
include('K\oneksi.php'); // Menghubungkan ke koneksi.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_item = $_POST['menu_item'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_price = $quantity * $price;

    // Menyimpan data pesanan ke database
    $sql = "INSERT INTO orders (menu_item, quantity, price, total_price) 
            VALUES ('$menu_item', '$quantity', '$price', '$total_price')";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>

<form action="order.php" method="POST">
    <input type="text" name="menu_item" placeholder="Nama Menu" required>
    <input type="number" name="quantity" placeholder="Jumlah" required>
    <input type="number" name="price" placeholder="Harga per Item" required>
    <button type="submit">Tambah Pesanan</button>
</form>
