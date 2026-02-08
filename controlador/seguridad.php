<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /sistemaautogestion/controlador/iniciarsesion.php');
    exit();
}
?>
