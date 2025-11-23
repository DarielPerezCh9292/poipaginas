document.addEventListener('DOMContentLoaded', function() {
    // Simular partidos en vivo
    function simulateLiveMatch() {
        const scores = document.querySelectorAll('.score');
        const times = document.querySelectorAll('.match-time');
        
        setInterval(() => {
            scores.forEach(score => {
                const [home, away] = score.textContent.split('-').map(Number);
                const homeChange = Math.floor(Math.random() * 3);
                const awayChange = Math.floor(Math.random() * 3);
                
                score.textContent = `${home + homeChange}-${away + awayChange}`;
                score.style.animation = 'scoreFlash 0.5s';
                
                setTimeout(() => {
                    score.style.animation = '';
                }, 500);
            });
            
            times.forEach(time => {
                const [quarter, minutes] = time.textContent.split(' ');
                const [q, num] = quarter.split('Q');
                let newMinutes = parseInt(minutes.split(':')[0]) - 1;
                
                if (newMinutes < 0) {
                    if (parseInt(num) < 4) {
                        time.textContent = `Q${parseInt(num) + 1} 12:00`;
                    } else {
                        time.textContent = 'FINAL';
                    }
                } else {
                    time.textContent = `${quarter} ${newMinutes}:00`;
                }
            });
        }, 10000);
    }

    // Notificaciones deportivas
    function sportsNotifications() {
        const notifications = [
            "⚽ ¡GOL! Barcelona 1-0 Real Madrid",
            "🏀 ¡Triple de Curry! Warriors por 5",
            "🎾 Punto break para Nadal",
            "🏈 Touchdown de Patriots!",
            "🔥 ¡Gran jugada! Asistencia de LeBron"
        ];
        
        setInterval(() => {
            const randomNotif = notifications[Math.floor(Math.random() * notifications.length)];
            showSportsNotification(randomNotif);
        }, 30000);
    }

    function showSportsNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'sports-notification';
        notification.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon">🔥</div>
                <div class="notification-text">${message}</div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Estadísticas en tiempo real
    function updateLiveStats() {
        setInterval(() => {
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const current = parseInt(stat.textContent);
                const change = Math.floor(Math.random() * 5) + 1;
                stat.textContent = current + change;
            });
        }, 60000);
    }

    // Inicializar todas las funcionalidades
    simulateLiveMatch();
    sportsNotifications();
    updateLiveStats();

    // Funcionalidad de chat mejorada
    const messageInput = document.querySelector('.message-input');
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && this.value.trim() !== '') {
            e.preventDefault();
            sendMessage(this.value);
            this.value = '';
        }
    });

    function sendMessage(text) {
        const messagesContainer = document.querySelector('.messages-container');
        const messageElement = document.createElement('div');
        messageElement.className = 'message';
        
        const timestamp = new Date().toLocaleTimeString('es-ES', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });

        messageElement.innerHTML = `
            <div class="message-avatar">
                <div class="avatar-jersey user-avatar">23</div>
            </div>
            <div class="message-content">
                <div class="message-header">
                    <span class="username current-user">Captain23</span>
                    <span class="user-badge">⭐ Propio</span>
                    <span class="timestamp">${timestamp}</span>
                </div>
                <div class="message-text">${text}</div>
            </div>
        `;

        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Simular respuestas automáticas
        if (text.toLowerCase().includes('lakers')) {
            setTimeout(() => simulateReply('¡Lakers a ganar! 🏀'), 2000);
        } else if (text.toLowerCase().includes('warriors')) {
            setTimeout(() => simulateReply('Curry for MVP! 💫'), 2000);
        }
    }

    function simulateReply(text) {
        const messagesContainer = document.querySelector('.messages-container');
        const messageElement = document.createElement('div');
        messageElement.className = 'message';
        
        const timestamp = new Date().toLocaleTimeString('es-ES', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });

        messageElement.innerHTML = `
            <div class="message-avatar">
                <div class="avatar-jersey lakers-avatar">24</div>
            </div>
            <div class="message-content">
                <div class="message-header">
                    <span class="username lakers-fan">LakersFanatic</span>
                    <span class="user-badge">🏀 Top Fan</span>
                    <span class="timestamp">${timestamp}</span>
                </div>
                <div class="message-text">${text}</div>
            </div>
        `;

        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Efectos hover mejorados
    const interactiveElements = document.querySelectorAll('.server-icon, .channel, .member, .sport-btn');
    interactiveElements.forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 25px rgba(230, 57, 70, 0.3)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Modo oscuro/deportivo toggle
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'd') {
            document.body.classList.toggle('light-sports-mode');
        }
    });
});

// Añadir estilos para notificaciones
const notificationStyles = `
.sports-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: linear-gradient(145deg, #e63946, #c1121f);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    border: 2px solid #ff6b35;
    box-shadow: 0 8px 25px rgba(230, 57, 70, 0.4);
    z-index: 1000;
    animation: slideIn 0.5s ease;
}

.notification-content {
    display: flex;
    align-items: center;
    gap: 10px;
}

.notification-icon {
    font-size: 20px;
}

.notification-text {
    font-weight: 600;
}

@keyframes slideIn {
    from { transform: translateX(100px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.light-sports-mode {
    filter: brightness(1.2) saturate(1.1);
}
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = notificationStyles;
document.head.appendChild(styleSheet);