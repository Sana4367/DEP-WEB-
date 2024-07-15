<?php
include('../include/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO travelling (post_title, post_description, post_content, date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $title, $description, $content);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
