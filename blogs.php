<?php
include(__DIR__ . '/include/db.php');

$sql = "SELECT * FROM travelling";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs - Travel Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">Travel Blog</div>
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/blogs.php">Blogs</a></li>
                </ul>
            </nav>
        </header>
        <div class="blogs">
            <h1>All Blog Posts</h1>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="blog-post">';
                    echo '<h2>' . htmlspecialchars($row["post_title"]) . '</h2>';
                    echo '<p>' . htmlspecialchars($row["post_description"]) . '</p>';
                    echo '<a href="posts/show.php?id=' . $row["id"] . '">Read More</a>';
                    echo '<small>' . htmlspecialchars($row["date"]) . '</small>';
                    echo '<br>';
                    echo '<a class="button-padding-right" href="posts/edit.php?id=' . $row["id"] . '">Edit</a>';
                    echo '<a class="button-padding" href="posts/delete.php?id=' . $row["id"] . '">Delete</a>';
                    echo '</div>';
                }
            } else {
                echo "No posts available.";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
