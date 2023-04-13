<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email']) || !isset($_SESSION['userID'])) {
    echo "Please log in first";
    exit();
}

include("connection.php") 
$cart = json_decode($_POST['cart'], true);
$userID = $_SESSION['userID'];
$total = $_POST['total'];
$order_date = date("Y-m-d H:i:s");

$sql_order = "INSERT INTO orders (user_id, total, order_date) VALUES (?, ?, ?)";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("ids", $userID, $total, $order_date);
$stmt_order->execute();
$orderID = $conn->insert_id;
$sql_order_items = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt_order_items = $conn->prepare($sql_order_items);

foreach ($cart as $item) {
    $product_id = $item['id'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $stmt_order_items->bind_param("iiid", $orderID, $product_id, $quantity, $price);
    $stmt_order_items->execute();
}

$stmt_order_items->close();
$stmt_order->close();
$conn->close();

header("Location: account.php");
exit();

?>
