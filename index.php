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
$fechaVista->setTime(0,0,0);

$gestorTareas = $_SESSION['gestorTareas'];
$_SESSION["error"] = "";

// todo: Dar opcion de subir imagen al crear la tarea
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
    <form action="controladores/toggleTareas.php" method="post">
        <label for="date">Fecha:</label>
        <input type="date" name="date" id="date" value="<?=$fechaVista->format('Y-m-d')?>" required><br>

        <?php
        $arrayTareas = $gestorTareas->getTareas();
        $fechaVistaString = $fechaVista->format('Y-m-d'); // prueba

        foreach ($arrayTareas as $tarea){
            $checkedEstado = "";
            $fechasStringsGuardadas = array_map(fn($fecha) => $fecha->format('Y-m-d'), $tarea->getFechas()); // prueba

            if(in_array($fechaVistaString, $fechasStringsGuardadas)){
                $checkedEstado = "checked";
            }

            echo ("<label for='tarea".$tarea->getId()."'>" . $tarea->getId() . " - " . $tarea->getNombre()."</label>
                   <input type='checkbox' 
                          name='tareasSeleccionadas[]' 
                          value='".$tarea->getId()."'
                          id='tarea".$tarea->getId()."'
                          $checkedEstado
                          ><br>");
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
