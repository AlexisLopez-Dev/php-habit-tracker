<?php
session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eliminar tarea</title>
</head>
<body>
    <h1>Eliminar tarea</h1>
    <form action="../controladores/eliminarTarea.php" method="post">
        <label for="id">ID de la tarea a eliminar:</label>
        <input type="number" id="id" name="id" min="1" required>

        <button type="submit">Eliminar tarea</button>
        <div style="color: red"><?= $_SESSION["error"] ?? "" ?></div>
    </form>
    <a href="../index.php">🏠Volver a inicio</a>
</body>
</html>
