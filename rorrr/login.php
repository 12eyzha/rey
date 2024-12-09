<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "senandung_senja"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Status variabel untuk menentukan apakah login berhasil atau tidak
$loginStatus = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari pengguna berdasarkan email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Jika pengguna ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['role'] = $user['role']; // Ambil role dari database
            setcookie("role", $user['role'], time() + (86400 * 30), "/");
            setcookie("loggedIn", "true", time() + (86400 * 30), "/");

            // Menentukan halaman tujuan berdasarkan role
            if ($user['role'] == 'admin') {
                $loginStatus = "admin";
            } else {
                $loginStatus = "user";
            }
        } else {
            $loginStatus = "error";
        }
    } else {
        $loginStatus = "error";
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
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            display: flex;
            width: 100%;
            flex: 1;
        }
        .left {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }
        .right {
            width: 50%;
            height: 100vh;
            background: url('Resources/login.jpg') no-repeat center center;
            background-size: cover;
        }
        .login-form {
            text-align: center;
            width: 300px;
        }
        .login-form h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .login-form hr {
            width: 50px;
            border: 2px solid #8B4513;
            margin: 20px auto;
        }
        .login-form label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
            text-align: left;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 16px;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-btn {
            background-color: #8B4513;
            color: #fff;
        }
        .register-btn {
            background-color: #ddd;
            color: #333;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .close-btn {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover {
            color: red;
        }

        /* Cookie Notification Styles */
        .cookie-notification {
            background-color: #8B4513;
            color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            display: none;
        }

        .cookie-notification button {
            background-color: #fff;
            color: #8B4513;
            border: none;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
    <script>
        function handleLoginResult(status) {
            if (status === "admin") {
                localStorage.setItem("role", "admin");
                localStorage.setItem("loggedIn", true);
                showModal('popup-admin');
                setTimeout(function () {
                    window.location.href = 'admin.php'; // Redirect ke halaman admin
                }, 1000); 
            } else if (status === "user") {
                localStorage.setItem("role", "user");
                localStorage.setItem("loggedIn", true);
                showModal('popup-user');
                setTimeout(function () {
                    window.location.href = 'home.php'; // Redirect ke halaman user
                }, 1000); 
            } else if (status === "error") {
                showModal('popup-modal');
            }
        }

        function showModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onload = function() {
            document.querySelectorAll('.close-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const modal = btn.closest('.modal');
                    closeModal(modal.id);
                });
            });

            handleLoginResult("<?php echo $loginStatus; ?>");

            if (document.cookie.indexOf("loggedIn=true") !== -1) {
                showCookieNotification();
            }
        }

        function showCookieNotification() {
            document.querySelector('.cookie-notification').style.display = 'block';
        }

        function hideCookieNotification() {
            document.querySelector('.cookie-notification').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                closeModal(event.target.id);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="login-form">
                <h1>Login</h1>
                <hr>
                <form method="POST" action="login.php">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="senjakopi@yahmail.com" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <button type="submit" class="login-btn">Login</button>
                </form>
                <button class="register-btn" onclick="window.location.href='register.php'">Register Akun</button>
            </div>
        </div>
        <div class="right"></div>
    </div>

    <!-- Modal Popup Gagal Login -->
    <div id="popup-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <p>Email atau password salah!</p>
        </div>
    </div>

    <!-- Modal Popup Login Admin Berhasil -->
    <div id="popup-admin" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <p>Selamat datang, Admin! Anda akan dialihkan ke halaman admin.</p>
        </div>
    </div>

    <!-- Modal Popup Login User Berhasil -->
    <div id="popup-user" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <p>Selamat datang! Anda akan dialihkan ke halaman user.</p>
        </div>
    </div>

    <!-- Cookie Notification -->
    <div class="cookie-notification">
        <p>We use cookies to improve your experience on our website. By continuing to use our site, you consent to our use of cookies. <button onclick="hideCookieNotification()">Got it!</button></p>
    </div>
</body>
</html>
