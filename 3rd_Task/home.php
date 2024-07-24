<?php
include 'include/header.php';
include 'include/products.php'; // Include the products array

// Shuffle the products array and take the first 3 products
shuffle($products);
$featuredProducts = array_slice($products, 0, 3);
?>

<section class="intro">
    <h1>Welcome to Our Stylish World</h1>
</section>

<section class="featured-section">
    <h2>Featured Products</h2>
    <div class="products">
        <?php foreach ($featuredProducts as $product) { ?>
            <div class="product">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>$<?php echo $product['price']; ?></p>
                
                <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                <a href="single_product.php?id=<?php echo $product['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</section>
<section class="featured-section">
    <h2>Sales Products</h2>
    <div class="products">
        <?php foreach ($salesProducts as $product) { ?>
            <div class="product">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p><del>$<?php echo number_format($product['old_price'], 2); ?></del> $<?php echo number_format($product['price'], 2); ?></p>
                <p><?php echo substr($product['description'], 0, 50); ?>...</p> <!-- Shortened description -->

                <button onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                <a href="single_product.php?id=<?php echo $product['id']; ?>">View Details</a>
            </div>
        <?php } ?>
    </div>
</section>

<?php include 'include/footer.php'; ?>
