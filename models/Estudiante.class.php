<?php
class Estudiante {
    private $conn;
    private $table = 'estudiantes';

    public $id;
    public $nombre;
    public $programa;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET id = :id,nombre=:nombre, programa=:programa";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->programa = htmlspecialchars(strip_tags($this->programa));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':programa', $this->programa);

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

    public function readByPrograma($programa) {
        $query = "SELECT * FROM " . $this->table . " WHERE programa LIKE ?";
        $stmt = $this->conn->prepare($query);
        
        # Agregar comodines a la cadena de búsqueda para buscar coincidencias parciales
        $programa_like = '%' . $programa . '%'; 
        $stmt->execute([$programa_like]);
        return $stmt;
    }
    

    public function getNameEstudiante($id){
        $query = "SELECT nombre FROM ".$this->table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result['nombre']; 
    }
}

?>