<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
	?>
	<script>
		// alert("Please Log in first");
		window.location.href = 'login.php';
	</script>
	<?php
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

if (isset($_POST['sign-out'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

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

	
    <div class="container-sm text-center d-flex align-content-center" id="account-container">
        <div class="card mx-auto my-5 border-dark border">
            <div class="card-header">
                <h2>Account Information</h2>
            </div>

            <img src="Img/OIP.jpeg" class="card-img-top mx-auto mt-5 rounded-circle" alt="...">

            <div class="card-body mx-auto">
                <!-- Table -->
                <table class="table mt-3">
                    <tbody>
                        <tr>
                            <th>User Name: </th>
                            <td><?php echo htmlspecialchars($username); ?></td>
                        </tr>
                        <tr>
                            <th>Email Address: </th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
			
			<form method="post">
				<button type="submit" name="sign-out" class="btn btn-danger">Sign Out</button>
			</form>
			
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

            </div>
        </div>

    </div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
		crossorigin="anonymous"></script>

</body>
</html>