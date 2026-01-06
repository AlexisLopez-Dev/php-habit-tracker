<?php
include_once('modelos/GestorTareas.php');
use Modelos\GestorTareas;

$gestorTareas = new GestorTareas();
$gestorTareas->anadirTarea("Beber 1L de agua", "fa-solid fa-glass-water");
$gestorTareas->anadirTarea("Hacer deporte", "fa-solid fa-person-running");
$gestorTareas->anadirTarea("Leer un libro", "fa-solid fa-book-open");
$_SESSION['gestorTareas'] = $gestorTareas;