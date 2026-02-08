<?php
include_once 'conexion.php';
//funcion para traer los usuarios de la base de datos
function obtenerdatosusuario($usuario) {
    $concexionbd = obtenerconexion();

    // Escapar el nombre de usuario para evitar errores y SQL injection
    $usuario = mysqli_real_escape_string($concexionbd, $usuario);

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = mysqli_query($concexionbd, $sql);

    if (!$resultado) {
        // Muestra el error de SQL en desarrollo (puedes quitarlo luego)
        die("Error en la consulta SQL: " . mysqli_error($concexionbd));
    }

    $fila = mysqli_fetch_assoc($resultado);
    mysqli_close($concexionbd);
    return $fila; // devuelve una sola fila o null si no hay coincidencias
}
?>