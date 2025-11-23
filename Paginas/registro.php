<?php
// registro.php

// 1. Llamamos al archivo de conexión
require 'conexion.php';

// 2. Verificamos que el formulario se haya enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- RECIBIR DATOS DEL HTML ---
    // Nota: Los nombres dentro de $_POST['...'] deben coincidir con los name="..." de tu HTML
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $fecha = $_POST['fecha_nacimiento']; 
    $email = $conn->real_escape_string($_POST['email']); 
    $pass  = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // --- VALIDACIONES ---
    if ($pass !== $confirm_pass) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Encriptar contraseña antes de guardarla (Seguridad básica)
    $pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);

    // --- MANEJO DE LA IMAGEN ---
    $ruta_imagen = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $directorio = "uploads/";
        
        // Crear la carpeta si no existe
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        // Generar nombre único para evitar sobrescribir imágenes
        $nombre_archivo = uniqid() . "_" . basename($_FILES["foto"]["name"]);
        $ruta_destino = $directorio . $nombre_archivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino)) {
            $ruta_imagen = $ruta_destino;
        }
    }

    // --- INSERTAR EN LA BASE DE DATOS ---
    // Aquí usamos TUS nombres de columnas exactos:
    // nombre, correo, contraseña, imagen_perfil, fecha_nacimiento
    
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, imagen_perfil, fecha_nacimiento) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    // "sssss" significa que enviamos 5 Strings (cadenas de texto)
    $stmt->bind_param("sssss", $nombre, $email, $pass_encriptada, $ruta_imagen, $fecha);

    if ($stmt->execute()) {
        echo "<script>
                alert('Usuario registrado correctamente en la base de datos.'); 
                window.location.href='Iniciar_sesion.php';
              </script>";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    // Cerrar conexiones
    $stmt->close();
    $conn->close();
}
?>