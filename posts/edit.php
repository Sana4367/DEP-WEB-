<?php
include('../include/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE travelling SET post_title = ?, post_description = ?, post_content = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $content, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM travelling WHERE id = $id");
    $post = $result->fetch_assoc();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['id']); ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['post_title']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($post['post_description']); ?></textarea>
        <textarea name="content" required><?php echo htmlspecialchars($post['post_content']); ?></textarea>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>
