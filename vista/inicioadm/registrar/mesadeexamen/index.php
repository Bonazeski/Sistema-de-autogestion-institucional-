<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sistemaautogestion/vista/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <title>SAI | Registrar mesa de examen</title>
</head>

<body class="bg-light" style="display:flex; min-height:100vh; flex-direction:column;">

<?php include __DIR__ . '/../../navbar.php'; ?>

<main class="container py-5">
    <h1 class="text-center mb-5">Carga de mesas de examen</h1>

    <div class="shadow-sm p-4 p-md-5 bg-white rounded">

        <?php if (!empty($mensaje_estado)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($mensaje_estado) ?></div>
        <?php endif; ?>

        <form action="/sistemaautogestion/controlador/cargarmesas.php" method="POST" id="formMesas">
            <input type="hidden" name="accion" id="accionForm" value="filtrar">

            <div class="row g-4">

                <div class="col-md-4">
                    <label class="form-label">Carrera</label>
                    <select class="form-select" name="id_carrera" id="carrera" required>
                        <option value="">Seleccionar carrera</option>
                        <?php foreach ($carreras as $c): ?>
                            <option value="<?= $c['id_carrera'] ?>"
                                <?= ($id_carrera == $c['id_carrera']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Año</label>
                    <select class="form-select" name="anio_cursada" id="anio_cursada" required>
                        <option value="">Seleccionar año</option>
                        <?php for($i=1;$i<=3;$i++): ?>
                            <option value="<?= $i ?>" <?= ($anio==$i)?'selected':'' ?>><?= $i ?>º</option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Periodo</label>
                    <select class="form-select" name="periodo_cursada" id="periodo_cursada" required>
                        <option value="">Seleccionar periodo</option>
                        <?php $ps = ['primer cuatrimestre','segundo cuatrimestre','anual']; ?>
                        <?php foreach($ps as $p): ?>
                            <option value="<?= $p ?>" <?= ($periodo==$p)?'selected':'' ?>>
                                <?= ucfirst($p) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Materia</label>
                    <select class="form-select" name="cod_materia" id="materia" required>
                        <option value="">Seleccionar materia</option>
                        <?php foreach($materias as $m): ?>
                            <option value="<?= htmlspecialchars($m['cod_materia']) ?>"
                                <?= ($cod_materia==$m['cod_materia'])?'selected':''?>>
                                <?= htmlspecialchars($m['nombre_materia']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label">Docente titular</label>
                    <select class="form-select" name="docente_titular" id="docente_titular" required>
                        <?php if (!empty($docentes_unicos)): ?>
                            <option value="">Seleccionar</option>
                            <?php foreach ($docentes_unicos as $d): ?>
                                <option value="<?= $d['id_docente'] ?>"
                                    <?= ($docente_titular_id == $d['id_docente']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($d['apellido'] . ', ' . $d['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Seleccione materia primero</option>
                        <?php endif; ?>
                    </select>
                </div>


                <div class="col-md-6">
                    <label class="form-label">Primer vocal</label>
                    <select class="form-select" name="primer_vocal" required>
                        <?php if (!empty($docente_titular_id) && !empty($docentes_vocales)): ?>
                            <option value="">Seleccionar</option>
                            <?php foreach ($docentes_vocales as $v): ?>
                                <option value="<?= $v['id_docente'] ?>">
                                    <?= htmlspecialchars($v['apellido'] . ', ' . $v['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Seleccione titular primero</option>
                        <?php endif; ?>
                    </select>
                </div>


                <div class="col-md-6">
                    <label class="form-label">Segundo vocal</label>
                    <select class="form-select" name="segundo_vocal" required>
                        <?php if (!empty($docente_titular_id) && !empty($docentes_vocales)): ?>
                            <option value="">Seleccionar</option>
                            <?php foreach ($docentes_vocales as $v): ?>
                                <option value="<?= $v['id_docente'] ?>">
                                    <?= htmlspecialchars($v['apellido'] . ', ' . $v['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Seleccione titular primero</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha_examen" value="<?= htmlspecialchars($fecha_examen) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hora</label>
                    <input type="time" class="form-control" name="hora_examen" value="<?= htmlspecialchars($hora_examen) ?>" required>
                </div>

                <div class="col-12 d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary btn-lg" id="btnCancelar">Cancelar</button>
                    <button type="button" class="btn btn-secondary btn-lg" id="btnRegistrar">Registrar</button>
                </div>

            </div>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../../footer.php'; ?>
<script src="/sistemaautogestion/vista/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

<script>
const form = document.getElementById("formMesas");
const accion = document.getElementById("accionForm");

// Recarga de filtros (si cambian carrera, año, periodo, materia o titular)
["carrera","anio_cursada","periodo_cursada","materia","docente_titular"].forEach(id=>{
    const el = document.getElementById(id);
    if (el) el.addEventListener("change", ()=> {
        accion.value="filtrar"; 
        form.submit();
    });
});

// registro
document.getElementById("btnRegistrar").addEventListener("click", ()=>{
    accion.value="registrar";
    form.submit();
});

// cancelar
document.getElementById("btnCancelar").addEventListener("click", ()=>{
    // Muestra el cuadro de confirmación del navegador
    const confirmacion = confirm("¿Está seguro que desea cancelar el registro? Se perderán todos los datos ingresados.");

    if (confirmacion) {
        // Si el usuario confirma, redirigimos a la ruta especificada
        window.location.href="/sistemaautogestion/vista/inicioadm/index.php";
    }
    // Si el usuario CANCELA en el cuadro de diálogo, no hacemos nada. 
    // Como el formulario ya había cargado los datos del POST, estos se mantienen en los campos.
});
</script>

</body>
</html>