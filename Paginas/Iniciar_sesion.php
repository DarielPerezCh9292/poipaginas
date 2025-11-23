<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
 
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
        align-items: center;
        justify-content: center;
      }
      body {
            background-color: var(--worldcup-black);
            color: var(--worldcup-text);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

    .login-container {
        background: #161515;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
      }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #fdfbfb;
      }
  
      .form-group {
        margin-bottom: 20px;
      }

      
    label {
      display: block;
      margin-bottom: 8px;
      color: #c0bebe;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #041652; /* Ajusté el color para que se vea mejor en fondo oscuro */
      background-color: #1e1e1e; /* Agregado para consistencia con modo oscuro */
      color: white; /* Texto blanco */
      border-radius: 5px;
      transition: 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #2980b9;
      outline: none;
    }

    .btn-login {
      width: 100%;
      background-color: #2980b9;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.3s;
    }

    .btn-login:hover {
      background-color: #1f6391;
    }

    .extra-options {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .extra-options a {
      color: #2980b9;
      text-decoration: none;
    }

    .extra-options a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <br>
            <input type="email" id="email" name="email" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label><br>
            <input type="password" id="password" name="password" placeholder="" required>
          </div><br>
          <button type="submit" class="btn-login">Entrar</button>
          <div class="extra-options">
            <p>¿No tienes cuenta? <a href="Registro_usuario.php">Regístrate</a></p>
          </div>
        </form>

      </div>
    
</body>
</html>