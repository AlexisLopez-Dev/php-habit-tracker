<?php
namespace Modelos;
use DateTime;

include_once('modelos/Tarea.php');
class GestorTareas {
    private array $tareas;
    private int $ultimoId;
    public function __construct(){
        $this->tareas = [];
        $this->ultimoId = 0;
    }

    public function anadirTarea(string $nombreTarea): GestorTareas{
        $this->ultimoId++;

        $nuevaTarea = new Tarea($this->ultimoId, $nombreTarea);
        $this->tareas[] = $nuevaTarea;
        return $this;
    }

    public function buscarPorId(int $id): ?Tarea{
//      return array_find($this->tareas, fn($t)=> $t->getId() == $id); Puede que no funcione porque es version 8.4 PHP
        foreach ($this->tareas as $tarea){
            if($tarea->getId() === $id){
                return $tarea;
            }
        }
        return null;
    }

    public function eliminarTarea(int $id){
        $tareaParaEliminar = $this->buscarPorId($id);

        $indice = array_search($tareaParaEliminar, $this->tareas);

        array_splice($this->tareas, $indice, 1);
    }


    public function toggleTarea(int $id, DateTime $fecha){
        $tarea = $this->buscarPorId($id);
        if(in_array($fecha, $tarea->getFechas())){
            $this->eliminaFechaEnTarea($tarea, $fecha);
        } else {
            $this->anadeFechaEnTarea($tarea, $fecha);
        }
    }

    public function anadeFechaEnTarea(Tarea $tarea, DateTime $fecha){
        $tarea->anadirFecha($fecha);
    }

    public function eliminaFechaEnTarea(Tarea $tarea, DateTime $fecha){
        $tarea->eliminarFecha($fecha);
    }

    public function getTareas(): array {
        return $this->tareas;
    }

}