<?php
// Start the session
session_start();
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
    <title>Online Pet Store - Cart</title>
    <!--trash ico弓 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>

<nav class="navbar navbar-expand-sm bg-body-tertiary">
        <div class="container-lg">
            <!-- Brand -->
            <a class="navbar-brand" href="index.html">Band</a>

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
                    <li class="nav-item"><a href="product.php" class="nav-link active">Product</a></li>
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
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Cart items will be added here dynamically using JavaScript -->
            </tbody>
        </table>

        <h5 class="text-end" id="cart-total">Total: $0</h5>
        <button id="clearCartBtn" class="btn btn-danger">Clear Cart</button>

    </div>

    <script>
        // Get cart data from localStorage
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Display cart items and calculate the total
        let total = 0;
        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>${item.quantity}</td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                <td>
              <button class="btn btn-danger btn-sm remove-item" data-id="${item.id}">
                <i class="bi bi-trash-fill"></i>
                   </button>
                    </td>

            `;

            total += item.price * item.quantity;
            document.querySelector('#cart-items').appendChild(row);
        });

        // Update cart total
        document.querySelector('#cart-total').textContent = `Total: $${total.toFixed(2)}`;

        function removeItem(itemId) {
  const updatedCart = cart.filter(item => item.id !== itemId);
  localStorage.setItem('cart', JSON.stringify(updatedCart));
  location.reload();
}

function clearCart() {
  localStorage.removeItem('cart');
  location.reload();
}

// Add a click event listener to the "Clear cart" button
const clearCartBtn = document.getElementById('clearCartBtn');
clearCartBtn.addEventListener('click', clearCart);

// Add click event listeners to the "Remove item" buttons
document.querySelectorAll('.remove-item').forEach(btn => {
  btn.addEventListener('click', () => removeItem(parseInt(btn.getAttribute('data-id'))));
});

    </script>

</body>

</html>
