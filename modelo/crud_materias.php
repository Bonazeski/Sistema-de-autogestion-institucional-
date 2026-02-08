<?php
require_once 'conexion.php';
function obtenermateriasporcarrera($id_carrera, $añocursada)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT m.cod_materia, m.nombre_materia, m.regimen_evauacion, m.anio_cursada, m.periodo
            FROM materias AS m
            INNER JOIN planes_estudio AS p 
                ON m.id_planes_estudio = p.id_planes_estudio
            WHERE p.id_carrera = $id_carrera AND m.anio_cursada = $añocursada";

    $resultado = mysqli_query($conexionbd, $sql);

    $materias = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $materias[] = $fila;
    }

    return $materias;
}
function obtenermateriasporcomision($codigomateria){

    $conexionbd = obtenerconexion();
    $sql = "SELECT cod_materia, id_docente, id_comision FROM materias_por_comision WHERE cod_materia = '$codigomateria'";

    $resultado = mysqli_query($conexionbd, $sql);

    $materiasporcomision = [];

    while ($fila = mysqli_fetch_assoc($resultado)){
        $materiasporcomision[] = $fila;
    }
    return $materiasporcomision;
}

function obtenermateriasfiltradas($idcarrera, $aniocursada, $periodocursada)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT m.cod_materia, m.nombre_materia
            FROM materias AS m
            INNER JOIN planes_estudio AS p 
                ON m.id_planes_estudio = p.id_planes_estudio
            WHERE p.id_carrera = '$idcarrera'
              AND m.anio_cursada = '$aniocursada'
              AND m.periodo = '$periodocursada'";

    $resultado = mysqli_query($conexionbd, $sql);

    $materias = [];

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $materias[] = $fila;
        }
    }

    return $materias;
}

?>
