<?php
// Start the session

// Get the product ID from the URL
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// If there's no product ID or it's not a valid integer, redirect to another page or show an error
if ($product_id === null) {
    die("Invalid product ID");
}
// Config the database
require_once "connection.php";

// Fetch product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the product exists
if (mysqli_num_rows($result) === 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($result);

// Declare product name and price
$product_name = $product['name'];
$product_price = $product['price'];
$product_category= $product['category'];
$product_description= $product['description'];
    // Close connection
    mysqli_close($link);
?>

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
    <title>Online Pet Store - Product Details</title>
</head>

<body>
<?php include("navBar.php") ?>






<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img id="product-image" src="Img/<?php echo $product['image']; ?>" alt="Product image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2 id="product-name" class="mb-4"><?php echo $product_name; ?></h2>
            
            <div class="frame mb-3 p-3 border">
                <p><strong>Product Category:</strong></p>
                <p id="product-category"><?php echo $product_category; ?></p>
            </div>

            <div class="frame mb-3 p-3 border">
                <p><strong>Price (HKD$): </strong></p>
                <p id="product-price"><?php echo $product_price; ?></p>
            </div>

            <div class="frame mb-4 p-3 border">
                <p><strong>Product Description:</strong></p>
                <p id="product-description"><?php echo $product_description; ?></p>
            </div>

            <div class="d-flex align-items-center mb-3">
                <p><strong>Quantity:</strong></p>
                <button id="decrement" class="btn btn-outline-secondary ms-3">-</button>
                <input type="number" id="product-quantity" class="form-control mx-2" min="1" max="99" value="1" style="width: 60px; text-align: center;">
                <button id="increment" class="btn btn-outline-secondary">+</button>
            </div>
            
            <button id="addToCartBtn" class="btn btn-outline-dark mt-auto" product-id="<?php echo $product['id']; ?>">Add to Cart</button>
            <div id="addToCartSuccess" class="addToCartSuccess">ADD TO CART SUCCESS</div>
        </div>
    </div>
</div>
<style>
    .frame {
        background-color: #D2C6B8;
        border-radius: 5px;
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

<script>
    document.getElementById('decrement').addEventListener('click', function() {
        let quantity = document.getElementById('product-quantity');
        if (quantity.value > 1) {
            quantity.value -= 1;
        }
    });

    document.getElementById('increment').addEventListener('click', function() {
        let quantity = document.getElementById('product-quantity');
        if (quantity.value < 99) {
            quantity.value = parseInt(quantity.value) + 1;
        }
    });
</script>

    <script>
        const addToCartBtn = document.getElementById('addToCartBtn');
        const addToCartSuccess = document.getElementById('addToCartSuccess');
        addToCartBtn.addEventListener('click', addToCart);

        function addToCart() {
            const addToCartBtn = document.getElementById('addToCartBtn');
            const productId = parseInt(addToCartBtn.getAttribute('product-id'));
            const productName = document.getElementById('product-name').textContent;
            const productPrice = parseFloat(document.getElementById('product-price').textContent);
            const productQuantity = parseInt(document.getElementById('product-quantity').value);

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                quantity: productQuantity
            };
            let cart;
            if (localStorage.getItem('cart')) {
                cart = JSON.parse(localStorage.getItem('cart'));
            } else {
                cart = [];
            }

            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity += product.quantity;
            } else {
                cart.push(product);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            addToCartSuccess.classList.add('show'); // show the success message
              setTimeout(function() {
                addToCartSuccess.classList.remove('show'); // hide the success message after 2 seconds
                 }, 2000);
        }

    </script>
        <?php include("footer.php") ?>
</body>

</html>
