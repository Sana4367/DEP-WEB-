<?php
include 'include/header.php';
include 'include/products.php';

// Retrieve the product ID from the query string
$productID = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

// Find the product in the products array
foreach ($products as $item) {
    if ($item['id'] === $productID) {
        $product = $item;
        break;
    }
}

// If the product is not found, redirect to the products page
if (!$product) {
    header('Location: products.php');
    exit;
}
?>

<section class="single-product">
    <div class="product">
        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <h3><?php echo $product['name']; ?></h3>
        <p>$<?php echo $product['price']; ?></p>
        <p><?php echo $product['description']; ?></p> <!-- Full description -->

        <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
    </div>
</section>

<?php include 'include/footer.php'; ?>
