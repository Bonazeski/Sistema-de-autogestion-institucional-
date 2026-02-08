<?php
session_start();

// 0) CONTROL DE SESIÓN
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistemaautogestion/controlador/iniciarsesion.php');
    exit();
}

// MODELOS
require_once __DIR__ . '/../modelo/crud_carreras.php';
require_once __DIR__ . '/../modelo/crud_materias.php';
require_once __DIR__ . '/../modelo/crud_docentes.php';
require_once __DIR__ . '/../modelo/crud_mesasdeexamen.php';

//inicializar variables
$carreras = obtenercarreras();

$materias = [];
$docentes_materia = [];
$docentes_unicos = []; // Lista de todos los docentes de la materia
$docentes_vocales = []; // Lista de docentes que excluye al titular

$id_carrera = null;
$anio = null;
$periodo = null;
$cod_materia = null;

$docente_titular_id = null; 

$fecha_examen = date("Y-m-d");
$hora_examen = "15:30";
$mensaje_estado = "";

// --------------------------------------------------------------------
// 2) PROCESO POST Y REDIRECCIÓN PRG
// --------------------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id_carrera = $_POST['id_carrera'] ?? null;
    $anio = $_POST['anio_cursada'] ?? null;
    $periodo = $_POST['periodo_cursada'] ?? null;
    $cod_materia = $_POST['cod_materia'] ?? null;
    $docente_titular_id = $_POST['docente_titular'] ?? null; 

    $fecha_examen = $_POST['fecha_examen'] ?? date("Y-m-d");
    $hora_examen = $_POST['hora_examen'] ?? "15:30";

    // ACCIÓN REGISTRAR
    if (isset($_POST['accion']) && $_POST['accion'] === "registrar") {

        $titular = $docente_titular_id;
        $v1 = $_POST['primer_vocal'] ?? null;
        $v2 = $_POST['segundo_vocal'] ?? null;

        if (!$id_carrera || !$anio || !$periodo || !$cod_materia || !$titular || !$v1 || !$v2) {
            $mensaje_estado = "Error: faltan datos obligatorios.";
        } else {

            // OBTENER TODAS LAS COMISIONES EN LAS QUE SE DICTA LA MATERIA
            $docentes_materia = obtenerdocentespormateria($cod_materia);

            if (empty($docentes_materia)) {
                $mensaje_estado = "Error: la materia no tiene comisiones asignadas.";
            } else {
                $ok_total = true;
                
                // Se registra una mesa por CADA comisión que dicta la materia
                foreach ($docentes_materia as $fila) {

                    $id_comision = $fila['id_comision'];

                    $ok = insertarmesadeexamen(
                        $fecha_examen,
                        $hora_examen,
                        $titular,
                        $cod_materia,
                        $id_comision,
                        $v1,
                        $v2
                    );

                    if (!$ok) $ok_total = false;
                }

                if ($ok_total) {
                    $mensaje_estado = "Mesa(s) registradas correctamente.";
                    // Guardamos el mensaje en la sesión para que sobreviva a la redirección
                    $_SESSION['mensaje_estado'] = $mensaje_estado; 
                    
                    // Redirección PRG después del éxito
                    header("Location: cargarmesas.php"); 
                    exit();
                } else {
                    $mensaje_estado = "Error al registrar una o más mesas.";
                }
            }
        }
    }
}
// --------------------------------------------------------------------
// 2.1) RECUPERAR MENSAJE DESPUÉS DE REDIRECCIÓN (PRG - GET)
// --------------------------------------------------------------------
if (isset($_SESSION['mensaje_estado'])) {
    // Si existe, lo cargamos en la variable local y lo borramos de la sesión
    $mensaje_estado = $_SESSION['mensaje_estado'];
    unset($_SESSION['mensaje_estado']);
}

// 3) CARGA PROGRESIVA DE SELECTS

if ($id_carrera && $anio) {
    $materias = obtenermateriasfiltradas($id_carrera, $anio, $periodo);
}

if ($cod_materia) {
    // Necesitamos la lista de docentes únicos asociados a la materia para el SELECT de titular.
    $docentes_materia = obtenerdocentespormateria($cod_materia);

    // Armar lista de docentes únicos 
    foreach ($docentes_materia as $fila) {
        $id_doc = $fila['id_docente'];

        if (!isset($docentes_unicos[$id_doc])) {
            $docentes_unicos[$id_doc] = [
                "id_docente" => $id_doc,
                "apellido"   => $fila['apellido'],
                "nombre"     => $fila['nombre'],
            ];
        }
    }

    $docentes_unicos = array_values($docentes_unicos);


    // OBTENER VOCALES: Utilizamos su función del CRUD
    if ($docente_titular_id) {
        $docentes_vocales = obtenerdocentesvocales($docente_titular_id);
    } else {
        $docentes_vocales = []; 
    }
}

// --------------------------------------------------------------------
// 4) CARGAR VISTA
// --------------------------------------------------------------------
include __DIR__ . '/../vista/inicioadm/registrar/mesadeexamen/index.php';
?>