<?php
class GestorTareas {
    private array $tareas;
    public function __construct(){
        $this->tareas = [];
    }

    public function anadirTarea($nuevaTarea): GestorTareas{
        $this->tareas[] = $nuevaTarea;
        return $this;
    }

    public function getTareas(): array {
        return $this->tareas;
    }

}