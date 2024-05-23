<?php
class Inscripcion {
    private $conn;
    private $table = 'inscripciones';

    public $id;
    public $curso_codigo;
    public $estudiante_id;
    public $fecha;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET curso_codigo=:curso_codigo, estudiante_id=:estudiante_id, fecha=:fecha";
        $stmt = $this->conn->prepare($query);

        $this->curso_codigo = htmlspecialchars(strip_tags($this->curso_codigo));
        $this->estudiante_id = htmlspecialchars(strip_tags($this->estudiante_id));
        $this->fecha = htmlspecialchars(strip_tags($this->fecha));

        $stmt->bindParam(':curso_codigo', $this->curso_codigo);
        $stmt->bindParam(':estudiante_id', $this->estudiante_id);
        $stmt->bindParam(':fecha', $this->fecha);

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
    
    public function getDataInscripcion($id){
        $query = "SELECT curso_codigo, estudiante_id FROM ".$this->table." WHERE estudiante_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt; 
    }

    public function readByCurso($curso_codigo) {
        $query = "SELECT e.id, e.nombre, e.programa FROM " . $this->table . " i 
                  LEFT JOIN estudiantes e ON i.estudiante_id = e.id 
                  WHERE i.curso_codigo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $curso_codigo);
        $stmt->execute();
        return $stmt;
    }

    
}

?>