<nav class="navbar navbar-expand-lg bg-white border-bottom p-0">
  <div class="container-fluid">
    <a class="navbar-brand py-0 me-5" href="/sistemaautogestion/vista/inicioadm/index.php">
       <img src="/sistemaautogestion/vista/logo/logosai.png" alt="Logo" style="height: 38px;">
    </a>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item dropdown me-2">
          <a class="nav-link dropdown-toggle py-3 px-3 text-dark" href="#" id="dropdownInscribir" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Inscribir
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownInscribir">
            <li><a class="dropdown-item" href="#">Inscribir a la carrera</a></li>
            <li><a class="dropdown-item" href="#">Inscribir a una materia</a></li>
            <li><a class="dropdown-item" href="#">Inscribir a una mesa de examen</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown me-2">
          <a class="nav-link dropdown-toggle py-3 px-3 text-dark" href="#" id="dropdownRegistrar" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Registrar
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownRegistrar">
            <li><a class="dropdown-item" href="/sistemaautogestion/controlador/cargarmesas.php">Mesa de examen</a></li>
            <li class="bg-light"><a class="dropdown-item" href="#">Notas de alumnos</a></li>
            <li><a class="dropdown-item" href="#">Carrera</a></li>
            <li><a class="dropdown-item" href="#">Plan de estudio</a></li>
            <li><a class="dropdown-item" href="#">Materia</a></li>
            <li><a class="dropdown-item" href="#">Docente</a></li>
            <li><a class="dropdown-item" href="#">Asignación de materias a docentes</a></li>
            <li><a class="dropdown-item" href="#">Correlatividades</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown me-4">
          <a class="nav-link dropdown-toggle py-3 px-3 text-dark" href="#" id="dropdownReportes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownReportes">
            <li><a class="dropdown-item" href="#">Listado de alumnos</a></li>
            <li><a class="dropdown-item" href="#">Información sobre las carreras</a></li>
            <li><a class="dropdown-item" href="#">Notas de los alumnos</a></li>
          </ul>
        </li>

        <li class="nav-item d-flex align-items-center">
          <a href="/sistemaautogestion/controlador/cerrarsesion.php" class="btn btn-primary px-3">Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>