<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="Img/favicon-16x16.png">
    <title>Online Pet Store</title>
    <style>
        p {
            text-indent: 50px;
        }
</style>
</head>

<body style="min-height: 100vh;">
    <?php include("navBar.php") ?>

    <div class="container-lg my-5 mx-auto" style="min-height: 70vh;">
        <div class="card my-5 mx-auto shadow-lg" style="max-width: 80vw;">
            <div class="row g-0">
                <div class="col-lg-5">
                    <img src="Img/about-img-1.webp" class="img-fluid rounded w-100" alt="...">
                </div>
                <div class="col-lg-7">
                    <div class="card-body">
                        <h2 class="card-title">About Us</h5>
                        <p class="card-text">Welcome to Petitfy! We are a team of animal lovers who are passionate about providing the best caring for your pets. Our store have been servicing pet owners since 2001. Our goal for this pet shopping platform is to provide you with a one-stop-shop for all your pet needs.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-5 mx-auto shadow-lg" style="max-width: 80vw;">
            <div class="row g-0">
                <div class="col-lg-5">
                    <img src="Img/about-img-2.jpeg" class="img-fluid rounded w-100" alt="...">
                </div>
                <div class="col-lg-7">
                    <div class="card-body">
                        <h2 class="card-title">Our Services</h5>
                        <p class="card-text">In Petitfy, our mission is to provide high-quality product that help you take care of your pet. Our team is dedicated to helping you find the right product for your pet's needs and answering any questions you may have. We offer a range of product to help you take care of your pats. For the products, we provide:</p>
                        <ul>
                            <li>High-quality pet food</li>
                            <li>Health treats</li>
                            <li>Safe and funny pet toys</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php") ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

</html>