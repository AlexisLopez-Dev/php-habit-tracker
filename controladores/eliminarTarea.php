<?php
include_once('../modelos/DAOTarea.php');
use Modelos\DAOTarea;

session_start();

$id = (int)($_GET["id"] ?? 0);

if (empty($id)){
    $_SESSION["error"] = "¡El id de la tarea es obligatorio!";
    header('Location: ../index.php');
    exit();
}

$dao = new DAOTarea();
$dao->delete($id);

header('Location: ../index.php');
exit();