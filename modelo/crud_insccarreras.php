<?php
require_once 'conexion.php';


function obtenernombredecarrerainsc($id_alumno)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT carreras.id_carrera, carreras.nombre FROM carreras
            JOIN inscripciones_carrera ON carreras.id_carrera = inscripciones_carrera.id_carrera
            WHERE inscripciones_carrera.dni = $id_alumno";

    $resultado = mysqli_query($conexionbd, $sql);

    $carreras = [];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $carreras[] = $fila;
    }

    return $carreras;
}
?>
