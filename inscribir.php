<?php
include_once 'models/Database.class.php';
include_once 'models/Curso.class.php';
include_once 'models/Estudiante.class.php';

$database = new Database();
$db = $database->connect();

$curso = new Curso($db);
$estudiante = new Estudiante($db);

$cursos = $curso->read();
$estudiantes = $estudiante->read();

$cursosCount = $cursos->rowCount();
$estudiantesCount = $estudiantes->rowCount();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscribir Estudiante en Curso</title>
</head>

<body>

    <?php if ($cursosCount > 0 && $estudiantesCount > 0) : ?>
        <form action="controllers/procesar_inscripcion.php" method="post">

            <select class="form-select" aria-label="Default select example" name="estudiante_id">
                <option selected>Estudiante:</option>
                <?php while ($row = $estudiantes->fetch(PDO::FETCH_ASSOC)) : ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php endwhile; ?>
            </select> 

            <label>ID del Estudiante:</label><br>
            <select name="estudiante_id">
                <?php while ($row = $estudiantes->fetch(PDO::FETCH_ASSOC)) : ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                <?php endwhile; ?>
            </select><br>

            <label>Fecha de Inscripción:</label><br>
            <input type="date" name="fecha" required><br>
            <input type="submit" value="Inscribir">
        </form>
    <?php else : ?>
        <p>No hay cursos o estudiantes disponibles para la inscripción.</p>
    <?php endif; ?>

</body>

</html>