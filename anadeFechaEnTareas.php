<?php
// Comprobaciones de que existe el id blabla
include_once('GestorTareas.php');
session_start();

if (!isset($_SESSION['gestorTareas'])){
    header('Location: index.php');
    exit();
}

$gestorTareas = $_SESSION["gestorTareas"];

if (isset($_POST["date"]) && isset($_POST["tareasSeleccionadas"])){
    $fechaString = $_POST["date"];
    $idTareas = $_POST["tareasSeleccionadas"];

    $fecha = DateTime::createFromFormat('Y-m-d', $fechaString);

    foreach ($idTareas as $id){
        $id = (int)$id;
        $gestorTareas->anadeFechaEnTarea($id, $fecha);
    }

    $_SESSION["gestorTareas"] = $gestorTareas;
}

header('Location: index.php');
exit();