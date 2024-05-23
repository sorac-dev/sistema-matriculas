<?php
require_once './models/Database.class.php';
require_once './models/Curso.class.php';

$database = new Database();
$db = $database->connect();
?>
<main class="container mt-3">
    <div class="mt-5">
        <form method="get">
            <div class="mb-2">
                <label for="profesor" class="form-label">Profesor</label>
                <input type="text" class="form-control form-control-sm" id="profesor" name="profesor" placeholder="Ingrese el nombre del docente" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>
    </div>
    <div class="mt-5">
        <h1 class="text-center mb-3">Listado de cursos por profesor.</h1>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Profesor</th>
                </tr>
            </thead>
            <?php
            if (isset($_GET['profesor'])) {
                $curso = new Curso($db);
                $profesor = $_GET['profesor'];

                $result = $curso->readByProfesor($profesor);
                $num = $result->rowCount();
            ?>
                <tbody>
                    <?php if ($num > 0) { ?>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row['codigo'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['horario'] ?></td>
                                <td><?= $row['profesor'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php } else { ?>
                        <div class="alert alert-warning" role="alert">
                            El profesor no esta registrado en la base de datos.
                        </div>
                    <?php }
                } else {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Ingrese el nombre del profesor.
                    </div>
                <?php
                } ?>
                </tbody>
        </table>
    </div>
</main>