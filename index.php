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
    <title>Travel Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="container">
    <header>
            <div class="logo"><b>Travel Blog</b></div>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../2nd task/blogs.php">Blogs</a></li>
                </ul>
            </nav>
        </header>
        <div class="intro">
            <h1>Welcome to the Travel Blog</h1>
            <button class="new-post-button">Add New Post</button>
            <a href="#blogs" class="read-more">Read Blog Posts</a>
        </div>
        <div class="blogs" id="blogs">
            <h1>All Posts</h1>
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

        <!-- New Post Form -->
        <div class="new-post-form" id="new-post-form">
            <form action="posts/create.php" method="POST">
                <h2>New Post</h2>
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <textarea name="content" placeholder="Content" required></textarea>
                <button type="submit">Create Post</button>
                <button type="button" onclick="closeForm()">Cancel</button>
            </form>
        </div>
    </div>
    
    <script>
        document.querySelector('.new-post-button').addEventListener('click', function() {
            document.getElementById('new-post-form').style.display = 'block';
        });

        function closeForm() {
            document.getElementById('new-post-form').style.display = 'none';
        }
    </script>
</body>
</html>
