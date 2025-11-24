<?php
session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva tarea</title>
</head>
<body>
    <h1>Nueva tarea</h1>
    <form action="nuevaTarea.php" method="post">
        <label for="nombre">Nombre de la tarea:</label>
        <input type="text" id="nombre" name="nombre" required>

        <button type="submit">Crear tarea</button>
        <div style="color: red"><?= $_SESSION["error"] ?? "" ?></div>
    </form>
    <a href="index.php">🏠Volver a inicio</a>
</body>
</html>
