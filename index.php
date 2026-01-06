<?php
include_once('modelos/Tarea.php');
include_once('modelos/GestorTareas.php');

use Modelos\Tarea;
use Modelos\GestorTareas;

session_start();

if (!isset($_SESSION['gestorTareas'])){
    include_once('servicios/simulaBBDD.php');
}

$gestorTareas = $_SESSION['gestorTareas'];
$_SESSION["error"] = "";

if(isset($_GET['fecha'])){
    $fechaVista = DateTime::createFromFormat('Y-m-d', $_GET['fecha']);
} else {
    $fechaVista = new Datetime();
}
$fechaVista->setTime(0,0,0);
$fechaVistaString = $fechaVista->format('Y-m-d');
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Streaks</title>
    <link rel="icon" type="image/svg+xml" href="css/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Mis Hábitos</h1>

    <form action="index.php" method="get" class="date-picker">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?=$fechaVistaString?>" onchange="this.form.submit()">
    </form>

    <ul class="lista-tareas">
        <?php
        $arrayTareas = $gestorTareas->getTareas();

        foreach ($arrayTareas as $tarea){
            $fechasStringsGuardadas = array_map(fn($f) => $f->format('Y-m-d'), $tarea->getFechas());
            $estaCompletada = in_array($fechaVistaString, $fechasStringsGuardadas);

            if($estaCompletada){
                $claseEstado = "completada";
            } else {
                $claseEstado = "pendiente";
            }

            $urlToggle = "controladores/toggleTareas.php?id=" . $tarea->getId() . "&date=" . $fechaVistaString;
            $urlEliminar = "controladores/eliminarTarea.php?id=" . $tarea->getId();

            echo "<li class='tarea-item'>";

                    echo "<a href='$urlToggle' class='enlace-toggle'>";

                    echo "<div class='estado-btn $claseEstado'>";
                    echo "<i class='" . $tarea->getIcono() . "'></i>";
                    echo "</div>";

                    echo "<div class='info-tarea'>";
                    echo "<span class='nombre-tarea $claseEstado'>" . $tarea->getNombre() . "</span>";
                    echo "</div>";

                    echo "</a>";

                echo "<a href='$urlEliminar' class='btn-eliminar' onclick=\"return confirm('¿Borrar?')\">";
                echo "<i class='fa-solid fa-xmark'></i>";
                echo "</a>";

            echo "</li>";
        }
        ?>
    </ul>

    <p style='text-align: center; color: #666;'>
    <?= (empty($arrayTareas)) ? "No tienes hábitos creados para hoy" : ""?>
    </p>

    <br>

    <a href="vistas/formNuevaTarea.php" class="btn-action btn-primary">
        <i class="fa-solid fa-plus"></i> Nuevo Hábito
    </a>

    <a href="controladores/logout.php" class="btn-action" onclick="return confirm('¿Cerrar sesión?')">
        <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
    </a>
</div>

</body>
</html>