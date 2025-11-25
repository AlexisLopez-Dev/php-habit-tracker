<?php
include_once('modelos/GestorTareas.php');
use Modelos\GestorTareas;

$gestorTareas = new GestorTareas();
$gestorTareas->anadirTarea("Beber 1L de agua")->anadirTarea("Hacer deporte");
$_SESSION['gestorTareas'] = $gestorTareas;