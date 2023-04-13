<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
	?>
	<script>
		alert("Please Log in first");
		window.location.href = 'login.html';
	</script>
	<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</head>

<body>

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
        <title>checkout</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-body-tertiary">
            <div class="container-lg">
                <!-- Brand -->
                <img src="Img/pet-logo.png" class="logo">
                <a class="navbar-brand" href="index.html">Petify</a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
        <div class="container my-5">
            <h2>Checkout</h2>
            <h5 class="mt-4">Cart Details</h5>
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
                </tbody>
            </table>
    
            <h5 class="text-end" id="cart-total">Total: $0</h5>
            <form id="checkoutForm" action="updateorder.php" method="post">
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" required>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone-number" oninput="this.value=this.value.replace(/[^\d]/,'')"required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="credit-card" class="form-label">Credit Card Number</label>
                    <div class="row">
                      <div class="col-md-1 mb-1 position-relative">
                        <input type="text" class="form-control" id="credit-card-1" maxlength="4" placeholder="1234"required>
                        <span class="position-absolute top-50 start-100 translate-middle-y">-</span>
                      </div>
                      <div class="col-md-1 mb-1 position-relative">
                        <input type="text" class="form-control" id="credit-card-2" maxlength="4" placeholder="1234"required>
                        <span class="position-absolute top-50 start-100 translate-middle-y">-</span>
                      </div>
                      <div class="col-md-1 mb-1 position-relative">
                        <input type="text" class="form-control" id="credit-card-3" maxlength="4" placeholder="1234"required>
                        <span class="position-absolute top-50 start-100 translate-middle-y">-</span>
                      </div>
                      <div class="col-md-1 mb-1">
                        <input type="text" class="form-control" id="credit-card-4" maxlength="4" placeholder="1234"required>
                      </div>
                      <div class="col-md-1 mb-1 ">
                        <input type="text" class="form-control" id="credit-card-5" maxlength="3" placeholder="CSC"required>
                        <input type="hidden" name="cart" id="cart-data">
                      </div>
                    </div>
                  </div>
                <button id="confirmBtn" class="btn btn-primary" type="submit">Confirm Order</button>
            </form>
        </div>

        <script>
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            let total = 0;
            cart.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>$${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>$${(item.price * item.quantity).toFixed(2)}</td>
                `;
    
                total += item.price * item.quantity;
                document.querySelector('#cart-items').appendChild(row);
            });
    
            document.querySelector('#cart-total').textContent = `Total: $${total.toFixed(2)}`;
            document.getElementById('cart-data').value = JSON.stringify(cart);
            const checkoutForm = document.getElementById('checkoutForm');
            checkoutForm.addEventListener('submit', (event) => {
            event.preventDefault();
            localStorage.removeItem('cart');
            alert('Order confirmed! Return to home page now!');
            window.location.href = "index.html";
        });
    </script>
        </script>
    </body>

</html>