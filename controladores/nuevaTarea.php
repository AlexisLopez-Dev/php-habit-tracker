<?php
include_once('../modelos/DAOTarea.php');
use Modelos\DAOTarea;

session_start();

$nombre = $_POST["nombre"] ?? "";
$icono = $_POST["icono"] ?? "fa-solid fa-list-check";

if (empty($nombre)){
    $_SESSION["error"] = "¡El nombre de la tarea es obligatorio!";
    header('Location: ../vistas/formNuevaTarea.php');
    exit();
}

$dao = new DAOTarea();
$dao->insert($nombre, $icono);

header('Location: ../index.php');
exit();