<?php
$host = 'db';
$user = 'root';
$pass = 'example'; // За XAMPP по подразбиране е празно
$dbname = 'mydb';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Грешка при свързване: " . $conn->connect_error);
}
?>
