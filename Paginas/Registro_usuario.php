<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Usuario</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <style>
    :root {
      --worldcup-blue: #0066b3;
      --worldcup-green: #00cc66;
      --worldcup-red: #ff3366;
      --worldcup-white: #f0f0f0;
      --worldcup-black: #121212;
      --worldcup-dark-gray: #1e1e1e;
      --worldcup-gray: #2d2d2d;
      --worldcup-light-blue: #3399ff;
      --worldcup-text: #e0e0e0;
      --worldcup-text-secondary: #a0a0a0;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--worldcup-black);
      color: var(--worldcup-text);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      min-height: 100vh;
      padding: 2rem;
    }

    .register-container {
      background: #161515;
      padding: 2.5rem;
      border-radius: 0.625rem;
      box-shadow: 0 0.625rem 1.5625rem rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 40rem; 
      align-items: center;
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-size: 1.5rem;
      color: #ffffff;
      align-items: center;
    }

    .form-group {
      margin-bottom: 1.25rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      color: #c0bebe;
      font-size: 1rem;
    }

    /* Estilos de inputs */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"],
    input[type="date"] {
      width: 86%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 0.375rem;
      background-color: #1e1e1e;
      color: #fff;
      font-size: 1rem;
      transition: border 0.3s;
    }

    /* Estilo específico para el calendario (icono) en modo oscuro */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

   input:focus {
      border-color: var(--worldcup-light-blue);
      outline: none;
    }

    .btn-register {
      width: 95%;
      background-color: var(--worldcup-blue);
      color: white;
      padding: 0.75rem;
      border: none;
      border-radius: 0.375rem;
      cursor: pointer;
      font-size: 1rem;
      transition: 0.3s;
      align-items: center;
    }

   .btn-register:hover {
      background-color: #004d80;
    }

    .extra-options {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.875rem;
    }

    .extra-options a {
      color: var(--worldcup-light-blue);
      text-decoration: none;
    }

     .extra-options a:hover {
      text-decoration: underline;
    }

    .image-preview {
      width: 6.25rem;
      height: 6.25rem;
      border-radius: 50%;
      object-fit: cover;
      margin-top: 0.625rem;
      display: block;
      border: 2px solid var(--worldcup-light-blue);
    }

    .image-preview-wrapper {
      text-align: center;
    }

    @media (max-width: 480px) {
      html {
        font-size: 15px;
      }

      .register-container {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="register-container">
    <form action="registro.php" method="POST" enctype="multipart/form-data">
      
      <div class="form-group">
        <h1 style="align-self:center ;">Registrar cuenta</h1>
        <br>
        <label for="name">Nombre completo</label>
        <input type="text" id="name" name="nombre" placeholder="nombre" required>
      </div>
      
      <div class="form-group">
        <label for="birthdate">Fecha de nacimiento</label>
        <input type="date" id="birthdate" name="fecha_nacimiento" required>
      </div>

      <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" placeholder="" required>
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña segura" required>
      </div>

      <div class="form-group">
        <label for="confirm-password">Confirmar Contraseña</label>
        <input type="password" id="confirm-password" name="confirm_password" placeholder="Repite la contraseña" required>
      </div>

      <div class="form-group">
        <label for="profile-image">Imagen de perfil</label>
        <input type="file" id="profile-image" name="foto" accept="image/*">
        <div class="image-preview-wrapper">
          <img id="preview" class="image-preview" src="https://via.placeholder.com/100?text=+" alt="Vista previa">
        </div>
      </div>

      <button type="submit" class="btn-register">Registrarse</button>
      
      <div class="extra-options">
        <p>¿Ya tienes cuenta? <a href="Iniciar_sesion.html">Inicia sesión</a></p>
      </div>
    </form>
  </div>

  <script>
    const imageInput = document.getElementById('profile-image');
    const previewImage = document.getElementById('preview');

    imageInput.addEventListener('change', function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        previewImage.src = "https://via.placeholder.com/100?text=+";
      }
    });
  </script>

</body>
</html>