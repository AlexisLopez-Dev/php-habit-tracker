<?php
// Comprobaciones de que existe el id blabla
include_once('../modelos/Tarea.php');
include_once('../modelos/GestorTareas.php');

use Modelos\Tarea;
use Modelos\GestorTareas;

session_start();

if (!isset($_SESSION['gestorTareas'])){
    header('Location: ../index.php');
    exit();
}

if (isset($_POST["date"]) && isset($_POST["tareasSeleccionadas"])){
    $fechaString = $_POST["date"];
    $idTareas = $_POST["tareasSeleccionadas"];

    $fecha = DateTime::createFromFormat('Y-m-d', $fechaString);

    foreach ($idTareas as $id){
        $id = (int)$id;
        $_SESSION["gestorTareas"]->toggleTarea($id, $fecha);
    }
}

header('Location: ../index.php');
exit();