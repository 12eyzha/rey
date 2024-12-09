<!DOCTYPE html>
<html lang="id">
<head>
  <style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #fff;
    border-bottom: 1px solid #ddd;
}
.header img {
    height: 50px;
}
.nav {
    display: flex;
    gap: 20px;
}
.nav a {
    text-decoration: none;
    color: #000;
    font-weight: bold;
}
.login-button {
    background-color: #000;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.hero {
    position: relative;
    text-align: center;
    color: white;
}
.hero img {
    width: 100%;
    height: auto;
}
.hero-text {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px;
}
.hero-text p {
    margin: 0;
}
.section-title {
    background-color: #d2b48c;
    text-align: center;
    padding: 10px 0;
    font-weight: bold;
}
.content {
    display: flex;
    justify-content: center;
    padding: 20px;
}
.content img {
    max-width: 100%;
    height: auto;
}
.content-text {
    max-width: 600px;
    margin-left: 20px;
}
.content-text h2 {
    margin-top: 0;
}
.footer {
    background-color: #d2b48c;
    text-align: center;
    padding: 10px 0;
    font-weight: bold;
}
.about {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    align-items: center;
}
.about img {
    height: 100px;
}
.about-text {
    max-width: 600px;
}
.about-text p {
    margin: 0;
}
.contact {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 20px 0;
}
.contact a {
    color: #000;
    font-size: 24px;
}
.footer-text {
    text-align: center;
    padding: 10px 0;
    background-color: #000;
    color: #fff;
}

  </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senandung Senja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="styles.css" rel="stylesheet"/>
    <script>
        function logout() {
            // Logika logout (misalnya, menghapus token atau mengalihkan pengguna)
            alert("Anda telah keluar.");
            window.location.href = 'login.php'; // Arahkan kembali ke halaman login
        }
    </script>
</head>
<body>
    <div class="header">
        <img src="Resources/logo-no-background.png" alt="Logo Senandung Senja" height="50" width="50"/>
        <div class="nav">
            <a href="#">Home</a>
            <a href="#">Menu</a>
            <a href="#">About</a>
            <a href="#">Career</a>
            <a href="#">Feedback</a>
            <a href="login.php">
                <button class="login-button">Login</button>
            </a>
            <button class="logout-button" onclick="logout()">Logout</button> <!-- Tombol Logout -->
        </div>
    </div>
    <div class="hero">
        <img src="Resources/BODYCOFerez.jpg" alt="Hero Image" height="1200" width="800"/>
    </div>
    <div class="section-title">RUKO KAMI</div>
    <div class="content">
        <img src="Resources/senja.jpg" alt="Senja Image" height="300" width="400"/>
        <div class="content-text">
            <h2>Concept</h2>
            <p>
                Selamat datang di dunia Senandung Senja, di mana kehangatan kopi bertemu dengan ikoniknya VW Combi. Kami memilih Combi sebagai simbol perjalanan, kebersamaan, dan kenangan manis. Dengan desain retro yang menawan, VW Combi kami tidak hanya sekadar tempat menjual kopi, tetapi juga tempat di mana cerita dan momen tak terlupakan tercipta.
            </p>
        </div>
    </div>
    <div class="footer">About Us</div>
    <div class="about">
        <img src="Resources/logo-color.png" alt="Logo Color" height="100" width="100"/>
        <div class="about-text">
            <p>Senandung Senja Noodles & Coffee</p>
            <p>Jl. A. H. Nasution, Kota Padang</p>
        </div>
        <img alt="Map location of Senandung Senja" height="100" src="https://storage.googleapis.com/a1aa/image/gxeOmhS0CLVtIaVoiW7mukmdBmjC1fGRsxJuasnV8cFpOFnTA.jpg" width="100"/>
    </div>
    <div class="contact">
        <a href="#"><i class="fab fa-whatsapp"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
    </div>
    <div class="footer-text">© 2023 Senandung Senja | All Rights Reserved</div>
</body>
</html>
