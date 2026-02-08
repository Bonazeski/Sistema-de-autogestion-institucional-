<?php
include_once 'conexion.php';
function obtenercorrelatividadespormateria($codmateria, $para)
{
    $conexionbd = obtenerconexion();

    $sql = "SELECT haber, materia_requerida, para FROM correralatividades
        WHERE cod_materia = '$codmateria' and para = '$para'";

    $resultado = mysqli_query($conexionbd, $sql);

    $correlatividades = [];

    while ($fila = mysqli_fetch_assoc($resultado)){
        $correlatividades[] = $fila;
    }
    return $correlatividades;
}
?>