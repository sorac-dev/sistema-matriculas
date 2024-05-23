<?php
include_once '../models/Database.class.php';
include_once '../models/Estudiante.class.php';


$database = new Database();
$db = $database->connect();

$estudiante = new Estudiante($db);



if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $programa = $_POST['programa'] ?? '';
    $id = $_POST['id'] ?? '';
    $nombre = $_POST['nombre'] ?? '';

    if ($programa == " " || $nombre == " " || $id == " ") {
        $programa = NULL;
        $nombre = NULL;
        $id = NUlL;
    }
    
    if (empty($programa) || empty($nombre)) {
        header('Location: ../estudiantes.php?env=3');
        exit();
    } else {

        $estudiante->id = $id;
        $estudiante->nombre = $nombre;
        $estudiante->programa = $programa;

        if ($estudiante->create()) {
            header('Location: ../estudiantes.php?env=1');
            exit();
        } else {
            header('Location: ../estudiantes.php?env=2');
            exit();
        }
    }
else :
    header('Location: ../estudiantes.php?env=4');
    exit();
endif;
