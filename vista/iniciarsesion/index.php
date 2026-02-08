<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaautogestion/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <title>Iniciar sesion</title>
</head>
<body class="bg-light">

    <main class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="card shadow border-0 p-4 rounded-4" style="max-width: 500px; width: 100%;">

            <!-- Logo -->
            <div class="text-center mb-3">
                <img src="/sistemaautogestion/vista/logo/logosai.png" alt="Logo SAI" class="img-fluid" style="max-width: 260px;">
            </div>

            <!-- Título -->
            <div class="text-center mb-4">
                <div class="fw-bold">Sistema de Autogestión Institucional</div>
                <span class="text-muted small">ITEC N°3 - Instituto Tecnológico N°3</span>
            </div>

            <!-- Error -->
            <?php if (!empty($error)){?>
                <div class="alert alert-danger py-2 text-center rounded-3">
                    <?php echo htmlspecialchars($error);?>
                </div>
            <?php };?>

            <!-- Formulario -->
            <form action="/sistemaautogestion/controlador/iniciarsesion.php" method="POST">

                <div class="mb-3">
                    <input type="text" name="user" class="form-control form-control-lg" placeholder="Usuario" required>
                </div>

                <div class="mb-4">
                    <input type="password" name="pass" class="form-control form-control-lg" placeholder="Contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fs-5"> Acceder </button>

            </form>

        </div>
    </main>

</body>
</html>