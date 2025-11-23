<?php
// obtener_mensajes.php
session_start();
require 'conexion.php';

// Verificamos que se haya enviado el ID del chat y el usuario esté logueado
if (!isset($_POST['id_chat']) || !isset($_SESSION['ID_usuario'])) {
    echo "Error de acceso";
    exit;
}

$chat_id_fijo = $_POST['id_chat'];
$id_usuario_actual = $_SESSION['ID_usuario'];

$sql_msgs = "CALL ObtenerMensajesPorChat(?)";

if ($stmt_msgs = $conn->prepare($sql_msgs)) {
    $stmt_msgs->bind_param("i", $chat_id_fijo);
    $stmt_msgs->execute();
    $resultado_msgs = $stmt_msgs->get_result();

    if ($resultado_msgs->num_rows > 0) {
        while ($msg = $resultado_msgs->fetch_assoc()) {
            
            $es_mio = ($msg['fk_usuario'] == $id_usuario_actual);
            $clase_css = $es_mio ? 'sent' : 'received';
            $hora = date('H:i', strtotime($msg['fecha_creacion']));
            $imagen_msg = !empty($msg['imagen_perfil']) ? $msg['imagen_perfil'] : "https://api.dicebear.com/6.x/initials/svg?seed=" . $msg['nombre'];
?>
            <div class="message <?php echo $clase_css; ?>">
                <div style="display: flex; align-items: center; margin-bottom: 5px;">
                    <img src="<?php echo htmlspecialchars($imagen_msg); ?>" 
                         alt="Perfil" 
                         style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 8px; border: 1px solid #ccc;">
                    
                    <?php if (!$es_mio): ?>
                        <div class="message-sender" style="font-weight: bold; font-size: 0.9em;"><?php echo htmlspecialchars($msg['nombre']); ?></div>
                    <?php endif; ?>
                </div>

                <div><?php echo htmlspecialchars($msg['mensaje']); ?></div>
                <div class="message-time"><?php echo $hora; ?></div>
            </div>
<?php
        }
    } else {
        echo '<p style="text-align:center; color:#999; margin-top:20px;">No hay mensajes en esta conversación.</p>';
    }
    
    $stmt_msgs->close();
}
$conn->close();
?>