<?php
// Primero cargamos la librería que descargamos con Composer
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Inicializamos la lectura del archivo .env
// El '../' le dice que busque el archivo .env una carpeta hacia atrás de donde está este archivo
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Ahora definimos las constantes usando las variables de entorno
define('SERVER', $_ENV['DB_HOST']);
define('USER', $_ENV['DB_USER']);
define('PASS', $_ENV['DB_PASS']);
define('DATABASE', $_ENV['DB_NAME']);
define('PORT', $_ENV['DB_PORT']);

function obtenerconexion()
{
    // Tu lógica de conexión se mantiene igual, pero ahora es más segura
    $conn = mysqli_connect(SERVER, USER, PASS, DATABASE, PORT);
    
    if ($conn->connect_error) {
        die("Error al conectarse a la base de datos: " . $conn->connect_error);
    }
    
    return $conn;
}
?>