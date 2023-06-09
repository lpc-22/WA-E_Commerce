<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['email']) || !isset($_SESSION['userID'])) {
    ?>
    <script>
        // alert("Please Log in first");
        window.location.href = 'login.php';
    </script>
    <?php
}

$userID = $_SESSION['userID'];

include("connection.php");

$sql_orders = "SELECT * FROM orders WHERE user_id = ?";
$stmt_orders = $link->prepare($sql_orders);
$stmt_orders->bind_param("i", $userID);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
$orders = $result_orders->fetch_all(MYSQLI_ASSOC);
$stmt_orders->close();

$order_items = [];
foreach ($orders as $order) {
    $orderID = $order['id'];
    $sql_order_items = "SELECT order_items.*, products.name FROM order_items JOIN products ON order_items.product_id = products.id WHERE order_id = ?";
    $stmt_order_items = $link->prepare($sql_order_items);
    $stmt_order_items->bind_param("i", $orderID);
    $stmt_order_items->execute();
    $result_order_items = $stmt_order_items->get_result();
    $order_items[$orderID] = $result_order_items->fetch_all(MYSQLI_ASSOC);
    $stmt_order_items->close();
}

$link->close();

?>



<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<link rel="icon" type="image/png" sizes="16x16" href="Img/favicon-16x16.png">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
    <title>Online Pet Store -Account</title>
    <style>
        th {
            text-align: left;
        }

        td {
            text-align: right;
        }

        #account-container {
            min-height: 80vh;
        }

        .card {
            width: 100%;
        }

        .card-img-top {
            max-width: 200px;
        }

        .card-body {
            width: 75%;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark" data-bs-theme="dark">
    <div class="container-lg">
        <!-- Brand -->
        <img src="Img/pet-logo1.png" class="logo" style="width: 50px;">
        <a class="navbar-brand mx-2 p-0" href="index.php">Petify</a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar item -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="product.php" class="nav-link">Product</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>

                <!-- Nabbar item - Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo isset($_SESSION['username']) ? ($_SESSION['username']) : "Account"; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="account.php">Account</a></li>
                        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                        <li><a class="dropdown-item" href="vieworder.php">View My Order</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if (!isset($_SESSION['username']) || !isset($_SESSION['email'])): ?>
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                    <?php endif; ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

    <div class="container-lg text-center mb-5">
    <h2>Order Details</h2>
</div>

<div class="container-sm">
    <?php foreach ($orders as $order): ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Order ID: <?= $order['id'] ?> | Date: <?= $order['order_date'] ?> | Total: $<?= $order['total'] ?></span>
                <div>
                    <a href="mailto:petify_COMP3421@gmail.com?subject=I%20want%20to%20report%20the%20order%20%23<?= $order['id'] ?>&body=Order%20ID:%20<?= $order['id'] ?>%0A%0APlease%20describe%20your%20issue%20here:" class="btn btn-danger">Report Problem</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_items[$order['id']] as $item): ?>
                            <tr>
                                <td><?= $item['product_id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= $item['price'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endforeach; ?>
</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
		crossorigin="anonymous"></script>
        <script>
    <?php if (isset($_SESSION['order_processed']) && $_SESSION['order_processed']) : ?>
        localStorage.removeItem('cart');
        <?php unset($_SESSION['order_processed']); ?>
    <?php endif; ?>
</script>

</body>
</html>
