<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Operation</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
    <script defer src="script.js"></script> 
</head>
<style>
    /* General Reset */
    body, html {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f4f7;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container Styling */
    .container {
        text-align: center;
        padding: 20px;
        border: 2px solid #32cd32;
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        width: 90%;
    }

    /* Success Message */
    .success {
        color: #32cd32;
        font-size: 1.2rem;
        margin: 10px 0;
    }

    /* Error Message */
    .error {
        color: #ff4d4d;
        font-size: 1.2rem;
        margin: 10px 0;
    }

    /* Button Container */
    .button-container {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    /* Buttons */
    button {
        padding: 10px 20px;
        font-size: 1rem;
        color: white;
        background-color: #32cd32;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #28a428;
    }
</style>
<body>
    <div class="container">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include 'db_connect.php';

            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? null;

            if ($product_id && $quantity) {
                // Check if the product is already in the cart
                $sql_check = "SELECT id, quantity FROM cart WHERE product_id = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("i", $product_id);
                $stmt_check->execute();
                $result = $stmt_check->get_result();

                if ($result->num_rows > 0) {
                    // Update quantity
                    $row = $result->fetch_assoc();
                    $new_quantity = $row['quantity'] + $quantity;

                    $sql_update = "UPDATE cart SET quantity = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ii", $new_quantity, $row['id']);
                    $stmt_update->execute();
                    echo "<p class='success'>Cart updated successfully!</p>";
                } else {
                    // Insert into cart
                    $sql_insert = "INSERT INTO cart (product_id, quantity) VALUES (?, ?)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bind_param("ii", $product_id, $quantity);
                    if ($stmt_insert->execute()) {
                        echo "<p class='success'>Item added to cart successfully!</p>";
                    } else {
                        echo "<p class='error'>Error: " . $conn->error . "</p>";
                    }
                }
                // Close connections
                $stmt_check->close();
                if (isset($stmt_update)) $stmt_update->close();
                if (isset($stmt_insert)) $stmt_insert->close();
            } else {
                echo "<p class='error'>Error: Missing product ID or quantity.</p>";
            }

            $conn->close();
        } else {
            echo "<p class='error'>Invalid request method.</p>";
        }
        ?>
        <div class="button-container">
            <button onclick="window.location.href='load_products.php'">Back to Products</button>
            <button onclick="window.location.href='checkout.php'">Checkout</button>
        </div>
    </div>
</body>
</html>
