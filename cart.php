<?php
session_start();
include '../3RD_TASK/include/db.php';

// Handle delete item
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Handle submit order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    $total_price = array_reduce($_SESSION['cart'], function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Insert into orders table
    $sql = "INSERT INTO orders (total_price) VALUES ($total_price)";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Insert into order_items table
        foreach ($_SESSION['cart'] as $item) {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, {$item['id']}, {$item['quantity']}, {$item['price']})";
            $conn->query($sql);
        }

        // Clear the cart
        unset($_SESSION['cart']);
        header("Location: thank_you.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Shopping Cart</title>
    <style>
.main {
    padding: 10px;
    color: white; /* White font color */
    margin-bottom:16%;

}

h1 {
    font-size: 2em;
    margin-top: 90px;

    margin-bottom: 20px;
    text-align:center;
    color:white;
}

/* Table Styles */
table {
    width: 100%;
    margin: 0 auto;
    border-collapse: collapse;
}

thead {
    background-color: #444;
}

th, td {
    padding: 15px;
    border: 1px solid #555;
    color:white;
}

th {
    background-color: #555;
    color: white;
    font-weight: bold;
}

tbody tr:nth-child(even) {
    background-color: #444;
}

tbody tr:nth-child(odd) {
    background-color: #333;
}

td {
    color: white;
}

a {
    color: #5cb85c; /* Green color for links */
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Button Styles */
button {
    padding: 10px 20px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    background-color: #5cb85c;
    color: white;
    cursor: pointer;
    margin-top: 20px;

}

button:hover {
    background-color: #4cae4c;
}
</style>
</head>
<body>
<div class="main">
    <?php include 'include/header.php'; ?>
    <h1>Shopping Cart</h1>
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['price'] * $item['quantity'];
                    ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td><a href="cart.php?delete=<?php echo $item['id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <form method="POST" action="">
            <button type="submit" name="submit_order">Submit Order</button>
        </form>
    <?php } else { ?>
        <p style="color:white; text-align:center; ">Your cart is empty.</p>
    <?php } ?>

    </div>
    <?php include 'include/footer.php'; ?>
</body>
</html>
