<?php
include_once('Tarea.php');
include_once('GestorTareas.php');
session_start();

$gestorTareas = new GestorTareas();
$tarea1 = new Tarea('No fumar');
$tarea2 = new Tarea('Estudiar PHP');

$gestorTareas->anadirTarea($tarea1)->anadirTarea($tarea2);

$_SESSION['gestorTareas'] = $gestorTareas;


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Streaks de Temu</title>
</head>
<body>
    <h1>Streaks de Temu</h1>
    <form action="">
        <label for="date">Fecha:</label>
        <input type="date" id="date" required><br>

        Tareas con checkboxes
        <br><button type="submit">Enviar tareas de hoy</button>
    </form>

    <br><a href="nuevaTarea.php">➕Nueva Tarea</a>

</body>
</html>
