<?php
include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit();
?>
