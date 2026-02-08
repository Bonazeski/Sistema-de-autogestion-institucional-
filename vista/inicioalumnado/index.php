<?php require_once '../../controlador/seguridad.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaautogestion/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <title>SAI | Inicio</title>
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <?php include 'navbar.php'; ?>

    <main class="container py-5 flex-grow-1">

        <h1 class="fw-bold mb-3">Titulo de inicio</h1>
        <p class="text-muted mb-5" style="max-width: 700px;">
            A short example of text to complement the opening title and make up most of its content.
        </p>

        <div class="row g-4">

            <!-- Tarjeta 1 -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 rounded-4 h-100">
                    <h4 class="fw-semibold">Inscribete a materias</h4>
                    <p class="text-muted">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-success px-4">Ir</a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 rounded-4 h-100">
                    <h4 class="fw-semibold">Inscribete a mesas de examen</h4>
                    <p class="text-muted">
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-success px-4">Ir</a>
                </div>
            </div>

        </div>

    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
