<?php
include_once '../models/Database.class.php';
include_once '../models/Inscripcion.class.php';

$database = new Database();
$db = $database->connect();

$inscripcion = new Inscripcion($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') :

    $curso_codigo = $_POST['curso_codigo'] ?? '';
    $estudiante_id = $_POST['estudiante_id'] ?? '';
    $fecha = $_POST['fecha'] ?? '';



    if ($curso_codigo == " " || $estudiante_id == " " || $fecha == " ") {
        $curso_codigo = NULL;
        $estudiante_id = NULL;
        $fecha = NULL;
    }

    if (empty($curso_codigo) || empty($estudiante_id) || empty($fecha)) {
        header('Location: ../inscripciones.php?env=3');
        exit();
    } else {
        $dataInscripcion = $inscripcion->getDataInscripcion($estudiante_id);
        $row = $dataInscripcion->fetch(PDO::FETCH_ASSOC);

        if ($curso_codigo  == $row["curso_codigo"]) {
            header('Location: ../inscripciones.php?env=5');
            exit();
        }

        $inscripcion->curso_codigo = $curso_codigo;
        $inscripcion->estudiante_id = $estudiante_id;
        $inscripcion->fecha = $fecha;

        if ($inscripcion->create()) {
            header('Location: ../inscripciones.php?env=1');
            exit();
        } else {
            header('Location: ../inscripciones.php?env=2');
            exit();
        }
    }
else :
    header('Location: ../inscripciones.php?env=4');
    exit();
endif;
