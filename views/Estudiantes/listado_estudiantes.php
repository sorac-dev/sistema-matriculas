<?php
require_once './models/Database.class.php';
require_once './models/Estudiante.class.php';

$database = new Database();
$db = $database->connect();
$estudiante = new Estudiante($db);

$estudiantes = $estudiante->read();
$estudiantesCount = $estudiantes->rowCount();
?>
<main class="container mt-3">
        <div class="mt-5">
            <h1 class="text-center mb-3">Lista de Estudiantes</h1>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Programa / Facultad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($estudiantesCount > 0) : ?>
                        <?php while ($row = $estudiantes->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['programa'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="alert alert-warning" role="alert">
                            Actualmente no hay estudiantes que mostrar.
                        </div>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</main>