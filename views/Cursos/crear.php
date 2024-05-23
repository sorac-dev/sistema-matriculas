<style>
    .container {
        max-width: 400px;
    }
</style>
<main class="container mt-3">
    <div class="mt-3">
        <h1 class="text-center mb-3">Crea nuevos cursos</h1>

        <?php

         $mensajes = [
            1 => "El curso fue creado correctamente",
            2 => "Ocurrio un error al crear el curso.",
            3 => "Faltan campos por rellenar",
            4 => "Error al procesar el formulario",
            5 => "El codigo de curso ya existe."
        ];
        if (isset($_GET['env'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $mensajes[$_GET['env']]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>


        <form method="POST" action="controllers/crear_curso.php">
            <div class="mb-2">
                <label for="codigo" class="form-label">Código</label>
                <input type="number" class="form-control form-control-sm" id="codigo" name="codigo" min="1" required>
            </div>
            <div class="mb-2">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
            </div>
            <div class="mb-2">
                <label for="horario" class="form-label">Horario</label>
                <input type="text" class="form-control form-control-sm" id="horario" name="horario" required>
            </div>
            <div class="mb-2">
                <label for="profesor" class="form-label">Profesor</label>
                <input type="text" class="form-control form-control-sm" id="profesor" name="profesor" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Enviar</button>

        </form>

</main>