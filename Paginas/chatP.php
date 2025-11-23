<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Personal</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
  --bg-black: #121212;
  --dark-gray: #1e1e1e;
  --gray: #2d2d2d;
  --blue: #3399ff;
  --green: #00cc66;
  --text-primary: #e0e0e0;
  --text-secondary: #a0a0a0;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: var(--bg-black);
  color: var(--text-primary);
}

.container {
  display: flex;
  height: 100vh;
  max-width: 1400px;
  margin: 0 auto;
}

/* Sidebar - Contactos */
.sidebar-left {
  width: 300px;
  background-color: var(--dark-gray);
  border-right: 1px solid var(--gray);
  display: flex;
  flex-direction: column;
}

.search-container {
  padding: 15px;
  background-color: var(--gray);
}

.search-container input {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: var(--bg-black);
  color: var(--text-primary);
}

.chats-container {
  flex: 1;
  overflow-y: auto;
  padding: 15px;
}

.chats-container h3 {
  color: var(--blue);
  margin-bottom: 10px;
  font-size: 1rem;
}

.chat-item {
  display: flex;
  align-items: center;
  padding: 10px;
  border-radius: 6px;
  transition: background-color 0.2s;
  cursor: pointer;
  margin-bottom: 10px;
}

.chat-item:hover {
  background-color: var(--gray);
}

.chat-item.active {
  background-color: var(--blue);
}

.chat-item img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.chat-info {
  flex: 1;
}

.chat-name {
  font-weight: bold;
  font-size: 0.95rem;
}

.chat-preview {
  font-size: 0.8rem;
  color: var(--text-secondary);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.chat-time {
  font-size: 0.7rem;
  color: var(--text-secondary);
}

/* Área de chat */
.main-chat {
  flex: 1;
  display: flex;
  flex-direction: column;
  background-color: var(--dark-gray);
}

/* Encabezado del chat */
.chat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  background-color: var(--gray);
  border-bottom: 1px solid var(--dark-gray);
}

.chat-header-info {
  display: flex;
  align-items: center;
}

.chat-header-info img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  margin-right: 10px;
}

.chat-header-info h2 {
  font-size: 1.1rem;
  margin-bottom: 3px;
}

.chat-header-info p {
  font-size: 0.8rem;
  color: var(--text-secondary);
}

.call-options {
  display: flex;
  gap: 10px;
}

.call-btn {
  background-color: var(--green);
  color: white;
  border: none;
  padding: 8px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.call-btn:hover {
  background-color: #00b359;
}

/* Mensajes */
.chat-content {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.message {
  max-width: 70%;
  padding: 10px 15px;
  border-radius: 10px;
  position: relative;
}

.message.received {
  background-color: var(--gray);
  align-self: flex-start;
}

.message.sent {
  background-color: var(--blue);
  align-self: flex-end;
  color: white;
}

.message-sender {
  font-weight: bold;
  font-size: 0.85rem;
  margin-bottom: 4px;
  color: var(--blue);
}

.message-time {
  font-size: 0.7rem;
  text-align: right;
  color: var(--text-secondary);
  margin-top: 4px;
}

/* Input */
.chat-input {
  display: flex;
  padding: 15px;
  background-color: var(--gray);
  border-top: 1px solid var(--dark-gray);
}

.chat-input input {
  flex: 1;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color: var(--bg-black);
  color: var(--text-primary);
  margin-right: 10px;
}

.send-btn {
  background-color: var(--blue);
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 5px;
  cursor: pointer;
}

</style>

</head>
<body>
  <div class="container">
    <!-- Sidebar izquierdo - Contactos -->
    <div class="sidebar-left">
      <div class="search-container">
        <input type="text" placeholder="Buscar contactos...">
      </div>
      <div class="chats-container">
        <h3>Contactos</h3>
        <div class="chat-item active">
          <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Leo" alt="Leo">
          <div class="chat-info">
            <div class="chat-name">Leo Messi</div>
            <div class="chat-preview">¿Viste el partido?</div>
          </div>
          <div class="chat-time">10:45</div>
        </div>
        <div class="chat-item">
          <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Maria" alt="María">
          <div class="chat-info">
            <div class="chat-name">María Gómez</div>
            <div class="chat-preview">Nos vemos luego :3</div>
          </div>
          <div class="chat-time">09:20</div>
        </div>
  
      </div>
    </div>

    <!-- area principal del chat -->
    <div class="main-chat">
      <div class="chat-header">
        <div class="chat-header-info">
          <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Leo" alt="Leo">
          <div>
            <h2>Leo Messi</h2>
            <p>En línea</p>
          </div>
        </div>
        <div class="call-options">
          <button class="call-btn"><i class="fas fa-phone"></i></button>
          <button class="call-btn"><i class="fas fa-video"></i></button>
        </div>
      </div>

      <!-- Contenido del chat -->
      <div class="chat-content">
        <div class="message received">
          <div class="message-sender">Leo Messi</div>
          <div>¿Viste el partido de ayer?</div>
          <div class="message-time">10:30</div>
        </div>
        <div class="message sent">
          <div>Sí, estuvo increíble. Ese gol final 🔥</div>
          <div class="message-time">10:32</div>
        </div>
      </div>

      <!-- Input del chat -->
      <div class="chat-input">
        <input type="text" placeholder="Escribe un mensaje...">
        <button class="send-btn"><i class="fas fa-paper-plane"></i></button>
      </div>
    </div>
  </div>
</body>
</html>
