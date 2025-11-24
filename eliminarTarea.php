<?php
include_once('GestorTareas.php');
session_start();

$gestorTareas = $_SESSION["gestorTareas"];
$id = (int)($_POST["id"] ?? 0);

if (empty($id)){
    $_SESSION["error"] = "El id de la tarea es obligatorio!! 😡";
    header('Location: formEliminarTarea.php');
    exit();
}

// buscar si la tarea con el id existe
if (empty($gestorTareas->buscarPorId($id))){
    $_SESSION["error"] = "No existe ninguna tarea con ese ID!! 😡";
    header('Location: formEliminarTarea.php');
    exit();
}

$gestorTareas->eliminarTarea($id);
$_SESSION["gestorTareas"] = $gestorTareas;
header('Location: index.php');
exit();