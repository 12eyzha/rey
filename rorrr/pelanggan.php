<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];

    $query = "INSERT INTO tb_pelanggan (nama_pelanggan, email, no_telepon) 
              VALUES ('$nama', '$email', '$telepon')";

    if ($conn->query($query) === TRUE) {
        echo "Pelanggan berhasil ditambahkan!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    Nama: <input type="text" name="nama"><br>
    Email: <input type="email" name="email"><br>
    Telepon: <input type="text" name="telepon"><br>
    <button type="submit" name="submit">Tambah Pelanggan</button>
</form>
