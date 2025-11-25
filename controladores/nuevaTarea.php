<?php
include_once('../modelos/Tarea.php');
include_once('../modelos/GestorTareas.php');

use Modelos\Tarea;
use Modelos\GestorTareas;  // todo: aqui no hacen falta los use? por qué?

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

header('Location: ../index.php');
exit();