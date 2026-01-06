<?php
namespace Modelos;
class Tarea {
    private int $id;
    private string $nombre;
    private string $icono;
    private array $fechas;

    public function __construct(int $id, string $nombre, string $icono="📝"){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->icono = $icono;
        $this->fechas = [];
    }

    public function anadirFecha($nuevaFecha){
        if(!in_array($nuevaFecha, $this->fechas)){
            $this->fechas[] = $nuevaFecha;
        }
    }

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

    public function getIcono(): string {
        return $this->icono;
    }

    public function setIcono(string $icono): void {
        $this->icono = $icono;
    }

}