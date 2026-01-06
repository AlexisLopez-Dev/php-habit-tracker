<?php
include_once('../modelos/Tarea.php');
include_once('../modelos/GestorTareas.php');

use Modelos\Tarea;
use Modelos\GestorTareas;

session_start();

$nombre = $_POST["nombre"] ?? "";
$icono = $_POST["icono"] ?? "fa-solid fa-list-check";

if (empty($nombre)){
    $_SESSION["error"] = "¡El nombre de la tarea es obligatorio!";
    header('Location: ../vistas/formNuevaTarea.php');
    exit();
}
$gestorTareas = $_SESSION["gestorTareas"];

$gestorTareas->anadirTarea($nombre, $icono);

$_SESSION['gestorTareas'] = $gestorTareas;

header('Location: ../index.php');
exit();