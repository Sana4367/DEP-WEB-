<?php
include 'include/header.php';
include 'include/products.php'; // Include the products array
?>

<section class="intro">
    <h1>All Products</h1>
</section>

<section class="featured-section">
    <h2>Our Products</h2>
    <div class="products">
        <?php foreach ($products as $product) { ?>
            <div class="product">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>$<?php echo $product['price']; ?></p>
                <p><?php echo substr($product['description'], 0, 50); ?>...</p> <!-- Shortened description -->

                <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                <a href="single_product.php?id=<?php echo $product['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</section>

<?php include 'include/footer.php'; ?>
