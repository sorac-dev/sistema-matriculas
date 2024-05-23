<?php
include_once './models/Database.class.php';
include_once './models/Curso.class.php';
include_once './models/Estudiante.class.php';

$database = new Database();
$db = $database->connect();

$curso = new Curso($db);
$estudiante = new Estudiante($db);

$cursos = $curso->read();
$estudiantes = $estudiante->read();

$cursosCount = $cursos->rowCount();
$estudiantesCount = $estudiantes->rowCount();
?>

<style>
    .container {
        max-width: 400px;
    }
</style>
<main class="container mt-3">

    <div class="mt-3">
        <h1 class="text-center mb-3">Crea nuevos estudiantes</h1>

        <?php

        $mensajes = [
            1 => "El estudiante fue inscrito correctamente",
            2 => "Ocurrio un error al inscribir el estudiante.",
            3 => "Faltan campos por rellenar.",
            4 => "Error al procesar el formulario.",
            5 => "El estudiante ya esta inscrito en ese curso."
        ];
        if (isset($_GET['env'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $mensajes[$_GET['env']]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php if ($cursosCount > 0 && $estudiantesCount > 0) : ?>

            <form method="POST" action="controllers/crear_inscripcion.php">
                <div class="mb-2">
                    <label for="curso_codigo" class="form-label">Codigo del curso: </label>
                    <select class="form-select" aria-label="Default select example" name="curso_codigo">

                        <?php while ($row = $cursos->fetch(PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $row['codigo']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>
                <div class="mb-2">
                    <label for="estudiante_id" class="form-label">Estudiante: </label>
                    <select class="form-select" aria-label="Default select example" name="estudiante_id">
                        <?php while ($row = $estudiantes->fetch(PDO::FETCH_ASSOC)) : ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-2">
                    <label for="fecha" class="form-label">Fecha inscripcion: </label>
                    <input type="date" name="fecha" class="form-control form-control-sm" required>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Enviar</button>
            </form>
        <?php else : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                No hay cursos o estudiantes disponibles.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
</main>