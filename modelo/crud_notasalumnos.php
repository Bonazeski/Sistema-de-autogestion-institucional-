<?php
include_once 'conexion.php';
function obtenercondiciondealumnopormateria($idalumno, $codmateria)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT na.condicion
            FROM notas_alumnos na
            INNER JOIN (
                SELECT MAX(fecha_nota) AS ultima_fecha
                FROM notas_alumnos
                WHERE dni = '$idalumno'
                  AND cod_materia = '$codmateria'
            ) ult
            ON na.fecha_nota = ult.ultima_fecha
            WHERE na.dni = '$idalumno'
              AND na.cod_materia = '$codmateria'";

    $resultado = mysqli_query($conexionbd, $sql);

    $condicion = mysqli_fetch_assoc($resultado);
    
    return $condicion;
}
?>