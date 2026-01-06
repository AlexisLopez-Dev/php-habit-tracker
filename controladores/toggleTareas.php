<?php
include_once('../modelos/DAOTarea.php');
use Modelos\DAOTarea;

session_start();

if (isset($_GET["id"]) && isset($_GET["date"])){

    $id = (int)$_GET["id"];
    $fechaString = $_GET["date"];

    $fecha = DateTime::createFromFormat('Y-m-d', $fechaString);

    if($fecha){
        $fecha->setTime(0,0,0);

        $hoy = new DateTime();
        $hoy->setTime(0,0,0);

        if ($fecha > $hoy) {
            header('Location: ../index.php?fecha=' . $fechaString);
            exit();
        }

        $dao = new DAOTarea();
        $dao->toggleFecha($id, $fecha);
    }
}

header('Location: ../index.php?fecha=' . $_GET["date"]);
exit();