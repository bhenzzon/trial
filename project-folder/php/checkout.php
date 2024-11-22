<?php
include 'db_connect.php';

$sql = "SELECT cart.id as cart_id, products.name, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id";
$result = $conn->query($sql);

$total = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1{
            text-align:center;
            font-family: verdana;
        }
        .container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: gray;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
            padding: 10px 0;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        button {
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: gray;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td>$<?= number_format($row['price'], 2) ?></td>
                            <td><?= htmlspecialchars($row['quantity']) ?></td>
                            <td>
                                $<?= number_format($row['price'] * $row['quantity'], 2) ?>
                            </td>
                            <td>
                                <form method="POST" action="remove_from_cart.php">
                                    <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                                    <button type="submit" style="background-color: #dc3545;">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php $total += $row['price'] * $row['quantity']; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <p class="total">Total: $<?= number_format($total, 2) ?></p>
            <div class="button-container">
                <button onclick="window.location.href='load_products.php'">Back to Products</button>
                <button onclick="alert('Order placed successfully!')">Place Order</button>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
            <button onclick="window.location.href='load_products.php'">Back to Products</button>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>
