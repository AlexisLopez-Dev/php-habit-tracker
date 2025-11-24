<?php
include_once('Tarea.php');
include_once('GestorTareas.php');
session_start();

if (!isset($_SESSION['gestorTareas'])){
    $gestorTareas = new GestorTareas();
    $_SESSION['gestorTareas'] = $gestorTareas;
}

$gestorTareas = $_SESSION['gestorTareas'];
$_SESSION["error"] = "";

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
    <form action="anadeFechaEnTareas.php" method="post">
        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" required><br>

        <?php
        $arrayTareas = $gestorTareas->getTareas();
        foreach ($arrayTareas as $tarea){
            echo ("<label for='tarea".$tarea->getId()."'>" . $tarea->getId() . " - " . $tarea->getNombre()."</label>
                   <input type='checkbox' 
                          name='tareasSeleccionadas[]' 
                          value='".$tarea->getId()."'
                          id='tarea".$tarea->getId()."'><br>");
        }
        ?>

        <br><button type="submit">Enviar tareas de hoy</button>
    </form>

    <br><a href="formNuevaTarea.php">➕Nueva Tarea</a>
    <br><a href="formEliminarTarea.php">➖Eliminar Tarea</a>
    <br><a href="logout.php" onclick="return confirm('¡Cuidado! Perderás los datos de tus tareas. ¿Estás seguro?')">🚪Cerrar sesión</a>

</body>
</html>
