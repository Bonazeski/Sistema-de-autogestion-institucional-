<?php
include_once 'conexion.php';

function obteneralumnoporusuario($id_usuario)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT * FROM alumnos WHERE id_user = $id_usuario";

    $resultado = mysqli_query($conexionbd, $sql);

    $alumno = mysqli_fetch_assoc($resultado);

    return $alumno;
}
?>
