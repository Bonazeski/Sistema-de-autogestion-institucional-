<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaautogestion/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <title>Sistema Autogestion Institucional</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="p-3">
        <div class="container">
            <div class="d-flex justify-content-end">
                <a href="/sistemaautogestion/controlador/iniciarsesion.php" class="btn btn-primary">Iniciar sesión</a>
            </div>
        </div>
    </header>

    <main class="container text-center mt-4 flex-grow-1">

        <h1 class="display-4 fw-bold mt-2">Sistema de Autogestión Institucional</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 mt-5">
                    
                    <div class="row align-items-center">
                        <div class="col-md-7 text-start">
                            <h2 class="fw-semibold">Te damos la bienvenida a SAI</h2>
                            <p>
                                El Sistema de Autogestión Institucional es un espacio pensado para que alumnos y administrativos puedan gestionar su vida académica de manera simple y práctica.
                                Ingresá con tu usuario para comenzar a usarlo
                            </p>
                        </div>
                        <div class="col-md-5 text-center">
                            <img src="/sistemaautogestion/vista/logo/logosai.png" alt="" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="/sistemaautogestion/controlador/iniciarsesion.php" class="btn btn-success btn-lg">Comenzar</a>
        </div>
    </main>

    <footer class="bg-light text-center py-3 mt-auto">
        <p class="mb-0">© 2024 Sistema de Autogestión Institucional. Todos los derechos reservados.</p>  
    </footer>

</body>
</html>