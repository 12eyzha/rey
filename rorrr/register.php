<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "senandung_senja";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Menghash password
    $phone = $_POST['phone'];
    $terms_accepted = isset($_POST['terms']) ? 1 : 0; // Mengecek apakah user setuju dengan syarat dan ketentuan

    // Menyaring data dan menghindari SQL Injection dengan prepared statements
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, phone, terms_accepted) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullname, $email, $password, $phone, $terms_accepted);

    // Menjalankan query
    if ($stmt->execute()) {
        echo "Pendaftaran berhasil! Anda dapat login sekarang.";
        // Redirect atau memberikan pesan sukses
        header("Location: login.php"); // Arahkan ke halaman login setelah berhasil
        exit(); // Untuk memastikan skrip berhenti setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('Resources/register.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0062cc;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Buat Akun</h2>
        <form id="register-form" method="POST" action="">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" name="fullname" id="fullname" placeholder="Nama Lengkap" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <label for="confirm-password">Konfirmasi Password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Konfirmasi Password" required>

            <label for="phone">Nomor Telepon</label>
            <input type="tel" name="phone" id="phone" placeholder="Nomor Telepon (opsional)">

            <label>
                <input type="checkbox" name="terms" required> Saya setuju dengan <a href="#">syarat dan ketentuan</a>.
            </label>

            <button type="submit">Daftar</button>
        </form>
        <div class="register-link">
            Sudah punya akun? <a href="login.php">Masuk di sini</a> 
        </div>
    </div>
</body>
</html>
