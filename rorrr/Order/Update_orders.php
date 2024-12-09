<?php
include('koneksi.php'); // Menghubungkan ke koneksi.php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE id = $id";
    $result = $conn->query($sql);
    $order = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_item = $_POST['menu_item'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_price = $quantity * $price;

    // Memperbarui data pesanan
    $sql = "UPDATE orders SET menu_item='$menu_item', quantity='$quantity', price='$price', total_price='$total_price' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan berhasil diperbarui!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<form action="update.php?id=<?php echo $order['id']; ?>" method="POST">
    <input type="text" name="menu_item" value="<?php echo $order['menu_item']; ?>" required>
    <input type="number" name="quantity" value="<?php echo $order['quantity']; ?>" required>
    <input type="number" name="price" value="<?php echo $order['price']; ?>" required>
    <button type="submit">Perbarui Pesanan</button>
</form>
