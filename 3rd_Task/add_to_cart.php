<?php
session_start();
include 'include/products.php'; // Include the file where the products array is defined

$product_id = $_POST['product_id'];
$quantity = 1; // You can adjust this or get it from POST if you allow changing quantity on the product page

// Find the product from the array
$product = null;
foreach ($products as $p) {
    if ($p['id'] == $product_id) {
        $product = $p;
        break;
    }
}

if ($product) {
    $cart_item = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $quantity
    ];

    if (isset($_SESSION['cart'])) {
        $is_in_cart = false;

        // Check if product is already in cart
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] += $quantity;
                $is_in_cart = true;
                break;
            }
        }

        if (!$is_in_cart) {
            $_SESSION['cart'][] = $cart_item;
        }
    } else {
        $_SESSION['cart'][] = $cart_item;
    }
    echo '<script>alert("Product has been added to the cart!");</script>';
}

header("Location: cart.php");
?>
