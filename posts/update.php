<?php
include(__DIR__ . '/../include/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    if ($conn) {
        $stmt = $conn->prepare("UPDATE travelling SET post_title = ?, post_description = ?, post_content = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $title, $description, $content, $id);
            if ($stmt->execute()) {
                header("Location: ../blogs.php");
                exit();
            } else {
                die("Error executing query: " . $stmt->error);
            }
            $stmt->close();
        } else {
            die("Error preparing statement: " . $conn->error);
        }
    } else {
        die("Connection to the database failed.");
    }
}

$conn->close();
?>
