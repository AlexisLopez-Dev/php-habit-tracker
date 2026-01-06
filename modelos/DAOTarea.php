<?php
namespace Modelos;

require_once 'Tarea.php';
require_once __DIR__ . '/../servicios/Database.php';
require_once __DIR__ . '/../servicios/config.inc.php';

use Database;
use DateTime;

class DAOTarea{
    private $db;
    public function __construct(){
        $this->db = new Database(DSN, USER, PASSWORD);
    }

    public function getAll() : array {

        $sql = "SELECT * FROM gh_tareas";
        $registros = $this->db->executeQuery($sql);

        $listadoTareas = [];

        foreach ($registros as $fila){
            $nuevaTarea = new Tarea(
                $fila['id'],
                $fila['nombre'],
                $fila['icono'],
            );

            $sqlFechas = "SELECT fecha FROM gh_historial WHERE tarea_id = :id ";
            $registrosFechas = $this->db->executeQuery($sqlFechas, [':id' => $fila['id']]);

            foreach ($registrosFechas as $filaFecha){
                $nuevaTarea->anadirFecha(new DateTime($filaFecha['fecha']));
            }

            $listadoTareas[] = $nuevaTarea;
        }

        return $listadoTareas;
    }

    public function insert(string $nombre, string $icono) : int{
        $sql = "INSERT INTO gh_tareas (nombre, icono) VALUES (:nombre, :icono)";
        $params = [
            ":nombre" => $nombre,
            ":icono" => $icono
        ];
        return $this->db->executeUpdate($sql, $params);
    }

    public function delete(int $id) : int{
        $sql = "DELETE FROM gh_tareas WHERE id = :id";
        $params = [
            ":id" => $id
        ];
        return $this->db->executeUpdate($sql, $params);
    }

    public function obtenerPorId(int $id) : ?Tarea {
        $sql = "SELECT * FROM gh_tareas WHERE id = :id";
        $params = [":id" => $id];
        $resultado = $this->db->executeQuery($sql, $params);

        if (!empty($resultado)) {
            $fila = $resultado[0];
            $tarea = new Tarea($fila['id'], $fila['nombre'], $fila['icono']);

            $sqlFechas = "SELECT fecha FROM gh_historial WHERE tarea_id = :id";
            $registrosFechas = $this->db->executeQuery($sqlFechas, [':id' => $fila['id']]);

            foreach ($registrosFechas as $filaFecha){
                $tarea->anadirFecha(new DateTime($filaFecha['fecha']));
            }
            return $tarea;
        }
        return null;
    }

    public function toggleFecha(int $tareaId, DateTime $fecha){
        $fechaStr = $fecha->format('Y-m-d');

        // ¿Existe el ID en el historial?
        $sqlCheck = "SELECT id FROM gh_historial WHERE tarea_id = :id AND fecha = :fecha";
        $existe = $this->db->executeQuery($sqlCheck, [
            ':id' => $tareaId,
            ':fecha' => $fechaStr
        ]);

        if (!empty($existe)) {
            // Si existe, se borra (desmarcar)
            $sqlDelete = "DELETE FROM gh_historial WHERE tarea_id = :id AND fecha = :fecha";
            $this->db->executeUpdate($sqlDelete, [
                ':id' => $tareaId,
                ':fecha' => $fechaStr
            ]);
        } else {
            // Si no existe, se inserta (marcar)
            $sqlInsert = "INSERT INTO gh_historial (tarea_id, fecha) VALUES (:id, :fecha)";
            $this->db->executeUpdate($sqlInsert, [
                ':id' => $tareaId,
                ':fecha' => $fechaStr
            ]);
        }
    }


}