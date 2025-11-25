<?php
include_once('modelos/Tarea.php');
include_once('modelos/GestorTareas.php');

use Modelos\Tarea;
use Modelos\GestorTareas;

session_start();

if (!isset($_SESSION['gestorTareas'])){
    include_once('servicios/simulaBBDD.php');
}
$fechaVista = new Datetime();
$gestorTareas = $_SESSION['gestorTareas'];
$_SESSION["error"] = "";

// todo: reordenar en carpetas modelos, controladores, vistas, servicios? (para simular bbdd)

// todo: con el atributo check: checked ir comprobando en cada día si la tarea está hecha, mostrarla checked
// todo: metodo en gestorTareas para checkar-deschekar
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
    <form action="controladores/anadeFechaEnTareas.php" method="post">
        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" value="<?=$fechaVista->format('Y-m-d')?>" required><br>

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

    <br><a href="vistas/formNuevaTarea.php">➕Nueva Tarea</a>
    <br><a href="vistas/formEliminarTarea.php">➖Eliminar Tarea</a>
    <br><a href="controladores/logout.php" onclick="return confirm('¡Cuidado! Perderás los datos de tus tareas. ' +
     '¿Estás seguro?')">🚪Cerrar sesión</a>

</body>
</html>
