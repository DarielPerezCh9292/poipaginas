<?php
// enviar_mensaje.php
session_start();
require 'conexion.php';

// Validar que existan los datos necesarios
if (!isset($_POST['id_chat']) || !isset($_POST['mensaje']) || !isset($_SESSION['ID_usuario'])) {
    echo "Error: Datos incompletos";
    exit;
}

$id_chat = $_POST['id_chat'];
$mensaje = trim($_POST['mensaje']); // Quitamos espacios vacíos al inicio/final
$id_usuario = $_SESSION['ID_usuario'];

// Validar que el mensaje no esté vacío
if (empty($mensaje)) {
    echo "Error: Mensaje vacío";
    exit;
}

// Insertar el mensaje
$sql = "INSERT INTO mensaje (mensaje, fecha_creacion, fk_usuario, fk_chat) VALUES (?, NOW(), ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sii", $mensaje, $id_usuario, $id_chat);
    
    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "Error al guardar: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Error en consulta: " . $conn->error;
}

$conn->close();
?>