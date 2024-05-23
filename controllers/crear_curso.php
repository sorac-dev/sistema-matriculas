<?php
include_once '../models/Database.class.php';
include_once '../models/Curso.class.php';


$database = new Database();
$db = $database->connect();

$curso = new Curso($db);



if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $codigo = $_POST['codigo'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $horario = $_POST['horario'] ?? '';
    $profesor = $_POST['profesor'] ?? '';

    if (empty($codigo) || empty($nombre) || empty($horario) || empty($profesor)) {
        header('Location: ../cursos.php?env=3');
        exit();
    } else {

        /**
         * Validamos que no exista el curso
         */
        $getDataCurso = $curso->getDataCurso($codigo);
        $numDatosCurso = $getDataCurso->rowCount();

        if ($numDatosCurso < 1) {

            $curso->codigo = $codigo;
            $curso->nombre = $nombre;
            $curso->horario = $horario;
            $curso->profesor = $profesor;

            if ($curso->create()) {
                header('Location: ../cursos.php?env=1');
                exit();
            } else {
                header('Location: ../cursos.php?env=2');
                exit();
            }
        }  else {
            header('Location: ../cursos.php?env=5');
            exit();
        }
    }
else :
    header('Location: ../cursos.php?env=4');
    exit();
endif;
