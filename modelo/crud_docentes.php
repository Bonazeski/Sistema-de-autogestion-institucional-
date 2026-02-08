<?php
include_once 'conexion.php';
function obtenerdocentesvocales($docentetitular)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT id_docente, nombre, apellido
            FROM docentes
            WHERE id_docente != $docentetitular
            ORDER BY apellido, nombre";

    $resultado = mysqli_query($conexionbd, $sql);

    $docentes_vocales = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $docentes_vocales[] = $fila;
    }

    return $docentes_vocales;
}

function obtenerdocentespormateria($codmateria)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT 
                mpc.id_docente,
                d.nombre,
                d.apellido,
                mpc.id_comision
            FROM materias_por_comision mpc
            INNER JOIN docentes d ON d.id_docente = mpc.id_docente
            WHERE mpc.cod_materia = '$codmateria'
            ORDER BY d.apellido, d.nombre";

    $resultado = mysqli_query($conexionbd, $sql);

    $docentes = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $docentes[] = $fila;
    }
    return $docentes;
}
?>