<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistemaautogestion/controlador/iniciarsesion.php');
    exit();
}

require_once __DIR__ . '/../modelo/crud_alumnos.php';
require_once __DIR__ . '/../modelo/crud_insccarreras.php';
require_once __DIR__ . '/../modelo/crud_materias.php';
require_once __DIR__ . '/../modelo/crud_mesasdeexamen.php';

require_once __DIR__ . '/../modelo/crud_inscmaterias.php';
require_once __DIR__ . '/../modelo/crud_correlatividades.php';
require_once __DIR__ . '/../modelo/crud_notasalumnos.php';
require_once __DIR__ . '/../modelo/crud_inscmesas.php';


$idusuario = $_SESSION['usuario_id'];

// obtener datos del alumno
$alumno = obteneralumnoporusuario($idusuario);

$dni = $alumno['dni']; 

// carreras del alumno
$carreras_inscriptas = obtenernombredecarrerainsc($dni);

$materias = [];
$materiasporcomision = [];
$mesasdeexamen = [];

// Inicializaciones
$id_carrera_seleccionada = null; 
$anio_seleccionado = null; 
$mensaje = null;
$mis_inscripciones = []; // Inicialización agregada para evitar errores en la vista


//para visualizar las mesas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Si se envió el formulario de filtro (id_carrera y anio), se ejecutan los filtros
    if (isset($_POST['id_carrera']) && isset($_POST['anio'])) {
        $id_carrera_seleccionada = $_POST['id_carrera'] ?? null;
        $anio_seleccionado = $_POST['anio'] ?? null;
        
        // Guardamos las variables para que persistan en la vista
        $_SESSION['id_carrera_seleccionada'] = $id_carrera_seleccionada;
        $_SESSION['anio_seleccionado'] = $anio_seleccionado;
    } else {
        // Si no se usó el filtro en este POST, intentamos recuperar el filtro de la sesión
        $id_carrera_seleccionada = $_SESSION['id_carrera_seleccionada'] ?? null;
        $anio_seleccionado = $_SESSION['anio_seleccionado'] ?? null;
    }
    
    // Lógica para obtener las mesas (se ejecuta si se filtró o si la inscripción falló y queremos recargar la tabla)
    if (!empty($id_carrera_seleccionada) && !empty($anio_seleccionado)) {
        // 1) Obtener materias
        $materias = obtenermateriasporcarrera($id_carrera_seleccionada, $anio_seleccionado);

        $materiasporcomision = [];
        $mesasdeexamen = [];

        foreach ($materias as $materia) {
            // 2) Obtener comisiones de cada materia
            $comisiones = obtenermateriasporcomision($materia['cod_materia']);

            $materiasporcomision[$materia['cod_materia']] = $comisiones;
            $mesasdeexamen[$materia['cod_materia']] = [];

            // 3) Obtener mesas por cada comisión
            foreach ($comisiones as $com) {

                $mesas = obtenermesaspormateriaporcomision(
                    $com['cod_materia'],
                    $com['id_comision'], 
                    $com['id_docente']
                );

                // guardamos todas las mesas
                $mesasdeexamen[$materia['cod_materia']] = array_merge(
                    $mesasdeexamen[$materia['cod_materia']],
                    $mesas
                );
            }
        }
    }
} else {
    // Es una petición GET (carga inicial). Intentamos usar el filtro de sesion
    $id_carrera_seleccionada = $_SESSION['id_carrera_seleccionada'] ?? null;
    $anio_seleccionado = $_SESSION['anio_seleccionado'] ?? null;
}

// --- INICIO DE LÓGICA DE CANCELACIÓN (SECCIÓN 1) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'cancelar_inscripcion') {
    
    $idmesa_a_cancelar = $_POST['id_mesa_a_cancelar'] ?? null;
    
    if ($idmesa_a_cancelar !== null) {
        
        if (eliminarinscripcionactiva($dni, $idmesa_a_cancelar)) {
            $mensaje = [
                'tipo' => 'success',
                'texto' => 'La inscripción a la mesa de examen ha sido CANCELADA correctamente.'
            ];
        } else {
            $mensaje = [
                'tipo' => 'danger',
                'texto' => 'Error al intentar cancelar la inscripción.'
            ];
        }
        // No salimos con exit(), el flujo continúa hasta recargar $mis_inscripciones y cargar la vista.
    }
}
// --- FIN DE LÓGICA DE CANCELACIÓN ---


// --- INICIO DE LÓGICA DE INSCRIPCIÓN (SECCIÓN 2) ---

// Inicializar variables de inscripción (CONSERVADA)
$idmesa = $_POST['id_mesa'] ?? null;
$codmateria = $_POST['cod_materia'] ?? null;
$idcomision = $_POST['id_comision'] ?? null;
$iddocente = $_POST['docente_titular'] ?? null;
$fechamesa = $_POST['fecha_mesa'] ?? null;
$horaexamen = $_POST['hora_examen'] ?? null;

// Solo ejecutamos toda la lógica de inscripción si tenemos el ID de la mesa
if ($idmesa !== null) {
    
    // Se toma el id_carrera enviado por el formulario de inscripción
    $id_carrera_para_inscripcion = $_POST['id_carrera'] ?? null; 
    
    $materiasinsc = obtenermateriasinscporalumno($dni, $id_carrera_para_inscripcion); 

    $estainscriptoalamesa = obtenerinscripcionesamesaporalumno($dni, $idmesa);

    if($estainscriptoalamesa)
    {
        $mensaje = [
            'tipo' => 'danger',
            'texto' => 'YA estás inscripto en esta mesa muchache.'
        ];

    }
    
    // ----------------------------------------------------------------------
    // --- LÓGICA DE VALIDACIÓN DE LLAMADO/FECHA (NUEVO) ---
    // ----------------------------------------------------------------------
    if (empty($mensaje)) { 
        // 1. Buscamos si ya está inscripto a OTRA mesa del mismo periodo/materia/comisión
        $inscripciones_activas = obtenerotrasinscripcionesactivaspormateriacomision(
            $dni, 
            $codmateria, 
            $idcomision, 
            $idmesa // Excluimos la mesa actual
        );

        if (!empty($inscripciones_activas)) {
            
            $inscripcion_previa = $inscripciones_activas[0]; 
            $fecha_previa = $inscripcion_previa['fecha_mesa']; // Fecha de la mesa ya inscripta
            $fecha_solicitada = $fechamesa;                   // Fecha de la mesa que quiere inscribir
            
            // Comparamos las fechas para aplicar la lógica de orden cronológico
            if ($fecha_previa < $fecha_solicitada) {
                // Ya inscripto en el primer llamado (fecha anterior)
                $mensaje = [
                    'tipo' => 'danger',
                    'texto' => 'Ya tienes una inscripción activa para el primer llamado (Fecha: ' . $fecha_previa . '). No puedes inscribirte al segundo llamado hasta que el primero haya pasado.'
                ];
            } elseif ($fecha_previa > $fecha_solicitada) {
                // Ya inscripto en el segundo llamado (fecha posterior)
                $mensaje = [
                    'tipo' => 'danger',
                    'texto' => 'Ya tienes una inscripción activa para el segundo llamado (Fecha: ' . $fecha_previa . '). Debes cancelar esa inscripción antes de poder inscribirte al primer llamado.'
                ];
            }
        }
    }
    // ----------------------------------------------------------------------
    // --- FIN DE LA LÓGICA DE VALIDACIÓN DE LLAMADO/FECHA ---
    // ----------------------------------------------------------------------

    //si no esta inscripto a esa materia ni en esa comision...
    //banderas

    $estainscriptoalamateria = false; 
    $estaenlamismacomision = false;

    foreach ($materiasinsc as $mi) //recorremos las materias a las que está insc
    {
        // está inscripto a la materia?
        if ($mi['cod_materia'] == $codmateria) {
            $estainscriptoalamateria = true;

            // ¿Coincide la comisión?
            if ($mi['id_comision'] == $idcomision) {
                $estaenlamismacomision = true;
            }
        }
    }

    if (!$estainscriptoalamateria) {
        $mensaje = [
            'tipo' => 'danger',
            'texto' => 'No estás inscripto en esta materia.'
        ];
    }

    if ($estainscriptoalamateria && !$estaenlamismacomision) {
        $mensaje = [
            'tipo' => 'danger',
            'texto' => 'Estás inscripto en la materia, pero NO en esta comisión.'
        ];
    }
    
    // Si la validación de inscripción/comisión falló, no continuamos con correlatividades
    if (empty($mensaje)) {
        //si está isncripto en la materia y la comision que se solicito la insc a la mesa...

        //se analiza la tabla correlatividades qué codigos de materia se anteponen a la mesa solicitada y bajo qué condicion... se guardan esos datos para despues... 

        $para = "rendir";

        $correlatividades = obtenercorrelatividadespormateria($codmateria, $para);

        //funcion para equilibrar el formato de condiciones en las notas de los alumnos con las de correlatividades jeje
        function normalizarcondicion($condicion) {
            $condicion = trim($condicion);

            // Alumno → equivalencias
            if ($condicion === 'regular') return 'regular';
            if ($condicion === 'promocionado') return 'promocion';

            // Si ya coincide o no necesita traducción
            return $condicion;
        }


        //comparar las correlatividades y condiciones con las notas del alumno...
        // si la materia no tiene correlatividades → se deja rendir directamente
        if (!empty($correlatividades)) {
            
            foreach ($correlatividades as $c)
            {
                $materiarequerida = $c['materia_requerida'];
                $condicionrequerida = normalizarcondicion($c['haber']);

                $condiciondelalumno = obtenercondiciondealumnopormateria($dni, $materiarequerida);

                if(!$condiciondelalumno)
                {
                    $mensaje = [ 
                        'tipo' => 'danger',
                        'texto' => "No tienes notas cargadas para la materia $materiarequerida "
                    ];
                }

                if(empty($mensaje)) { // Solo si no hay mensaje de error previo
                    $condiciondelalumnonormalizada = normalizarcondicion($condiciondelalumno['condicion']);

                    if($condiciondelalumnonormalizada !== $condicionrequerida)
                    {
                        $mensaje = [
                            'tipo' => 'danger',
                            'texto' => "Correlatividad no cumplida: La materia $materiarequerida requiere condición $condicionrequerida"
                        ];
                    }
                }
            }
        }
        
        // Si no hay errores de validación de correlatividades, procedemos a inscribir
        if(empty($mensaje)) {
            //se carga la insc a la mesa de examen con la fecha actual. 

            $fechaactual = date('y-m-d');

            $condicionmateria = obtenercondiciondealumnopormateria($dni, $codmateria);

            if (!$condicionmateria) {
                $mensaje = [
                    'tipo' => 'danger',
                    'texto' => "Aún no tienes una condición definida para esta materia."
                ];
            }
            
            if (empty($mensaje)) {
                $condicionmesa = normalizarcondicion($condicionmateria['condicion']);

                //no debo dejar que se inscriba mas de una vez a la misma mesa de examen
                inscribiralumnoamesadeexamen($id_carrera_para_inscripcion, $dni, $codmateria, $iddocente, $idcomision, $idmesa, $fechaactual, $condicionmesa);

                $mensaje = [
                    'tipo' => 'success',
                    'texto' => 'Inscripción realizada correctamente.'
                ];
            }
        }
    }
}
// --- FIN DE LÓGICA DE INSCRIPCIÓN ---

// Recargar la lista de inscripciones para el período actual antes de cargar la vista
$mis_inscripciones = obtenerinscripcionesamesasdelperiodoactualporalumno($dni);

// Cargar la vista
include __DIR__ . '/../vista/inicioalumnado/inscmesas/index.php';
?>