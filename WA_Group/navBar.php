<?php 

echo'

<nav class="navbar navbar-expand-sm bg-dark" data-bs-theme="dark">
<div class="container-lg">
    <!-- Brand -->
    <img src="Img/pet-logo1.png" class="logo" style="width: 50px;">
    <a class="navbar-brand mx-2 p-0" href="index.html">Petify</a>

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
            <li class="nav-item"><a href="product.php" class="nav-link">Product</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link active">About</a></li>
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

';

?>