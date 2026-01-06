<?php
const OPCIONES_DEFECTO = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

class Database
{
    private $connection;

    public function __construct(string $dsn, string $usuario = 'root', string $password = '', array $opciones = OPCIONES_DEFECTO){
        try {
            $this->connection = new PDO($dsn, $usuario, $password, $opciones);
        } catch (PDOException $e) {
            die('Falló la conexión con la BDD: ' . $e->getMessage());
        }
    }

    public function executeQuery($sql, $params = []){
        $sentence = $this->connection->prepare($sql);
        $sentence->execute($params);
        return $sentence->fetchAll();
    }

    public function executeUpdate($sql, $params = []){
        $sentence = $this->connection->prepare($sql);
        if($sentence->execute($params)){
            return $sentence->rowCount();
        }
        return -1;
    }

    public function disconnect(){
        unset($this->connection);
    }

}