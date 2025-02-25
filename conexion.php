<?php
$host = "localhost"; // Cambia si usas otro servidor
$user = "root"; // Cambia si usas otro usuario
$pass = ""; // Agrega la contraseña si la tienes
$db = "bdskate"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($host, $user, $pass, $db);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Establecer codificación para caracteres especiales
$conn->set_charset("utf8");

?>
