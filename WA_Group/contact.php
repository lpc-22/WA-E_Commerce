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
        h1 {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<?php include("navBar.php") ?>

<div class="container-lg mt-5">
    <div class="row gx-5">
        <div class="col-lg-6 my-2">
            <h1>Contact us</h1>
            <p>Welcome to Petitfy! We are a team of animal lovers who are passionate about providing the best caring for your pets. Our store have been servicing pet owners since 2001. Our goal for this pet shopping platform is to provide you with a one-stop-shop for all your pet needs.</p>
            <h1>Address:</h1>
            <p>Room xxx, Block xxx, X/F XXXX XXXX XX</p>
            <p>xx xxxxx xx Street, xxx xxx xxx, Hong Kong</p>
            <h1>Other:</h1>
            <p>Whatsapp/Call: +852 xxxx xxxx</p>
            <p>Email: petify1234@gmail.com</p>
            <h1>Open Hours:</h1>
            <p>Mon-Fri: 10:00 - 20:00</p>
            <p>Sat-Sun: 11:00 - 18:00</p>
        </div>
        <div class="col-lg-6 my-2" style="background-color: rgba(255,255, 255, 0.3);">
        <div class="card container px-2 mx-md-auto my-5">
            <form action="">
            <div class="my-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="my-3">
                <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
                <input class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="my-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="my-3">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100 mb-3">Submit</button>
            </form>
        </div>
        </div>
    <!-- </div> -->
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

</html>