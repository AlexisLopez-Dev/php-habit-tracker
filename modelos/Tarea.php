<?php
namespace Modelos;
class Tarea {
    private int $id;  // <- Esto lo habría hecho con un contador estático para que autoincrementase, pero trabajando con sesion no funciona bien el static
    private string $nombre;
    private array $fechas;

    public function __construct(int $id, string $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fechas = [];
    }

    public function anadirFecha($nuevaFecha){
        if(!in_array($nuevaFecha, $this->fechas)){
            $this->fechas[] = $nuevaFecha;
        }
    }

    // todo: repasar esto de la clave => valor
    public function eliminarFecha($fecha){
        foreach($this->fechas as $clave => $valor){
            if($valor == $fecha){
                unset($this->fechas[$clave]);
            }
        }
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre(string $nombre): void{
        $this->nombre = $nombre;
    }

    public function getId(): int{
        return $this->id;
    }

    public function getFechas(): array{
        return $this->fechas;
    }

    public function setFechas(array $fechas): void{
        $this->fechas = $fechas;
    }

    public function __toString(){

        $cadena = $this->id . "- " . $this->nombre . " - ";
        foreach ($this->fechas as $fecha){
            $fechaStringFormateada = $fecha->format('d/m/Y');
            $cadena += $fechaStringFormateada ;
        }

        return $cadena;
    }

}