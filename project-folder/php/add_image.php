<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.8rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-family: verdana;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 1rem;
            color: #444;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 1rem;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            outline: none;
            border-color: #555;
        }

        .button {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #555;
        }

        .message-container {
            text-align: center;
            margin-top: 15px;
            font-size: 1rem;
            padding: 10px;
            border-radius: 5px;
            background-color: #e7ffe7;
            color: #28a745;
            border: 1px solid #28a745;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container a {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 0px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-container a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload another Product</h1>

        <!-- Display any messages -->
        <?php if (isset($message)) { ?>
            <div class="message-container">
                <p><?php echo $message; ?></p>
            </div>
        <?php } ?>

        <!-- Button to show products -->
        <div class="btn-container">
            <a href="load_products.php" class="button">Show Products</a>
           
        </div>

        <!-- Product Upload Form -->
        <form action="add_image.php" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>

            <label for="description">Product Description:</label>
            <textarea name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" name="price" step="0.01" required>

            <label for="image">Product Image:</label>
            <input type="file" name="image" accept="image/*" required>

            <input type="submit" value="Add Product" class="button">
        </form>
        <div class="btn-container">
        <a href="../home.html" class="button">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
