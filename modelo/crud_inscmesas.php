<?php
include_once 'conexion.php';
function inscribiralumnoamesadeexamen($idcarrera, $idalumno, $codmateria, $iddocente, $idcomision, $idmesa, $fechainsc, $condicionmesa)
{
    $conexionbd = obtenerconexion();

    $sql = "INSERT INTO inscripciones_mesas (id_carrera, dni, cod_materia, id_docente, id_comision, id_mesa, fecha_ins, condicion) VALUES ('$idcarrera', '$idalumno', '$codmateria', '$iddocente', '$idcomision', '$idmesa', '$fechainsc', '$condicionmesa')";

    $resultado = mysqli_query($conexionbd, $sql);

    return $resultado; 
}
function obtenerinscripcionesamesaporalumno($idalumno, $idmesa)
{
    $conexionbd = obtenerconexion();
    
    // 2. Incluir comillas simples en el SQL
    $sql = "SELECT * FROM inscripciones_mesas WHERE id_mesa = $idmesa AND dni = $idalumno";

    $resultado = mysqli_query($conexionbd, $sql);
    
    // 3. Devolver un valor que indique si se encontró alguna fila (si ya está inscrito)
    if ($resultado) {
        // mysqli_num_rows() cuenta las filas encontradas. Si es > 0, ya está inscrito.
        return mysqli_num_rows($resultado) > 0;
    }
    
    // Si hubo un error en la consulta
    return false;
}
function obtenerinscripcionesamesasdelperiodoactualporalumno($idalumno)
{
    $conexionbd = obtenerconexion();
    
    // 1. Definimos el inicio del periodo de visualización como HOY
    $fecha_inicio = date('Y-m-d'); // Corregido: ya no es 30 días antes

    // 2. Obtener la última fecha de mesa de examen cargada en el sistema (GLOBAL)
    // Esto define el límite superior del período de examen.
    $sql_max = "SELECT MAX(fecha_mesa) AS ultima_fecha FROM mesas_examen"; // Corregido: busca en TODAS las mesas
    $res_max = mysqli_query($conexionbd, $sql_max);
    $row_max = mysqli_fetch_assoc($res_max);
    
    // Usamos la fecha máxima si existe, sino, usamos la fecha de inicio (hoy)
    $fecha_fin = $row_max['ultima_fecha'] ?? $fecha_inicio;

    // Consulta principal
    $sql = "SELECT 
                im.id_mesa,
                im.cod_materia, 
                m.nombre_materia, 
                im.fecha_ins, 
                im.condicion,
                mde.fecha_mesa,
                mde.hora_examen
            FROM inscripciones_mesas im
            INNER JOIN materias m ON im.cod_materia = m.cod_materia
            INNER JOIN mesas_examen mde ON im.id_mesa = mde.id_mesa
            WHERE im.dni = '$idalumno'
              -- FILTRO CLAVE: Solo las inscripciones a mesas que ocurren entre HOY y la fecha máxima cargada.
              AND mde.fecha_mesa BETWEEN '$fecha_inicio' AND '$fecha_fin'
            ORDER BY mde.fecha_mesa ASC";

    $resultado = mysqli_query($conexionbd, $sql);

    $mesasinsc = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $mesasinsc[] = $fila;
    }
    return $mesasinsc;
}
function obtenerotrasinscripcionesactivaspormateriacomision($dni, $codmateria, $idcomision, $idmesa_a_excluir)
{
    $conexionbd = obtenerconexion();
    $fecha_inicio = date('Y-m-d'); // Inicio: Hoy
    
    // Obtener la fecha máxima cargada en el sistema (Global)
    $sql_max = "SELECT MAX(fecha_mesa) AS ultima_fecha FROM mesas_examen";
    $res_max = mysqli_query($conexionbd, $sql_max);
    $row_max = mysqli_fetch_assoc($res_max);
    $fecha_fin = $row_max['ultima_fecha'] ?? $fecha_inicio; // Límite: Máxima fecha cargada o hoy

    // La consulta busca otras inscripciones del alumno para la misma materia/comisión 
    // dentro del período actual, excluyendo la mesa que se intenta inscribir.
    $sql = "SELECT 
                im.id_mesa, 
                me.fecha_mesa
            FROM 
                inscripciones_mesas im
            INNER JOIN 
                mesas_examen me ON im.id_mesa = me.id_mesa
            WHERE 
                im.dni = '$dni' AND 
                im.cod_materia = '$codmateria' AND 
                im.id_comision = '$idcomision' AND 
                im.id_mesa != '$idmesa_a_excluir' AND
                me.fecha_mesa BETWEEN '$fecha_inicio' AND '$fecha_fin'"; 
                    
    $resultado = mysqli_query($conexionbd, $sql);
    $inscripciones_encontradas = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $inscripciones_encontradas[] = $fila;
    }
    return $inscripciones_encontradas;
}
function eliminarinscripcionactiva($idalumno, $idmesa)
{
    $conexionbd = obtenerconexion();

    $sql = "DELETE FROM inscripciones_mesas WHERE dni = $idalumno AND id_mesa = $idmesa";
    if(mysqli_query($conexionbd,$sql))
    {
        return true;
    }
    return false;
}
?>