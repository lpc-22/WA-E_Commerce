<?php 
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 
}else{
    $username = "Visitor"; 
}

?>

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
                      
                    <?php
                        //Only Admin will have this option               
                       if($username == "Admin"){ 
                            echo '<li><a class="dropdown-item" href="admin_Product.php">Manage Products</a></li>';
                       }
                       
                    ?>
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
