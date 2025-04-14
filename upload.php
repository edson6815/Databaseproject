<?php
$conn = new mysqli("localhost", "root", "", "user_image_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);

    
    $imageName = basename($_FILES["profile_image"]["name"]);
    $targetDir = "uploads/";
    $targetFile = $targetDir . time() . "_" . $imageName;

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO users (name, email, image_path) VALUES ('$name', '$email', '".basename($targetFile)."')";
        $conn->query($sql);
    }
}

header("Location: index.php");
exit;
