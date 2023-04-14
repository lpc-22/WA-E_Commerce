

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
    <link rel="icon" type="image/png" sizes="16x16" href="Img/favicon-16x16.png">
    <title>Online Pet Store - Cart</title>
    <!--trash icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>

<?php include("navBar.php") ?>


    <!-- Cart -->
    <div class="container-lg my-5">
        <div class="card border border-dark">
            <div class="card-header"><h2>Your Cart</h2></div>
            <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="cart-items"></tbody>
            </table>
            </div>
            <div class="card-footer">
                <h5 class="text-end me-5" id="cart-total">Total: $0</h5>
                <div class="vstack gap-2 col-md-5 mx-auto mt-4">
                    <button id="checkoutBtn" class="btn btn-dark mx-5">Checkout</button>
                    <button id="clearCartBtn" class="btn btn-outline-dark mx-5">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let total = 0;
        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="align-middle">${item.name}</td>
                <td class="align-middle">$${item.price}</td>
                <td class="align-middle">${item.quantity}</td>
                <td class="align-middle">$${(item.price * item.quantity).toFixed(2)}</td>
                <td class="align-middle">
              <button class="btn btn-outline-danger btn-sm remove-item" data-id="${item.id}">
                <i class="bi bi-trash-fill"></i>
                   </button>
                    </td>

            `;

            total += item.price * item.quantity;
            document.querySelector('#cart-items').appendChild(row);
        });
        document.querySelector('#cart-total').textContent = `Total: $${total.toFixed(2)}`;

        function removeItem(itemId) {
  const updatedCart = cart.filter(item => item.id !== itemId);
  localStorage.setItem('cart', JSON.stringify(updatedCart));
  location.reload();
}

function clearCart() {
  localStorage.removeItem('cart');
  location.reload();
}

const clearCartBtn = document.getElementById('clearCartBtn');
clearCartBtn.addEventListener('click', clearCart);
document.querySelectorAll('.remove-item').forEach(btn => {
  btn.addEventListener('click', () => removeItem(parseInt(btn.getAttribute('data-id'))));
});


const checkoutForm = document.getElementById('checkoutBtn');
        checkoutForm.addEventListener('click', (event) => {
            event.preventDefault();
            if (cart.length > 0) {
                window.location.href = "checkout.php";
            } else {
                alert('Your cart is empty. Please add products before proceeding to checkout.');
            }
        });
    </script>

</body>

</html>
