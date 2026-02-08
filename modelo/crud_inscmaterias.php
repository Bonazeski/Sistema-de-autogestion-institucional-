<?php
include_once 'conexion.php';
function obtenermateriasinscporalumno($idalumno, $idcarrera)
{
    $conexionbd = obtenerconexion();
    
    // Consulta principal: última inscripción por materia
    $sql = "SELECT im.*
        FROM inscripciones_materias im
        INNER JOIN (
            SELECT cod_materia, MAX(fecha_ins) AS ultima_fecha
            FROM inscripciones_materias
            WHERE dni = '$idalumno' AND id_carrera = '$idcarrera'
            GROUP BY cod_materia
        ) ult
        ON im.cod_materia = ult.cod_materia
        AND im.fecha_ins = ult.ultima_fecha
        WHERE dni = '$idalumno' AND id_carrera = '$idcarrera'";
        
    $resultado = mysqli_query($conexionbd, $sql);

    $materiasinsc = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $materiasinsc[] = $fila;
    }
    return $materiasinsc;
}
?>