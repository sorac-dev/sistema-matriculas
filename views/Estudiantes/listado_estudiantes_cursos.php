<?php
require_once './models/Database.class.php';
require_once './models/Inscripcion.class.php';
require_once './models/Curso.class.php';

$database = new Database();
$db = $database->connect();
$curso = new Curso($db);

?>
<main class="container mt-3">
    <div class="mt-5">
        <form method="get">
            <div class="mb-2">
                <label for="codigo" class="form-label">Codigo de curso</label>
                <input type="text" class="form-control form-control-sm" id="codigo" name="codigo" placeholder="Ingrese el codigo de curso" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>
    </div>
    <div class="mt-5">
        <?php
        if (isset($_GET['codigo'])) {
            $inscritos = new Inscripcion($db);
            $codigo = $_GET['codigo'];

            $result = $inscritos->readByCurso($codigo);
            $num = $result->rowCount();
        ?>
            <h1 class="text-center mb-3">Listado de estudiantes por cursos.</h1>
            <h5 class="text-center mb-3"><b><?=$curso->getNameCurso($codigo)?></b></h5>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Estudiante</th>
                        <th scope="col">Programa</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($num > 0) { ?>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['programa'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php } else { ?>
                        <div class="alert alert-warning" role="alert">
                            El programa ingresado, no esta registrado en la base de datos.
                        </div>
                    <?php }
                } else {
                    ?>
                    <div class="alert alert-primary" role="alert">
                        Ingrese el codigo del programa
                    </div>
                <?php
                } ?>
                </tbody>
            </table>
    </div>
</main>