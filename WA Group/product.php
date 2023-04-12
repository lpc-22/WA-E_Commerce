<?php 
// Start the session
session_start();

include("connection.php")?>

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
    <title>Online Pet Store</title>
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
                            <li><a class="dropdown-item" href="#">Account</a></li>
                            <li><a class="dropdown-item" href="#">Cart</a></li>
                            <li><a class="dropdown-item" href="#">Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Login</a></li>
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
            <button type="button" class="mx-2 col-auto btn btn-outline-primary active">All</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary">Cat</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary">Dog</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary">Food</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-primary">Toy</button>
        </div>
    </div>

    <!-- Product listing -->
    <div class="container-lg text-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

            <?php

            $query = "SELECT * FROM products";
            $results = mysqli_query($link, $query);

            while ($row = mysqli_fetch_assoc($results)) {

                echo 
                '
                <div class="col '.$row['category'].'">
                    <div class="card h-100">
                        <img src="Img/' . $row['image'] . '" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">' . $row['name'] . '</h5>
                            <p class="card-text">' . $row['description'] . '</p>
                                <a href="productDetails.php?product_id=1">Details</a>
                        </div>
                    </div>
                </div>
                
                ';

            }

            ?>
            
        </div>
    </div>

</body>

</html>