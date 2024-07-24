<?php
// Correct path to include the database connection
include(__DIR__ . '/../include/db.php');

// Fetch the post to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Check if the connection is still open
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM travelling WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $post = $result->fetch_assoc();
            $stmt->close();
        } else {
            die("Error preparing statement: " . $conn->error);
        }
    } else {
        die("Connection to the database failed.");
    }
} else {
    die("No post ID provided.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Travel Blog</title>
    <link rel="stylesheet" href="../style.css"> <!-- Adjust path if needed -->
    <style>
        .edit-post {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            padding: 20px;
            background: darkchocolate; /* Dark chocolate background */
            border-radius: 10px;
            box-shadow: 20px 20px 23px 25px rgba(0.3, 0.4, 0.5, 0.9);
            z-index: 100;  
        }
        .edit-post h2 {
            color: white; /* White color for the heading */
        }
        .edit-post form {
            display: flex;
            flex-direction: column;
        }
        .edit-post input, .edit-post textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .edit-post button {
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f8f8f800; /* Green background for buttons */
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .edit-post button:hover {
            background-color: #0056b3; /* Hover effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo"><b>Travel Blog</b></div>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../blogs.php">Blogs</a></li>
                </ul>
            </nav>
        </header>
        <div class="edit-post-form edit-post">
            <form action="update.php" method="POST">
                <h2>Edit Post</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
                <input type="text" name="title" value="<?php echo htmlspecialchars($post['post_title']); ?>" placeholder="Title" required>
                <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($post['post_description']); ?></textarea>
                <textarea name="content" placeholder="Content" required><?php echo htmlspecialchars($post['post_content']); ?></textarea>
                <button type="submit">Update Post</button>
                <button type="button" onclick="closeForm()">Cancel</button>
            </form>
        </div>
    </div>
    
    <script>
        function closeForm() {
            window.location.href = '../blogs.php'; // Redirect to the blogs page or any other page
        }
    </script>
</body>
</html>
