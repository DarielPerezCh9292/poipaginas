<?php
// 1. INICIO DE SESIÓN Y LÓGICA DE BASE DE DATOS
session_start();
require 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_usuario'])) {
    header("Location: Iniciar_sesion.php");
    exit();
}

$id_usuario_actual = $_SESSION['ID_usuario'];
$chats_personales = [];

// 2. LLAMADA AL PROCEDIMIENTO ALMACENADO
$sql = "CALL ObtenerListaChats(?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id_usuario_actual);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    // Guardamos los datos en un array para usarlos abajo en el HTML
    while ($fila = $resultado->fetch_assoc()) {
        $chats_personales[] = $fila;
    }
    $stmt->close();
    
    // Limpieza de conexión
    while ($conn->more_results() && $conn->next_result());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Mundial 2026</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="inicio_style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar-left">
            <div class="search-container">
                <input type="text" placeholder="Buscar chats...">
            </div>
            <div class="chats-container">
                  <div class="chats-section">
                    <h3>Chats Grupales</h3>

                    <?php if (!empty($chats_personales)): ?>
                        <?php foreach ($chats_personales as $chat): ?>
                            <?php 
                            if ($chat['tipo_chat'] == 0){
                                $imagen = !empty($chat['imagen_mostrar']) ? $chat['imagen_mostrar'] : "https://api.dicebear.com/6.x/initials/svg?seed=" . $chat['nombre_mostrar'];
                                $hora = date('H:i', strtotime($chat['fecha_ultimo_mensaje']));
                            ?>
                            
                            <div class="chat-item" onclick="cargarMensajes(<?php echo $chat['fk_chat']; ?>)">
                                <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Usuario">
                                <div class="chat-info">
                                <?php 
                                    $Medalla_Temp = $chat['Rango_Recompensa'];
                                    $Medalla_Imprimir;
                                    switch($Medalla_Temp){
                                        case 0:
                                            $Medalla_Imprimir = '';
                                            break;
                                        case 1:
                                            $Medalla_Imprimir = '<i class = "Recompensa_Bronze"></i>';
                                            break;
                                        case 2:
                                            $Medalla_Imprimir = '<i class = "Recompensa_Silver"></i>';
                                            break;
                                        case 3:
                                            $Medalla_Imprimir = '<i class = "Recompensa_Gold"></i>';
                                            break;
                                        default:
                                            $Medalla_Imprimir = '';
                                        break;
                                    }
                                
                                ?>
                                
                                
                                    <div class="chat-name"><?php echo htmlspecialchars($chat['nombre_mostrar']) . $Medalla_Imprimir;?></div> 
                                    <div class="chat-preview"><?php echo htmlspecialchars($chat['ultimo_mensaje']); ?></div>
                                </div>
                                <div class="chat-time"><?php echo $hora; ?></div>
                            </div>

                            <?php }?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="chats-section">
                    <h3>Chats Personales</h3>

                    <?php if (empty($chats_personales)): ?>
                        <p style="color: #a0a0a0; padding: 10px; font-size: 0.9rem;">No tienes chats activos.</p>
                    <?php else: ?>
                        
                        <?php foreach ($chats_personales as $chat): ?>
                            <?php 
                            if ($chat['tipo_chat'] != 0){ 
                                $imagen = !empty($chat['imagen_mostrar']) ? $chat['imagen_mostrar'] : "https://api.dicebear.com/6.x/initials/svg?seed=" . $chat['nombre_mostrar'];
                                $hora = date('H:i', strtotime($chat['fecha_ultimo_mensaje']));
                            ?>
                            
                            <div class="chat-item" onclick="cargarMensajes(<?php echo $chat['fk_chat']; ?>)">
                                <img src="<?php echo htmlspecialchars($imagen); ?>" alt="Usuario">
                                <div class="chat-info">
                                    <div class="chat-name"><?php echo htmlspecialchars($chat['nombre_mostrar']); ?></div>
                                    <div class="chat-preview"><?php echo htmlspecialchars($chat['ultimo_mensaje']); ?></div>
                                </div>
                                <div class="chat-time"><?php echo $hora; ?></div>
                            </div>

                            <?php }?>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>
                
               
            </div>
        </div>
        
        <div class="main-chat">
            <div class="chat-header">
                <div class="chat-header-info">
                    <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Leo" alt="Usuario">
                    <div>
                        <h2>Chat Activo </h2> 
                        <p>En línea</p>
                    </div>
                </div>
                <div class="call-options">
                    <button class="call-btn"><i class="fas fa-phone"></i> Llamar</button>
                    <button class="call-btn"><i class="fas fa-video"></i> Video</button>
                </div>
            </div>
            
            <div class="tabs">
                <div class="tab active" data-tab="chat">Chat</div>
                <div class="tab" data-tab="simulator">Simulador</div>
            </div>

            <div class="chat-content tab-content active" id="chat-content">
                <div style="text-align: center; color: #ccc; margin-top: 50px;">
                    <i class="fas fa-comments" style="font-size: 3rem; margin-bottom: 10px;"></i>
                    <p>Selecciona una conversación para ver los mensajes.</p>
                </div>
            </div>

            <div class="simulator-content tab-content" id="simulator-content">
                <div class="match-simulator">
                    <h2>Simulador del Mundial 2026</h2>
                    <p>Simula el resultado de partidos del mundial</p>
                    
                    <div class="teams">
                        <div class="team">
                            <div class="team-flag">🇦🇷</div>
                            <div class="team-name">Argentina</div>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <div class="team-flag">🇧🇷</div>
                            <div class="team-name">Brasil</div>
                        </div>
                    </div>
                    
                    <div class="score">0 - 0</div>

                    <div class="Simulador_Footer p-2 d-flex flex-column text-center">
                        <div class="test overflow-scroll hidden">
                            <p>Comienza el partido...</p>
                        </div>
                    </div>
                    
                    <button class="simulate-btn">Simular Partido</button>
                </div>
            </div>

            <div class="chat-input">
                <input type="text" id="mensajeInput" placeholder="Escribe un mensaje...">
                <button class="send-btn" id="btnEnviar">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // --- VARIABLE GLOBAL PARA SABER EN QUÉ CHAT ESTAMOS ---
        let activeChatId = null;

        // Funcionalidad de pestañas
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(`${tabId}-content`).classList.add('active');
            });
        });
        
        // Simulador
        const simulateBtn = document.querySelector('.simulate-btn');
        if (simulateBtn) {
            simulateBtn.addEventListener('click', () => {
                const scoreElement = document.querySelector('.score');
                const score1 = Math.floor(Math.random() * 5);
                const score2 = Math.floor(Math.random() * 5);
                scoreElement.textContent = `${score1} - ${score2}`;
            
                const targetElements = document.querySelectorAll('.test');
                targetElements.forEach(element => {
                    element.classList.toggle('hidden');
                });
            });
        }

        // --- 1. CARGAR MENSAJES (ACTUALIZADA) ---
        function cargarMensajes(idChat) {
            // Guardamos el ID del chat activo en la variable global
            activeChatId = idChat;
            
            const chatContainer = document.getElementById('chat-content');
            
            // Indicador de carga
            chatContainer.innerHTML = '<p style="text-align:center; padding:20px; color:#fff;">Cargando mensajes...</p>';

            const formData = new FormData();
            formData.append('id_chat', idChat);

            fetch('obtener_mensajes.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                chatContainer.innerHTML = data;
                chatContainer.scrollTop = chatContainer.scrollHeight;
                
                // Enfocar el input para escribir rápido
                document.getElementById('mensajeInput').focus();
            })
            .catch(error => {
                console.error('Error:', error);
                chatContainer.innerHTML = '<p style="color:red; text-align:center;">Error al cargar mensajes.</p>';
            });
        }

        // --- 2. ENVIAR MENSAJE ---
        function enviarMensaje() {
            // Validar que hay un chat seleccionado
            if (!activeChatId) {
                alert("Selecciona un chat primero.");
                return;
            }

            const input = document.getElementById('mensajeInput');
            const mensaje = input.value.trim();

            // Validar que el mensaje no esté vacío
            if (mensaje === "") return;

            // Preparar datos
            const formData = new FormData();
            formData.append('id_chat', activeChatId);
            formData.append('mensaje', mensaje);

            // Enviar por AJAX
            fetch('enviar_mensaje.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'ok') {
                    // Limpiar el input
                    input.value = "";
                    
                    // Recargar los mensajes para ver el nuevo
                    cargarMensajes(activeChatId);
                } else {
                    console.error("Error del servidor:", data);
                    alert("No se pudo enviar el mensaje.");
                }
            })
            .catch(error => {
                console.error('Error de red:', error);
            });
        }

        // --- 3. EVENT LISTENERS (CLICK Y ENTER) ---
        
        // Detectar clic en el botón de enviar
        document.getElementById('btnEnviar').addEventListener('click', enviarMensaje);

        // Detectar tecla ENTER en el input
        document.getElementById('mensajeInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                enviarMensaje();
            }
        });

    </script>
</body>
</html>