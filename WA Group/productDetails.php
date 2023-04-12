<?php
// Start the session
session_start();

// Get the product ID from the URL
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// If there's no product ID or it's not a valid integer, redirect to another page or show an error
if ($product_id === null) {
    die("Invalid product ID");
}
// Config the database
require_once "connection.php";

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the product exists
if (mysqli_num_rows($result) === 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($result);

// Declare product name and price
$product_name = $product['name'];
$product_price = $product['price'];
$product_category= $product['category'];
$product_description= $product['description'];
    // Close connection
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style/style.css">
    <title>Online Pet Store - Product Details</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container-lg">
            <!-- Brand -->
            <img src="Img/pet-logo.png" class="logo">
            <a class="navbar-brand" href="index.html">Petify</a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar item -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="product.html" class="nav-link active">Product</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

                    <!-- Nabbar item - Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="account.html">Account</a></li>
                            <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                            <li><a class="dropdown-item" href="setting.html">Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="login.html">Login</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!-- Search bar -->
    <div class="d-flex container-lg justify-content-center my-4">
        <form class="row form-inline justify-content-center" id="product-search-form">
            <div class="col-8">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>



    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
            <img id="product-image" src="Img/<?php echo $product['image']; ?>" alt="Product image" class="img-fluid">
            </div>
            <div class="col-md-6">
            <h2 id="product-name"><?php echo $product_name; ?></h2>
            <p id="product-category"><?php echo $product_category; ?></p>
            <p id="product-price"><?php echo $product_price; ?></p>
            <p id="product-description">Description: <?php echo $product_description; ?></p>

                <div class="d-flex align-items-center">
                    <label for="product-quantity" class="me-2">Quantity:</label>
                    <input type="number" id="product-quantity" class="form-control" min="1" max="99" value="1"
                        style="width: 100px;">
                </div>

                <button id="addToCartBtn" class="btn btn-primary mt-3" product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                <div id="addToCartSuccess" class="addToCartSuccess">ADD TO CART SUCCESS</div>

            </div>
        </div>
    </div>
    <script>
        // Get the "Add to cart" button and add a click event listener
        const addToCartBtn = document.getElementById('addToCartBtn');
        const addToCartSuccess = document.getElementById('addToCartSuccess');
        addToCartBtn.addEventListener('click', addToCart);

        function addToCart() {
            const addToCartBtn = document.getElementById('addToCartBtn');
            const productId = parseInt(addToCartBtn.getAttribute('product-id'));
            const productName = document.getElementById('product-name').textContent;
            const productPrice = parseFloat(document.getElementById('product-price').textContent);
            const productQuantity = parseInt(document.getElementById('product-quantity').value);

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                quantity: productQuantity
            };
            let cart;
            if (localStorage.getItem('cart')) {
                cart = JSON.parse(localStorage.getItem('cart'));
            } else {
                cart = [];
            }

            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity += product.quantity;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            addToCartSuccess.classList.add('show'); // show the success message
              setTimeout(function() {
                addToCartSuccess.classList.remove('show'); // hide the success message after 2 seconds
                 }, 2000);
        }

    </script>
</body>

</html>
