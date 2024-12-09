<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Senandung Senja</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f2e6;
            color: #333;
        }

        header {
            background-image: url('Resources/image.png');
            background-size: cover;
            color: white;
            padding: 50px 20px;
            text-align: center;
        }

        .container {
            display: flex;
            padding: 20px;
        }

        nav {
            flex: 1;
            background-color: #d9b89c;
            padding: 15px;
            border-radius: 5px;
            margin-right: 20px;
        }

        nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            background-color: #8B4513;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav a:hover {
            background-color: #5c3718;
        }

        main {
            flex: 3;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #8B4513;
        }

        .card {
            background-color: #f4e6d4;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #8B4513;
        }

        .order-list {
            margin-top: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .order-item button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .order-item button:hover {
            background-color: #e60000;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #8B4513;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
    <script>
        window.onload = function() {
            const loggedIn = localStorage.getItem('loggedIn');
            if (!loggedIn || loggedIn === "false") {
                window.location.href = 'login.php';
            }
        };

        function logout() {
            localStorage.removeItem('loggedIn');
            window.location.href = 'login.php';
        }

        // Daftar Menu (Menu yang bisa dipesan)
        const menu = [
            { id: 1, name: 'Espresso', price: 'Rp 15,000' },
            { id: 2, name: 'Americano', price: 'Rp 18,000' },
            { id: 3, name: 'Matcha', price: 'Rp 20,000' },
        ];

        // Daftar Order (Order yang telah dipesan)
        const orders = [
            { id: 1, name: 'Espresso', quantity: 2, total: 'Rp 30,000' },
            { id: 2, name: 'Americano', quantity: 1, total: 'Rp 18,000' }
        ];

        // Menampilkan Menu
        function displayMenu() {
            const menuList = document.getElementById('menu-list');
            menuList.innerHTML = ''; // Menghapus menu sebelumnya
            menu.forEach(item => {
                const menuItem = document.createElement('div');
                menuItem.classList.add('order-item');
                menuItem.innerHTML = `
                    <span>${item.name} - ${item.price}</span>
                    <button onclick="addToOrder(${item.id})">Tambah ke Order</button>
                `;
                menuList.appendChild(menuItem);
            });
        }

        // Menambahkan item ke daftar order
        function addToOrder(itemId) {
            const menuItem = menu.find(item => item.id === itemId);
            if (menuItem) {
                const existingOrder = orders.find(order => order.id === menuItem.id);
                if (existingOrder) {
                    existingOrder.quantity += 1;
                    existingOrder.total = 'Rp ' + (existingOrder.quantity * 15000); // Mengupdate total harga
                } else {
                    orders.push({
                        id: menuItem.id,
                        name: menuItem.name,
                        quantity: 1,
                        total: menuItem.price
                    });
                }
                displayOrders(); // Memperbarui daftar order
            }
        }

        // Menampilkan daftar order yang sudah dipesan
        function displayOrders() {
            const orderListElement = document.getElementById('order-list');
            orderListElement.innerHTML = ''; // Menghapus daftar order sebelumnya
            orders.forEach(order => {
                const orderItem = document.createElement('div');
                orderItem.classList.add('order-item');
                orderItem.innerHTML = `
                    <span>${order.name} - ${order.quantity}x - ${order.total}</span>
                    <button onclick="deleteOrder(${order.id})">Hapus</button>
                `;
                orderListElement.appendChild(orderItem);
            });
        }

        // Menghapus order dari daftar
        function deleteOrder(orderId) {
            const orderIndex = orders.findIndex(order => order.id === orderId);
            if (orderIndex !== -1) {
                orders.splice(orderIndex, 1); // Menghapus order dari array
                displayOrders(); // Menampilkan daftar order terbaru
            }
        }

        // Inisialisasi tampilan saat halaman dimuat
        window.onload = function() {
            displayMenu();
            displayOrders();
        }
    </script>
</head>
<body>
    <header>
        <h1>Admin Page - Senandung Senja</h1>
    </header>
    <div class="container">
        <nav>
            <a href="#">Dashboard</a>
            <a href="kelola_order.php">Kelola Order</a> <!-- Link ke halaman Kelola Order -->
            <a href="#">Kelola Menu</a>
            <a href="#">Laporan Penjualan</a>
            <a href="#">Pengaturan</a>
            <a href="#" onclick="logout()">Keluar</a>
        </nav>
        <main>
            <div class="card">
                <h2>Kelola Order</h2>
                <div id="order-list" class="order-list">
                    <!-- Daftar order akan muncul di sini -->
                </div>
            </div>
            <div class="card">
                <h2>Menu</h2>
                <div id="menu-list" class="order-list">
                    <!-- Daftar menu akan muncul di sini -->
                </div>
            </div>
        </main>
    </div>
    <footer>
        &copy; 2024 Senandung Senja. Semua hak dilindungi.
    </footer>
</body>
</html>
