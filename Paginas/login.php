<?php
// login.php
session_start(); // Iniciar sesión de PHP para guardar los datos del usuario logueado

require 'conexion.php'; // Usamos la misma conexión de antes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recibir datos del formulario
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // 2. Buscar al usuario por su correo
    // Nota: Usamos los nombres de columna de tu tabla: 'correo' y 'contraseña'
    $sql = "SELECT ID_usuario, nombre, contraseña FROM usuarios WHERE correo = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // 3. Verificar si existe el usuario
    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        // 4. Verificar la contraseña encriptada
        if (password_verify($password, $usuario['contraseña'])) {
            
            // ¡LOGIN EXITOSO!
            // Guardamos variables de sesión para usarlas en otras páginas
            $_SESSION['ID_usuario'] = $usuario['ID_usuario'];
            $_SESSION['nombre'] = $usuario['nombre'];

            // Redirigir a la página principal (Crea un index.php o home.html luego)
            header("Location: inicio.php"); 
            exit();

        } else {
            // Contraseña incorrecta
            echo "<script>alert('Contraseña incorrecta.'); window.location.href='Iniciar_sesion.php';</script>";
        }
    } else {
        // Correo no encontrado
        echo "<script>alert('No existe una cuenta con este correo.'); window.location.href='Iniciar_sesion.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>