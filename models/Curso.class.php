<?php
class Curso {
    private $conn;
    private $table = 'cursos';

    public $codigo;
    public $nombre;
    public $horario;
    public $profesor;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET codigo=:codigo, nombre=:nombre, horario=:horario, profesor=:profesor";
        $stmt = $this->conn->prepare($query);

        $this->codigo = htmlspecialchars(strip_tags($this->codigo));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->horario = htmlspecialchars(strip_tags($this->horario));
        $this->profesor = htmlspecialchars(strip_tags($this->profesor));

        $stmt->bindParam(':codigo', $this->codigo);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':horario', $this->horario);
        $stmt->bindParam(':profesor', $this->profesor);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByProfesor($profesor) {
        $query = "SELECT * FROM " . $this->table . " WHERE profesor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $profesor);
        $stmt->execute();
        return $stmt;
    }

    public function getDataCurso($codigo){
        $query = "SELECT * FROM ".$this->table." WHERE codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        return $stmt; 
    }

    public function getNameCurso($codigo){
        $query = "SELECT nombre FROM ".$this->table." WHERE codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result['nombre']; 
    }
}

?>