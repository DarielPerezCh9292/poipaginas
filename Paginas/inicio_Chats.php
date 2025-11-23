<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Mundial 2026</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <link rel="stylesheet" href="inicio_style.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar izquierdo - Chats -->
        <div class="sidebar-left">
            <div class="search-container">
                <input type="text" placeholder="Buscar chats...">
            </div>
            <div class="chats-container">
                <!-- Chats personales (parte superior) -->
                <div class="chats-section">
                    <h3>Chats Personales</h3>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Leo" alt="Usuario">
                        <div class="chat-info">
                            <div class="chat-name">Lionel Messi</div>
                            <div class="chat-preview">¡El partido estuvo increíble!</div>                            
                            <img class="align-items-end" id="Mensaje_Pendiente" src="Icono_2.png" alt="" width="5px" height="5px">
                        </div>
                        
                        
                        
                        <div class="chat-time">10:45</div>
                    </div>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Maria" alt="Usuario">
                        <div class="chat-info">
                            <div class="chat-name">María Rodríguez</div>
                            <div class="chat-preview">¿Vas a ver el partido?</div>
                        </div>
                        <div class="chat-time">09:30</div>
                    </div>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Carlos" alt="Usuario">
                        <div class="chat-info">
                            <div class="chat-name">Carlos Sánchez</div>
                            <div class="chat-preview">Tenemos que organizar la vista...</div>
                        </div>
                        <div class="chat-time">Ayer</div>
                    </div>
                </div>
                
                <!-- Chats grupales (parte inferior) -->
                <div class="chats-section">
                    <h3>Chats Grupales</h3>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/bottts/svg?seed=Family" alt="Grupo">
                        <div class="chat-info">
                            <div class="chat-name">Familia Mundial</div>
                            <div class="chat-preview">Juan: ¿Alguien quiere una entrada?</div>
                        </div>
                        <div class="chat-time">12:15</div>
                    </div>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/bottts/svg?seed=Friends" alt="Grupo">
                        <div class="chat-info">
                            <div class="chat-name">Amigos del Fútbol</div>
                            <div class="chat-preview">Ana: ¡Qué golazo!</div>
                        </div>
                        <div class="chat-time">11:20</div>
                    </div>
                    <div class="chat-item">
                        <img src="https://api.dicebear.com/6.x/bottts/svg?seed=Work" alt="Grupo">
                        <div class="chat-info">
                            <div class="chat-name">Trabajo</div>
                            <div class="chat-preview">Jefe: El lunes hay flexibilidad...</div>
                        </div>
                        <div class="chat-time">Ayer</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Área principal del chat -->
        <div class="main-chat justify-content-center">
            <div class="chat-header">
                <div class="chat-header-info">
                    <!-- <img src="https://api.dicebear.com/6.x/adventurer/svg?seed=Leo" alt="Usuario"> -->
                    <!-- <div>
                        <p>Escoja un chat</p>
                    </div> -->
                </div>
                <!-- <div class="call-options">
                    <button class="call-btn">
                        <i class="fas fa-phone"></i> Llamar
                    </button>
                    <button class="call-btn">
                        <i class="fas fa-video"></i> Video
                    </button>
                </div> -->
            </div>
            
            <div class="Chat_no_Seleccionado container d-flex flex-column justify-content-center text-center">
            
            
                <div class="p-1 fs-2 fw-bold">Escoja un Chat para empezar a conversar</div>
                <div class="p-1 fs-4">Puedes ver tus Chats disponibles a tu Izquierda</div>
                
                <!-- <img src="https://cdn3.emoji.gg/emojis/7445_status_offline.png" alt="" width="25px" height="25px"> -->
            
            
            
            </div>
            <!-- <div class="tabs">
                <div class="tab active" data-tab="chat">Chat</div>
                <div class="tab" data-tab="simulator">Simulador</div>
            </div> -->
            
            <!-- Contenido del chat -->
            <!-- <div class="chat-content tab-content active" id="chat-content">
                <div class="message received">
                    <div class="message-sender">Lionel Messi</div>
                    <div>¡Hola! ¿Viste el partido de ayer?</div>
                    <div class="message-time">10:30</div>
                </div>
                
                <div class="message sent">
                    <div>¡Sí, estuvo increíble! Ese gol en el minuto 89 fue espectacular.</div>
                    <div class="message-time">10:32</div>
                </div>
                
                <div class="message received">
                    <div class="message-sender">Lionel Messi</div>
                    <div>Sabía que lo íbamos a lograr. El equipo está en gran forma para el mundial.</div>
                    <div class="message-time">10:33</div>
                </div>
                
                <div class="message sent">
                    <div>Definitivamente. ¿Crees que llegaremos a la final?</div>
                    <div class="message-time">10:35</div>
                </div>
                
                <div class="message received">
                    <div class="message-sender">Lionel Messi</div>
                    <div>Con este nivel, sin duda. Tenemos que mantener la concentración.</div>
                    <div class="message-time">10:36</div>
                </div>
            </div> -->
            
            <!-- Contenido del simulador -->
            <!-- <div class="simulator-content tab-content" id="simulator-content">
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
                    
                            <p>En Argentina van a jugar Emiliano Martínez, Walter Benítez, Gerónimo Rulli, Nahuel Molina, Gonzalo Montiel,
                                Cristian Romero, Nehuén Pérez, Lisandro Martínez.</p>
                    
                            <p>En Brasil van a jugar Alisson, Bento, Hugo Souza, Alexandro Ribeiro, Alex Sandro, Caio Henrique, Douglas
                                Santos,
                                Fabrício Bruno, Gabriel Magalhães, Marquinhos.</p>
                    
                    
                    
                            <p>Empieza el partido</p>
                    
                            <p>Los jugadores empiezan a moverse</p>
                    
                            <p>Argentina toma la ofensiva y roba el balón</p>
                    
                            <b> GOL !!! 🇦🇷 </b>
                    
                            <p>En el minuto 8 Emiliano marca un gol y los jugadores lo celebran. 🇦🇷 uno a 🇧🇷 cero.</p>
                    
                            <p>En el minuto 10 Alexandro y Walter pelean por el balón, Nahuel trata de hacercarse para le pasen el balón</p>
                    
                            <p>En el minuto 15 Brazil logra esquivar los intentos de robo de balón de Argentina</p>
                    
                            <b> GOL !!! 🇧🇷 </b>
                    
                            <p> En el minuto 17 Brasil marca un gol y los jugadores lo celebran. 🇦🇷 uno a 🇧🇷 uno.</p>
                    
                    
                            <p>Con cambos Equipos empatados las cosas se ponen tensas</p>
                    
                            <p>En el minuto 22 Caio toma el balón y se dirige a la porteria del enemigo</p>
                    
                            <p>Caio logra pasarle el balón a Douglas en el ultimo momento</p>
                    
                            <b> GOL !!! 🇧🇷 </b>
                    
                            <p> En el minuto 25 Brasil marca un gol y los jugadores lo celebran. 🇦🇷 uno a 🇧🇷 dos.</p>
                    
                            ------------------------
                    
                            <div class="p-2 justify-content-center "><button class="rounded Button_blue">Terminar Simulación</button></div>
                    
                    
                        </div>
                    
                    
                    
                    
                    
                    </div>
                    
                    <button class="simulate-btn">Simular Partido</button>
                </div>
            </div> -->
            
            <!-- <div class="chat-input">
                <input type="text" placeholder="Escribe un mensaje...">
                <button class="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div> -->
        </div>
        
        <!-- Sidebar derecho - Miembros y estadísticas -->
        <div class="sidebar-right">
            <div class="members-section">
                <h3>Miembros del Grupo</h3>
                <div class="member-item">
                    <img src="icono_1.png" alt="Miembro" width="15px" height="15px">
                    <span class="Nombre_Vacio"></span>
                </div>
                <div class="member-item">
                    <img src="icono_1.png" alt="Miembro" width="15px" height="15px">
                    <span class="Nombre_Vacio"></span>
                </div>
                <div class="member-item">
                    <img src="icono_1.png" alt="Miembro" width="15px" height="15px">
                    <span class="Nombre_Vacio"></span>
                </div>
                <div class="member-item">
                    <img src="icono_1.png" alt="Miembro" width="15px" height="15px">
                    <span class="Nombre_Vacio"></span>
                </div>
                <div class="member-item">
                    <img src="icono_1.png" alt="Miembro" width="15px" height="15px">
                    <span class="Nombre_Vacio"></span>
                </div>
            </div>
            
            <div class="stats-section">
                <h3>Estadísticas del Mundial</h3>
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-label">
                            <span>Probabilidad de victoria Argentina</span>
                            <span>65%</span>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-value" style="width: 65%;"></div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-label">
                            <span>Goles esperados por partido</span>
                            <span>2.8</span>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-value" style="width: 56%;"></div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-label">
                            <span>Posibilidad de llegar a semifinales</span>
                            <span>78%</span>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-value" style="width: 78%;"></div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-label">
                            <span>Fuerza ofensiva</span>
                            <span>92%</span>
                        </div>
                        <div class="stat-bar">
                            <div class="stat-value" style="width: 92%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad de pestañas
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                // Remover clase active de todas las pestañas
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                // Añadir clase active a la pestaña clickeada
                tab.classList.add('active');
                
                // Ocultar todos los contenidos
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.remove('active');
                });
                
                // Mostrar el contenido correspondiente
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(`${tabId}-content`).classList.add('active');
            });
        });
        
        // Funcionalidad para simular partido
        document.querySelector('.simulate-btn').addEventListener('click', () => {
            const scoreElement = document.querySelector('.score');
            // Generar resultado aleatorio
            const score1 = Math.floor(Math.random() * 5);
            const score2 = Math.floor(Math.random() * 5);
            scoreElement.textContent = `${score1} - ${score2}`;
        
            const targetElements = document.querySelectorAll('.test');
            
            targetElements.forEach(element => {
                element.classList.toggle('hidden');
                
            });

            


        });
    </script>
</body>
</html>