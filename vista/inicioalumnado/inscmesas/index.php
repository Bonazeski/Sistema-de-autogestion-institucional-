<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaautogestion/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <title>Inscripción a materias</title>
</head>

<body style="display:flex; min-height:100vh; flex-direction:column;">

    <?php include __DIR__ . '/../navbar.php'; ?>

    <main class="container py-4" style="flex:1;">

        <h1 class="mb-4">Mesas de examen disponibles</h1>

        <!-- FORMULARIO DE FILTRO -->
        <form method="POST" class="row g-3 mb-4 align-items-end">

            <!-- SELECT CARRERA -->
            <div class="col-md-6">
                <label class="form-label">Carrera</label>
                <select name="id_carrera" class="form-select" required>
                    <option value="">Seleccione...</option>

                    <?php foreach ($carreras_inscriptas as $carrera): ?>
                        <option value="<?= $carrera['id_carrera'] ?>"
                            <?= ($id_carrera_seleccionada == $carrera['id_carrera']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($carrera['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Año de cursada</label>
                <select name="anio" class="form-select" required>
                    <option value="">...</option>
                    <option value="1" <?= ($anio_seleccionado == 1) ? 'selected' : '' ?>>1º</option>
                    <option value="2" <?= ($anio_seleccionado == 2) ? 'selected' : '' ?>>2º</option>
                    <option value="3" <?= ($anio_seleccionado == 3) ? 'selected' : '' ?>>3º</option>
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </div>

            <div class="col-md-2 d-grid">
                <a href="mesasdeexamendisponibles.php" class="btn btn-outline-secondary">Limpiar</a>
            </div>

        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
            <p class="text-muted">Aún no se han aplicado filtros.</p>
        <?php endif; ?>


        <?php
        // unificar todas las mesas en un solo array
            
        if (!isset($mesasdeexamen) || !is_array($mesasdeexamen)) {
            $mesasdeexamen = [];
        }

        $todas_las_mesas = [];
        foreach ($mesasdeexamen as $lista) {
            $todas_las_mesas = array_merge($todas_las_mesas, $lista);
        }
        ?>
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-<?= $mensaje['tipo'] ?> alert-dismissible fade show">
                <?= htmlspecialchars($mensaje['texto']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($todas_las_mesas)): ?>

            <?php
            // separar por comisión
            $mesas_comision_a = array_filter($todas_las_mesas, fn($m) => strtolower($m['comision']) === 'a');
            $mesas_comision_b = array_filter($todas_las_mesas, fn($m) => strtolower($m['comision']) === 'b');
            ?>

            <!-- TABS -->
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#comA">Comisión A</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#comB">Comisión B</button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- TAB A -->
                <div class="tab-pane fade show active" id="comA">

                    <?php if (!empty($mesas_comision_a)): ?>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Materia</th>
                                    <th>Comisión</th>
                                    <th>Docente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($mesas_comision_a as $m): ?>
                                <tr>
                                    <td><?= htmlspecialchars($m['nombre_materia']) ?></td>
                                    <td><?= htmlspecialchars($m['comision']) ?></td>
                                    <td><?= htmlspecialchars($m['nombre'] . ' ' . $m['apellido']) ?></td>
                                    <td><?= htmlspecialchars($m['fecha_mesa']) ?></td>
                                    <td><?= htmlspecialchars($m['hora_examen']) ?></td>

                                    <!-- BOTÓN INSCRIBIRSE -->
                                    <td>
                                        <form action="/sistemaautogestion/controlador/mesasdeexamendisponibles.php" method="POST">
                                            <input type="hidden" name="id_mesa" value="<?= $m['id_mesa'] ?>">
                                            <input type="hidden" name="cod_materia" value="<?= $m['cod_materia'] ?>">
                                            <input type="hidden" name="docente_titular" value="<?= $m['docente_titular'] ?>">
                                            <input type="hidden" name="id_comision" value="<?= $m['id_comision'] ?>">
                                            <input type="hidden" name="fecha_mesa" value="<?= $m['fecha_mesa'] ?>">
                                            <input type="hidden" name="hora_examen" value="<?= $m['hora_examen'] ?>">
                                            <input type="hidden" name="id_carrera" value="<?= $id_carrera_seleccionada ?? '' ?>">

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Inscribirse
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted">No hay mesas para comisión A.</p>
                    <?php endif; ?>
                </div>

                <!-- TAB B -->
                <div class="tab-pane fade" id="comB">

                    <?php if (!empty($mesas_comision_b)): ?>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Materia</th>
                                    <th>Comisión</th>
                                    <th>Docente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($mesas_comision_b as $m): ?>
                                <tr>
                                    <td><?= htmlspecialchars($m['nombre_materia']) ?></td>
                                    <td><?= htmlspecialchars($m['comision']) ?></td>
                                    <td><?= htmlspecialchars($m['nombre'] . ' ' . $m['apellido']) ?></td>
                                    <td><?= htmlspecialchars($m['fecha_mesa']) ?></td>
                                    <td><?= htmlspecialchars($m['hora_examen']) ?></td>
                                    <!--BOTON INSCRIBIRSE-->
                                    <td>
                                        <form action="/sistemaautogestion/controlador/mesasdeexamendisponibles.php" method="POST">
                                            <input type="hidden" name="id_mesa" value="<?= $m['id_mesa'] ?>">
                                            <input type="hidden" name="cod_materia" value="<?= $m['cod_materia'] ?>">
                                            <input type="hidden" name="id_comision" value="<?= $m['id_comision'] ?>">
                                            <input type="hidden" name="docente_titular" value="<?= $m['docente_titular'] ?>">
                                            <input type="hidden" name="fecha_mesa" value="<?= $m['fecha_mesa'] ?>">
                                            <input type="hidden" name="hora_examen" value="<?= $m['hora_examen'] ?>">
                                            <input type="hidden" name="id_carrera" value="<?= $id_carrera_seleccionada ?? '' ?>">

                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Inscribirse
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted">No hay mesas para comisión B.</p>
                    <?php endif; ?>
                </div>

            </div>

        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="alert alert-warning">
                No se encontraron mesas de examen para los filtros seleccionados.
            </div>
        <?php endif; ?>
        
        <!-- MIS INSCRIPCIONES A MESAS -->
        <hr class="my-5">

        <h2 class="mb-4">Mis inscripciones</h2>

        <!-- La variable $mis_inscripciones debe ser provista por el controlador -->
        <?php if (!empty($mis_inscripciones)): ?>
            <p class="text-muted">Mostrando mis inscripciones a mesas en el periodo actual.</p>
            
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th>Materia</th>
                <th>Fecha Examen</th>
                <th>Hora Examen</th>
                <th>Condición</th>
                <th>Acción</th> </tr>
        </thead>
        <tbody>
            <?php foreach ($mis_inscripciones as $inscripcion): ?>
                <tr>
                    <td><?= htmlspecialchars($inscripcion['nombre_materia']) ?></td>
                    <td><?= htmlspecialchars($inscripcion['fecha_mesa']) ?></td>
                    <td><?= htmlspecialchars($inscripcion['hora_examen']) ?></td>
                    <td>
                        <span class="badge 
                            <?php 
                                $condicion = strtolower($inscripcion['condicion']);
                                if ($condicion == 'promocion' || $condicion == 'aprobado') {
                                    echo 'bg-success';
                                } elseif ($condicion == 'regular') {
                                    echo 'bg-info text-dark';
                                } else {
                                    echo 'bg-secondary';
                                }
                            ?>">
                            <?= htmlspecialchars(ucfirst($inscripcion['condicion'])) ?>
                        </span>
                    </td>
                    
                    <td>
                        <form method="POST">
                            <input type="hidden" name="accion" value="cancelar_inscripcion">
                            <input type="hidden" name="id_mesa_a_cancelar" value="<?= htmlspecialchars($inscripcion['id_mesa']) ?>">
                            
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Está seguro que desea CANCELAR la inscripción a esta mesa de examen?');">
                                Cancelar
                            </button>
                        </form>
                    </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Aún no te has inscripto a ninguna mesa de examen para el período actual. ¡Revisa las mesas disponibles arriba!
            </div>
        <?php endif; ?>


    </main>

    <?php include __DIR__ . '/../footer.php'; ?>
    <script src="/sistemaautogestion/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>