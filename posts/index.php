<?php
include('../include/db.php');

$result = $conn->query("SELECT * FROM travelling ORDER BY date DESC");
$blogs = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Blog</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&family=Great+Vibes&family=Dancing+Script&family=Pinyon+Script&display=swap">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><b>Travel Blog</b></div>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="index.php">Blogs</a></li>
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
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-post">
                    <h2><?php echo htmlspecialchars($blog['post_title']); ?></h2>
                    <p><?php echo htmlspecialchars($blog['post_description']); ?></p>
                    <a  href="show.php?id=<?php echo $blog['id']; ?>">Read More</a>
                    <small><?php echo date('F j, Y', strtotime($blog['date'])); ?></small>
                    <br>
                    
                    <a style="padding-right:2%;" href="edit.php?id=<?php echo $blog['id']; ?>">Edit</a>
                    <a style="padding:2%;" href="delete.php?id=<?php echo $blog['id']; ?>">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- New Post Form -->
        <div class="new-post-form" id="new-post-form">
            <form action="create.php" method="POST">
                <h2 style="color:white;">New Post</h2>
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
