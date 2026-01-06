<?php
include_once('modelos/DAOTarea.php');
use Modelos\DAOTarea;

$dao = new DAOTarea();
$arrayTareas = $dao->getAll();

session_start();

$_SESSION["error"] = "";

if(isset($_GET['fecha'])){
    $fechaVista = DateTime::createFromFormat('Y-m-d', $_GET['fecha']);
} else {
    $fechaVista = new Datetime();
}
$fechaVista->setTime(0,0,0);
$fechaVistaString = $fechaVista->format('Y-m-d');

$hoy = new DateTime();
$hoy->setTime(0,0,0);
$hoyString = $hoy->format('Y-m-d');

$ayer = new DateTime($fechaVistaString);
$ayer->modify('-1 day');
$ayerString = $ayer->format('Y-m-d');

$manana = new DateTime($fechaVistaString);
$manana->modify('+1 day');
$mananaString = $manana->format('Y-m-d');

$puedeAvanzar = ($manana <= $hoy);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestor de hábitos</title>
    <link rel="icon" type="image/svg+xml" href="css/favicon.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Mis Hábitos</h1>

    <form action="index.php" method="get" class="date-picker">

        <a href="index.php?fecha=<?=$ayerString?>" class="btn-nav-fecha">
            <i class="fa-solid fa-chevron-left"></i>
        </a>

        <input type="date" name="fecha" id="fecha"
               value="<?=$fechaVistaString?>"
               max="<?=$hoyString?>"
               onchange="this.form.submit()">

        <?php if($puedeAvanzar): ?>
            <a href="index.php?fecha=<?=$mananaString?>" class="btn-nav-fecha">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        <?php else: ?>
            <span class="btn-nav-fecha disabled">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        <?php endif; ?>

    </form>


    <ul class="lista-tareas">
        <?php

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

    <?= empty($arrayTareas) ? "<p style='text-align: center; color: #666;'>No tienes hábitos creados. ¡Empieza hoy!</p>" : "" ?>

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