<?php
include 'db_connect.php';

$cart_id = $_POST['cart_id'];
$new_quantity = $_POST['quantity'];

$sql = "UPDATE cart SET quantity = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $new_quantity, $cart_id);

if ($stmt->execute()) {
    echo "Cart updated successfully!";
} else {
    echo "Error: " . $conn->error;
}
$stmt->close();
$conn->close();
?>
