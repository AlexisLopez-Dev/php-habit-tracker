<?php
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
        $this->fechas[] = $nuevaFecha;
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
        return $this->id . ": " . $this->nombre;
    }

}