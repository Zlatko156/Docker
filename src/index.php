<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Прост PHP сайт</title>
</head>
<body>
    <h1>Добави потребител</h1>
    <form method="POST" action="add_user.php">
        Име: <input type="text" name="name" required><br>
        Имейл: <input type="email" name="email" required><br>
        <button type="submit">Запази</button>
    </form>

    <h2>Списък на потребители</h2>
    <ul>
        <?php
        $result = $conn->query("SELECT * FROM users ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']} ({$row['email']})</li>";
        }
        ?>
    </ul>
</body>
</html>
