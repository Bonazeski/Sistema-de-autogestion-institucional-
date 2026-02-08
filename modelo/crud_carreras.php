<?php
include_once 'conexion.php';

function obtenercarreras()
{
    $conexionbd = obtenerconexion();
    $sql = "SELECT * FROM carreras";

    $resultado = mysqli_query($conexionbd, $sql);

    $carreras = [];

    while ($fila = mysqli_fetch_assoc($resultado)) {
        $carreras[] = $fila;
    }

    return $carreras;
}
?>
