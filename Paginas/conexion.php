<?php
// conexion.php

$host = "localhost";
$usuario = "root";      // Cambia si tu usuario es diferente
$clave = "";            // Tu contraseña de BD
$bd = "poipaginas";    // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($host, $usuario, $clave, $bd);

// Verificar si hubo error
if ($conn->connect_error) {
    die("Fallo la conexión: " . $conn->connect_error);
}

// Opcional: Configurar codificación de caracteres a UTF-8
$conn->set_charset("utf8");
?>