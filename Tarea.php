<?php
class Tarea {
    private static int $contador = 1;
    private int $id;
    private string $nombre;
    private array $fechas;

    public function __construct($nombre){
        $this->id = self::$contador++;
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

}