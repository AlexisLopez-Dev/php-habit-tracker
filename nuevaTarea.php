<?php
include_once('Tarea.php');
include_once('GestorTareas.php');
session_start();

$nombre = $_POST["nombre"] ?? "";
if (empty($nombre)){
    $_SESSION["error"] = "El nombre de la tarea es obligatorio!! 😡";
    header('Location: formEliminarTarea.php');
    exit();
}
$gestorTareas = $_SESSION["gestorTareas"];

$gestorTareas->anadirTarea($nombre);

$_SESSION['gestorTareas'] = $gestorTareas;

header('Location: index.php');
exit();