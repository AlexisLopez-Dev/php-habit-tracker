<?php
include_once('../modelos/Tarea.php');
include_once('../modelos/GestorTareas.php');
session_start();

$gestorTareas = $_SESSION["gestorTareas"];
$id = (int)($_GET["id"] ?? 0);

if (empty($id)){
    $_SESSION["error"] = "¡El id de la tarea es obligatorio!";
    header('Location: ../index.php');
    exit();
}

if (empty($gestorTareas->buscarPorId($id))){
    $_SESSION["error"] = "¡No existe ninguna tarea con ese ID!";
    header('Location: ../index.php');
    exit();
}

$gestorTareas->eliminarTarea($id);
$_SESSION["gestorTareas"] = $gestorTareas;

header('Location: ../index.php');
exit();