<?php
include_once('../modelos/Tarea.php');
include_once('../modelos/GestorTareas.php');

use Modelos\GestorTareas;

session_start();

if (!isset($_SESSION['gestorTareas'])){
    header('Location: ../index.php');
    exit();
}

if (isset($_GET["id"]) && isset($_GET["date"])){

    $id = (int)$_GET["id"];
    $fechaString = $_GET["date"];

    $fecha = DateTime::createFromFormat('Y-m-d', $fechaString);
    $fecha->setTime(0,0,0);

    if($_SESSION["gestorTareas"]->buscarPorId($id)){
        $_SESSION["gestorTareas"]->toggleTarea($id, $fecha);
    }
}

header('Location: ../index.php?fecha=' . $_GET["date"]);
exit();