<?php
include('../include/db.php');

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM travelling WHERE id = $id");

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

$post = $result->fetch_assoc();

if (!$post) {
    die("Post not found.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['post_title']); ?></title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.974), rgba(0, 0, 0, 0.974)), url('../css/person.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        .post-content {
            margin: 20px;
        }
        .post-content h1,
        .post-content p,
        .post-content small,
        .post-content a {
            color: white;
        }
    </style>
</head>
<body>
    <div class="post-content">
        <h1><?php echo htmlspecialchars($post['post_title']); ?></h1>
        <p><?php echo htmlspecialchars($post['post_content']); ?></p>
        <small><?php echo date('F j, Y', strtotime($post['date'])); ?></small>
        <br>
        <a class="button-padding-right" href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
    <a class="button-padding" href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
    <a class="button-padding" href="index.php">Back</a>
    </div>
</body>
</html>
