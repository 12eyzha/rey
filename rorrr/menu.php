<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senandung Senja Menu</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin-right: 20px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        .section-title {
            font-size: 2.5em;
            text-align: center;
            margin: 30px 0;
            color: #333;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            margin: 20px;
            padding: 25px;
            width: 230px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 1.5em;
            margin: 10px 0;
        }

        .card p {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 20px;
        }

        .quantity-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
        }

        .quantity-controls button {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 15px;
            cursor: pointer;
            font-size: 1.5em;
            border-radius: 5px;
            margin: 0 5px;
        }

        .quantity-controls input {
            width: 60px;
            padding: 5px;
            text-align: center;
            font-size: 1.5em;
            border-radius: 5px;
            margin: 0 10px;
        }

        .order-summary {
            margin-top: 40px;
            padding: 25px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-summary h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="section-title">Menu</section>
    <div class="container">
        <!-- Menu Items -->
        <div class="card">
            <img src="espresso.jpg" alt="Espresso">
            <h3>Espresso</h3>
            <p>Rp 15,000</p>
            <div class="quantity-controls">
                <button onclick="updateQuantity(this, -1)">-</button>
                <input type="number" value="1" min="1" max="10">
                <button onclick="updateQuantity(this, 1)">+</button>
            </div>
            <button onclick="addToOrder('Espresso', 15000)">Add to Order</button>
        </div>

        <div class="card">
            <img src="americano.jpg" alt="Americano">
            <h3>Americano</h3>
            <p>Rp 15,000</p>
            <div class="quantity-controls">
                <button onclick="updateQuantity(this, -1)">-</button>
                <input type="number" value="1" min="1" max="10">
                <button onclick="updateQuantity(this, 1)">+</button>
            </div>
            <button onclick="addToOrder('Americano', 15000)">Add to Order</button>
        </div>

        <div class="card">
            <img src="matcha.jpg" alt="Matcha">
            <h3>Matcha</h3>
            <p>Rp 18,000</p>
            <div class="quantity-controls">
                <button onclick="updateQuantity(this, -1)">-</button>
                <input type="number" value="1" min="1" max="10">
                <button onclick="updateQuantity(this, 1)">+</button>
            </div>
            <button onclick="addToOrder('Matcha', 18000)">Add to Order</button>
        </div>
    </div>

    <section class="order-summary">
        <h2>Order Summary</h2>
        <div id="order-summary-list"></div>
        <button onclick="printOrder()">Print Order</button>
    </section>

    <footer>
        <p>&copy; 2024 Senandung Senja | All Rights Reserved</p>
    </footer>

    <script>
        let orders = [];

        function updateQuantity(button, change) {
            const input = button.parentElement.querySelector('input');
            let quantity = parseInt(input.value);
            quantity += change;
            if (quantity > 0) input.value = quantity;
        }

        function addToOrder(name, price) {
            const card = event.target.parentElement;
            const quantity = parseInt(card.querySelector('input').value);
            orders.push({ name, price, quantity });
            updateSummary();
        }

        function updateSummary() {
            const summary = document.getElementById('order-summary-list');
            summary.innerHTML = '';
            let total = 0;

            orders.forEach(order => {
                const itemTotal = order.price * order.quantity;
                total += itemTotal;
                summary.innerHTML += `<p>${order.name} - ${order.quantity} x Rp ${order.price.toLocaleString()} = Rp ${itemTotal.toLocaleString()}</p>`;
            });

            summary.innerHTML += `<p><strong>Total: Rp ${total.toLocaleString()}</strong></p>`;
        }

        function printOrder() {
            const orderContent = document.querySelector('.order-summary').innerHTML;
            const printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Order Summary</title></head><body>');
            printWindow.document.write(orderContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>
</html>
