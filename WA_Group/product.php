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
    <script src="Script/product.js"></script>
    <title>Petify Online Pet Store</title>
</head>

<body>

    <?php include("navBar.php") ?>

    <!-- Search bar -->
    <div class="d-flex container-lg justify-content-center my-4 ">
        <form class="row form-inline justify-content-center" id="product-search-form">
            <div class="col-8">
                <input id="productSearchingBar" class="form-control border-dark" type="search" placeholder="Search" aria-label="Search" onkeyup="SearchingProduct()">
            </div>
            <div class="col-auto">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>
    </div>

    <!-- Filter list -->
    <div class="container-lg my-4">
        <div class="row">
            <button type="button" class="mx-2 col-auto btn btn-outline-dark active" id="ProductFilter_All">All</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-dark" id="ProductFilter_Food">Food</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-dark" id="ProductFilter_Toy">Toy</button>
            <button type="button" class="mx-2 col-auto btn btn-outline-dark" id="ProductFilter_Accessories">Accessories</button>
        </div>
    </div>

    <!-- Product listing -->
    <div class="container-lg text-center mb-5" style="min-height: 80vh;">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4" id="product_list">

            <?php

            $query = "SELECT * FROM products";
            $results = mysqli_query($link, $query);

            while ($row = mysqli_fetch_assoc($results)) {

                echo 
                '<div class="col '.$row['category'].' products">
                    <div class="card h-100 border-dark">
                        <div class="ratio ratio-1x1">
                            <img src="Img/'. $row['image'] .'" class="card-img-top object-fit-cover" alt="...">
                        </div>
                        <div class="card-body" style="transform: rotate(0);">
                            <h5 class="card-title"><a class="stretched-link" href="productDetails.php?product_id='. $row['id'] .'">' . $row['name'] . '</a></h5>
                            $' . $row['price'] . '
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                                <p class="card-text text-center" style="transform: rotate(0);">
                                    <a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                                </p>
                        </div>
                    </div>
                </div>
                ';
            }

            ?>
        </div>

    </div>

    <?php
$rows_per_page = 8;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $rows_per_page;

$query = "SELECT * FROM products LIMIT $rows_per_page OFFSET $offset";
$results = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($results)) {
}

$total_rows_query = "SELECT COUNT(*) FROM products";
$total_rows_result = mysqli_query($link, $total_rows_query);
$total_rows = mysqli_fetch_array($total_rows_result)[0];
$total_pages = ceil($total_rows / $rows_per_page);

?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

        <?php if ($current_page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" tabindex="-1">Previous</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $current_page): ?>
                <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
            <?php else: ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>

<?php include("footer.php") ?>

</body>

</html>
