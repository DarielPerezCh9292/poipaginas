-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2025 a las 22:03:26
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `poipaginas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerListaChats` (IN `p_id_usuario_actual` INT)   BEGIN
    SELECT 
        m.fk_chat,
        c.nombre AS nombre_chat,
        c.tipo AS tipo_chat, -- Devuelve el número (1 o 2)
        m.mensaje AS ultimo_mensaje,
        m.fecha_creacion AS fecha_ultimo_mensaje,
        
        -- LOGICA PARA EL NOMBRE:
        -- Si tipo es 2 (Grupal), usa el nombre del chat. 
        -- Si no, usa el nombre del otro usuario.
        CASE 
            WHEN c.tipo = 2 THEN c.nombre
            ELSE u.nombre 
        END AS nombre_mostrar,

        -- LOGICA PARA LA IMAGEN:
        -- Si es personal (tipo 1), usa la del usuario.
        -- Como tu tabla 'chat' nueva no tiene columna de imagen, para grupos devolvemos NULL
        -- (El PHP se encargará de poner un icono por defecto)
        CASE 
            WHEN c.tipo = 2 THEN NULL 
            ELSE u.imagen_perfil 
        END AS imagen_mostrar,
		
		u.Rango_Recompensa 	AS Rango_Recompensa

    FROM 
        mensaje m
    
    -- Unimos con tu nueva tabla CHAT
    JOIN chat c ON m.fk_chat = c.ID_chat

    -- Buscamos al destinatario (solo útil para chats personales)
    LEFT JOIN usuarios u ON u.ID_usuario = (
        SELECT DISTINCT fk_usuario 
        FROM mensaje m2 
        WHERE m2.fk_chat = m.fk_chat 
        AND m2.fk_usuario != p_id_usuario_actual
        LIMIT 1
    )

    WHERE 
        -- Filtro del último mensaje por ID
        m.ID_mensaje IN (
            SELECT MAX(ID_mensaje)
            FROM mensaje
            WHERE fk_chat IN (
                SELECT DISTINCT fk_chat 
                FROM mensaje 
                WHERE fk_usuario = p_id_usuario_actual
            )
            GROUP BY fk_chat
        )
    
    ORDER BY 
        m.fecha_creacion DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerMensajesPorChat` (IN `p_id_chat` INT)   BEGIN
    SELECT 
        u.imagen_perfil,
        u.nombre,
        m.mensaje,
        m.fecha_creacion,
        m.fk_usuario -- Importante para saber si el mensaje es mío o del otro
    FROM 
        mensaje m
    JOIN 
        usuarios u ON m.fk_usuario = u.ID_usuario
    WHERE 
        m.fk_chat = p_id_chat
    ORDER BY 
        m.fecha_creacion ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `ID_chat` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`ID_chat`, `nombre`, `fecha_creacion`, `tipo`) VALUES
(1, 'Guerra', '2025-11-22 12:09:11', 0),
(2, 'Los mas locos', '2025-11-22 12:09:12', 0),
(3, 'Chatsito', '2025-11-22 12:09:12', 0),
(4, 'Ya no se', '2025-11-22 12:09:12', 1),
(5, 'Nimuru', '2025-11-22 12:09:12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `ID_mensaje` int(11) NOT NULL,
  `mensaje` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fk_usuario` int(11) DEFAULT NULL,
  `fk_chat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`ID_mensaje`, `mensaje`, `fecha_creacion`, `fk_usuario`, `fk_chat`) VALUES
(1, 'Hola, este es un mensaje de prueba', '2025-11-22 12:10:31', 1, 1),
(2, 'otro mensaje es para ir probando cosas', '2025-11-22 12:10:45', 1, 1),
(4, 'ojo esta pruieba esta funcionando', '2025-11-22 12:11:08', 2, 1),
(5, 'a lo mejor no esta funcionando de la manera que spéraba chales', '2025-11-22 12:11:21', 2, 1),
(6, 'Iniciando la secuencia de pruebas en el servidor.', '2025-11-22 12:12:42', 2, 1),
(7, 'El primer set de datos de registro ha sido cargado con éxito.', '2025-11-22 12:12:42', 2, 1),
(8, 'Verificando la funcionalidad de login con el hash de contraseña.', '2025-11-22 12:12:42', 2, 1),
(9, 'Finalizando las pruebas del chat. El ID de mensaje funciona bien.', '2025-11-22 12:12:42', 2, 1),
(10, 'Iniciando la secuencia de pruebas en el servidor.', '2025-11-22 12:13:15', 2, 2),
(11, 'El primer set de datos de registro ha sido cargado con éxito.', '2025-11-22 12:13:15', 2, 2),
(12, 'Verificando la funcionalidad de login con el hash de contraseña.', '2025-11-22 12:13:15', 2, 2),
(13, 'Finalizando las pruebas del chat. El ID de mensaje funciona bien.', '2025-11-22 12:13:15', 2, 2),
(14, 'Mensaje A: Revisando la tabla de usuarios antes de la demo.', '2025-11-22 12:13:38', 3, 2),
(15, 'Mensaje B: El equipo necesita confirmar la funcionalidad de la subida de imágenes.', '2025-11-22 12:13:38', 3, 2),
(16, 'Mensaje C: Recordatorio: La fecha de nacimiento usa el tipo DATETIME en la base de datos.', '2025-11-22 12:13:38', 3, 2),
(17, 'Mensaje D: Probando la inserción de cuatro mensajes seguidos por el mismo usuario.', '2025-11-22 12:13:38', 3, 2),
(18, 'Mensaje A: Revisando la tabla de usuarios antes de la demo.', '2025-11-22 12:14:38', 3, 3),
(19, 'Mensaje B: El equipo necesita confirmar la funcionalidad de la subida de imágenes.', '2025-11-22 12:14:38', 3, 3),
(20, 'Mensaje C: Recordatorio: La fecha de nacimiento usa el tipo DATETIME en la base de datos.', '2025-11-22 12:14:38', 3, 3),
(21, 'Mensaje D: Probando la inserción de cuatro mensajes seguidos por el mismo usuario.', '2025-11-22 12:14:38', 3, 3),
(22, 'Mensaje A: Revisando la tabla de usuarios antes de la demo.', '2025-11-22 12:15:22', 3, 1),
(23, 'Mensaje B: El equipo necesita confirmar la funcionalidad de la subida de imágenes.', '2025-11-22 12:15:22', 3, 1),
(24, 'Mensaje C: Recordatorio: La fecha de nacimiento usa el tipo DATETIME en la base de datos.', '2025-11-22 12:15:22', 3, 1),
(25, 'un mensaje que tiene que funcionar', '2025-11-22 12:15:22', 3, 1),
(26, 'Probandoq ue esto funcione', '2025-11-22 12:16:27', 3, 5),
(27, 'Todo listo, User 3. Pero necesito confirmar: ¿ya se probó la funcionalidad de subida de imágenes?', '2025-11-22 12:16:27', 1, 5),
(28, 'Sí, está funcionando, pero ¡OJO! Recuerda que la columna de fecha de nacimiento usa el tipo DATETIME en la base de datos.', '2025-11-22 12:16:27', 3, 5),
(29, 'Perfecto. Ya corregimos ese detalle. Gracias por el recordatorio.', '2025-11-22 12:16:27', 1, 5),
(30, 'hola', '2025-11-22 14:30:48', 1, 1),
(31, 'como estas?', '2025-11-22 14:30:51', 1, 1),
(32, 'bien que tal te va a ti?', '2025-11-22 14:31:08', 3, 1),
(33, 'jajajajajja', '2025-11-22 14:31:11', 3, 1),
(34, 'ojooooooooo', '2025-11-22 14:31:22', 2, 1),
(35, 'si me parece bien que esto este funcionando', '2025-11-22 14:32:03', 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `Rango_Recompensa` int DEFAULT 0
  
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `nombre`, `correo`, `contraseña`, `imagen_perfil`, `fecha_nacimiento`) VALUES
(1, 'fanny2', 'fanny@gmail.com', '$2y$10$aUeVRDmScQPhQBukgPh4Zup/5oZWb31n2p985kpEc7uGyL.fKa1c2', 'uploads/6921e1b9c4a87_0be325594945e80a5636c2cc46b11014.jpg', '1989-06-23 00:00:00', 3),
(2, 'ajedro', 'ajedro11@gmail.com', '$2y$10$ZTtW5vciRZDEben/pBepVOPXR87lQGqB7G5N20/xXLBMv.XY0f9LS', 'uploads/6921e24ce8e9e_ajedro-1-thumb.jpg', '2025-09-02 00:00:00', 2),
(3, 'Jesus', 'jesus@gmail.com', '$2y$10$0HXsBbSZcpHoyi8UbGet2e4Z6oo6/liMWicCyOmNFtCFAT1EdWv8i', 'uploads/6921fbc222a9b_a6eca3980481176d10008b32f3effd80.jpg', '2010-03-15 00:00:00', 1),
(4, 'juan', 'juan@gmail.com', '$2y$10$olLNxUyZA8P3WEW7tDAA5.FN31s76NVB1CxTy4ifCOFIKyRalfIGO', 'uploads/6921fbf076ee2_G2KlVKyaIAAm2hL.jfif', '2020-07-08 00:00:00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_chat`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`ID_mensaje`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_chat` (`fk_chat`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `ID_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `ID_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_chat` FOREIGN KEY (`fk_chat`) REFERENCES `chat` (`ID_chat`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`ID_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
