<?php
require_once './models/Database.class.php';
require_once './models/Curso.class.php';

$database = new Database();
$db = $database->connect();
$curso = new Curso($db);

$cursos = $curso->read();
$cursosCount = $cursos->rowCount();
?>
<main class="container mt-3">
        <div class="mt-5">
            <h1 class="text-center mb-3">Lista de Cursos</h1>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Profesor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($cursosCount > 0) : ?>
                        <?php while ($row = $cursos->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row['codigo'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['horario'] ?></td>
                                <td><?= $row['profesor'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Actualmente no hay cursos que mostrar.
                        </div>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</main>