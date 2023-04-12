<?php include("connection.php") ?>
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
    <script src="/Script/product.js"></script>
    <title>Petify Online Pet Store</title>
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

    <!-- Filter list -->
    <div class="container-lg my-4">
        <div class="row">
            <button type="button" class="mx-2 col-auto btn btn-outline-primary active" id="ProductFilter_All">All</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary" id="ProductFilter_Food">Food</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary" id="ProductFilter_Toy">Toy</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary" id="ProductFilter_Accessories">Accessories</button>
        </div>
    </div>

    <!-- Product listing -->
    <div class="container-lg text-center mb-5">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="product_list">

            <?php

            $query = "SELECT * FROM products";
            $results = mysqli_query($link, $query);

            while ($row = mysqli_fetch_assoc($results)) {

                echo 
                '<div class="col '.$row['category'].' products">
                    <div class="card h-100">
                        <div class="ratio ratio-1x1">
                            <img src="Img/'. $row['image'] .'" class="card-img-top object-fit-cover" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a class="stretched-link" href="productDetails.php?product_id='. $row['id'] .'">' . $row['name'] . '</a></h5>
                            $' . $row['price'] . '
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                        </div>
                    </div>
                </div>
                ';
            }

            ?>
        </div>

    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6>About</h6>
          <p class="text-justify">Welcome to Petify, your one-stop online shop for all your pet needs! We are a team of passionate animal lovers who believe that pets are an important part of our lives and deserve the best care and attention.</p>
        </div>
        <div class="col-xs-6 col-md-3">
          <h6>Quick Links</h6>
          <ul class="footer-links">
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
          </ul>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by COMP3421
          </p>
        </div>
      </div>
    </div>
</footer>
</body>

</html>