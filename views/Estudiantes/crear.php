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
            1 => "El estudiante fue creado correctamente",
            2 => "Ocurrio un error al crear el estudiante.",
            3 => "Faltan campos por rellenar",
            4 => "Error al procesar el formulario"
        ];
        if (isset($_GET['env'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $mensajes[$_GET['env']]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>


        <form method="POST" action="controllers/crear_estudiante.php">
            <div class="mb-2">
                <label for="id" class="form-label">Numero de indentificacio</label>
                <input type="text" class="form-control form-control-sm" id="id" name="id" placeholder="Cedula / Tarjeta identidad" required>
            </div>
            <div class="mb-2">
                <label for="nombre" class="form-label">Nombre del estudiante</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Apellido" required>
            </div>
            <div class="mb-2">
                <label for="programa" class="form-label">Programa/Facultad</label>
                <input type="text" class="form-control form-control-sm" id="programa" name="programa" placeholder="Facultad actual" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Enviar</button>

        </form>

</main>