<?php
session_start();

include '../modelo/crud_usuarios.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = isset($_POST['user']) ? trim($_POST['user']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($user) || empty($pass)) {
        $error = "Por favor, complete todos los campos.";
        include __DIR__ . '/../vista/iniciarsesion/index.php';
        exit();
    }

    $datos_usuario = obtenerdatosusuario($user);

    if ($datos_usuario && isset($datos_usuario['contrasenia']) && password_verify($pass, $datos_usuario['contrasenia'])) {

        $_SESSION['usuario_id'] = $datos_usuario['id_user'];
        $_SESSION['usuario_nombre'] = $datos_usuario['usuario'];
        $_SESSION['usuario_rol'] = $datos_usuario['id_rol'];

        if ($datos_usuario['id_rol'] == 1) {
            header('Location: /sistemaautogestion/vista/inicioalumnado/index.php');
            exit();
        } 
        elseif ($datos_usuario['id_rol'] == 2) {
            header('Location: /sistemaautogestion/vista/inicioadm/index.php');
            exit();
        } 
        else {
            $error = "Rol de usuario no reconocido.";
            include __DIR__ . '/../vista/iniciarsesion/index.php';
            exit();
        }
    } 
    else {
        $error = "Usuario o contraseña incorrectos.";
        include __DIR__ . '/../vista/iniciarsesion/index.php';
        exit();
    }
}

// Si no es POST, muestra el formulario

include __DIR__ . '/../vista/iniciarsesion/index.php';
?>