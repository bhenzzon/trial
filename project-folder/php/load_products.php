<?php
include 'db_connect.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: black;
            color: white;
        }
        .header button {
            background-color: white;
            color: gray;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .header button:hover {
            background-color: gray;
            color: white;
        }

        /* Product Grid */
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product {
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            background: #fff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .product h2 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #333;
        }
        .product p {
            font-size: 0.9em;
            color: #555;
        }
        .product button {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .product button:hover {
            background-color: #218838;
        }
        .product input[type='number'] {
            width: 50px;
            padding: 5px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <button onclick="window.location.href='../../index.php'">Back to Home</button>
        <h1>Road Bikes</h1>
    </div>
    <div class="product-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='product'>
                    <img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>
                    <h2>" . $row['name'] . "</h2>
                    <p>" . $row['description'] . "</p>
                    <p><strong>Price:</strong> $" . $row['price'] . "</p>
                    <form method='POST' action='add_to_cart.php'>
                        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                        <label for='quantity'>Qty:</label>
                        <input type='number' name='quantity' value='1' min='1'>
                        <button type='submit'>Add to Cart</button>
                    </form>
                </div>";
            }
        } else {
            echo "<p style='text-align:center; font-size:1.2em; color:#888;'>No products available.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
