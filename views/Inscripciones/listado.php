<?php
require_once './models/Database.class.php';
require_once './models/Inscripcion.class.php';
require_once './models/Estudiante.class.php';
require_once './models/Curso.class.php';

$database = new Database();
$db = $database->connect();
$inscripcion = new Inscripcion($db);
$estudiante = new Estudiante($db);
$curso = new Curso($db);

$inscripciones = $inscripcion->read();
$inscripcionCount = $inscripciones->rowCount();
?>
<main class="container mt-3">
        <div class="mt-5">
            <h1 class="text-center mb-3">Lista de inscripciones</h1>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Curso codigo</th>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Fecha inscripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($inscripcionCount > 0) : ?>
                        <?php while ($row = $inscripciones->fetch(PDO::FETCH_ASSOC)) :?>
                            
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= "(#".$row['curso_codigo'].") ".$curso->getNameCurso($row['curso_codigo'])?></td>
                                <td><?= "(#".$row['estudiante_id'].") ".$estudiante->getNameEstudiante($row['estudiante_id'])?></td>
                                <td><?= $row['fecha'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Actualmente no hay ninguna inscripcion.
                        </div>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</main>