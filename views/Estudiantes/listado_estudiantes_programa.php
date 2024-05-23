<?php
require_once './models/Database.class.php';
require_once './models/Estudiante.class.php';
require_once './models/Curso.class.php';

$database = new Database();
$db = $database->connect();
$curso = new Curso($db);

?>
<main class="container mt-3">
    <div class="mt-5">
        <form method="get">
            <div class="mb-2">
                <label for="programa" class="form-label">Programa / Facultad</label>
                <input type="text" class="form-control form-control-sm" id="programa" name="programa" placeholder="Ingrese nombre de la facultad" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>
    </div>
    <div class="mt-5">
        <?php
        if (isset($_GET['programa'])) {
            $estudiante = new Estudiante($db);

            $programa = $_GET['programa'];

            $result = $estudiante->readByPrograma($programa);
            $num = $result->rowCount();
        ?>
            <h1 class="text-center mb-3">Listado de estudiantes por progama / facultad.</h1>
            <h5 class="text-center mb-3"><b><?= $programa ?></b></h5>
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
                        Ingrese el nombre del programa / facultad
                    </div>
                <?php
                } ?>
                </tbody>
            </table>
    </div>
</main>