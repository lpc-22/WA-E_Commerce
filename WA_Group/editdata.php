<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Include the connection.php file to connect to the database
require_once 'connection.php';

// Get the user information from the database
if (isset($_SESSION['id'])) {
    if ($stmt = $link->prepare('SELECT name, email FROM users WHERE id = ?')) {
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($name, $email);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    echo "Session data not available.";
    exit;
}

// Store the user ID in a variable
$userId = $_SESSION['id'];

// Update the user information in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['username']) && isset($_POST['email'])) {
        $newUsername = $_POST['username'];
        $newEmail = $_POST['email'];
        
        // Use the $userId variable instead of directly using $_SESSION['id']
        if ($stmt = $link->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?')) {
            $stmt->bind_param('ssi', $newUsername, $newEmail, $userId);
            $stmt->execute();
            $stmt->close();
            
            // Update session data
            $_SESSION['name'] = $newUsername;
            header('Location: account.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="Img/favicon-16x16.png">
    <title>Edit account information</title>
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

    <h1>Edit Account Information</h1>
    <form action="editdata.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($name); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
        
        <input type="submit" value="Save Changes">
    </form>
    <a href="account.php">Back to Account</a>
</body>
</html>