<?php
// listar_chats.php

// Inicia la sesión para obtener el ID del usuario
session_start(); 

// Incluye el archivo de conexión
require 'conexion.php'; 

// --- 1. Obtener el ID del Usuario Actual ---
// Asegúrate de que esta variable de sesión esté definida tras un login exitoso.
if (!isset($_SESSION['ID_usuario'])) {
    die("Error: El usuario no ha iniciado sesión.");
}
$usuario_actual_id = $_SESSION['ID_usuario']; 

// --- 2. Preparar y Ejecutar el Procedimiento Almacenado ---
// La sintaxis para llamar un procedimiento es: CALL NombreProcedimiento(?)
$sql = "CALL ObtenerListaChats(?)";

if ($stmt = $conn->prepare($sql)) {
    
    // Bindear el parámetro: "i" indica que el parámetro es un Integer (entero)
    $stmt->bind_param("i", $usuario_actual_id); 
    
    // Ejecutar la llamada al procedimiento
    $stmt->execute();
    
    // Obtener los resultados del procedimiento
    $resultado = $stmt->get_result();

    // --- 3. Mostrar los Resultados ---
    if ($resultado->num_rows > 0) {
        echo "<h2>Chats Activos</h2>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "
                <div style='border: 1px solid #000000ff; padding: 10px; margin-bottom: 10px; background-color: #ffffffff;'>
                    <h4>Conversación con: <strong>" . htmlspecialchars($fila['nombre_destinatario']) . "</strong></h4>
                    <p>Último mensaje: <em>" . htmlspecialchars($fila['ultimo_mensaje']) . "</em></p>
                    <small>Fecha: " . $fila['fecha_ultimo_mensaje'] . "</small>
                    <p><small>ID Chat: " . $fila['fk_chat'] . "</small></p>
                </div>
            ";
        }
    } else {
        echo "<p>No tienes conversaciones activas en este momento.</p>";
    }

    $stmt->close();
} else {
    echo "Error al preparar la llamada al procedimiento: " . $conn->error;
}

$conn->close();
?>