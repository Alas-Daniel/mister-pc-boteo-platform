-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2025 a las 01:18:47
-- Versión del servidor: 8.0.42
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mister_pc_boteo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_productos`
--

CREATE TABLE `categorias_productos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias_productos`
--

INSERT INTO `categorias_productos` (`id`, `nombre`, `is_active`) VALUES
(1, 'Componentes', 1),
(2, 'Placas Madre', 1),
(3, 'Accesorio', 1),
(4, 'Herramientas', 1),
(5, 'hola', 0),
(6, 'PRUEBA XD', 0),
(7, 'Audifonos', 1),
(8, 'PRUEBA5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` bigint UNSIGNED NOT NULL,
  `propietario_id` bigint UNSIGNED NOT NULL,
  `tecnico_id` bigint UNSIGNED DEFAULT NULL,
  `nombre_equipo` varchar(120) NOT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `modelo` varchar(120) DEFAULT NULL,
  `numero_serie` varchar(120) DEFAULT NULL,
  `so_nombre` varchar(120) DEFAULT NULL,
  `so_version` varchar(50) DEFAULT NULL,
  `so_arquitectura` varchar(20) DEFAULT NULL,
  `cpu_marca` varchar(120) DEFAULT NULL,
  `cpu_modelo` varchar(120) DEFAULT NULL,
  `cpu_velocidad` varchar(50) DEFAULT NULL,
  `ram_tipo` varchar(50) DEFAULT NULL,
  `ram_capacidad` varchar(50) DEFAULT NULL,
  `ram_velocidad` varchar(50) DEFAULT NULL,
  `ram_slots_vacios` int DEFAULT NULL,
  `almacenamiento_cap` varchar(50) DEFAULT NULL,
  `almacenamiento_particiones` varchar(50) DEFAULT NULL,
  `placa_modelo` varchar(120) DEFAULT NULL,
  `puertos` varchar(200) DEFAULT NULL,
  `info_extra` text,
  `tipo_problema` enum('hardware','software','ambos') NOT NULL DEFAULT 'hardware',
  `estado_actual` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `fecha_ingreso` date NOT NULL,
  `fecha_finalizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `propietario_id`, `tecnico_id`, `nombre_equipo`, `marca`, `modelo`, `numero_serie`, `so_nombre`, `so_version`, `so_arquitectura`, `cpu_marca`, `cpu_modelo`, `cpu_velocidad`, `ram_tipo`, `ram_capacidad`, `ram_velocidad`, `ram_slots_vacios`, `almacenamiento_cap`, `almacenamiento_particiones`, `placa_modelo`, `puertos`, `info_extra`, `tipo_problema`, `estado_actual`, `activo`, `fecha_ingreso`, `fecha_finalizacion`) VALUES
(13, 2, 3, 'ASUS-DANIEL', 'ASUS XL67', 'VivoBook', NULL, 'Windows', '11', 'x64', 'Amd Ryzen', '700', '23GHZ', 'R5', '8-GB', '23', 2, '512', '3', 'r503', '2', 'Equipo en buenas condiciones generales.', 'software', 'entregado', 1, '2025-08-31', '2025-09-01'),
(14, 2, 3, 'HP-Daniel', 'HP', 'VivoBook', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', 'Equipo en condicione de reparacion', 'software', 'En proceso', 1, '2025-08-30', NULL),
(16, 2, 1, 'HP-Cesar', 'HP - 5', 'VivoBook', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', 'Equipo con fallas ', 'software', 'entregado', 1, '2025-08-26', '2025-09-02'),
(17, 2, 1, 'HP-Daniel', 'ASUS XL67', 'VivoBook GO 15', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', 'Ninguna', 'software', 'finalizado', 0, '2025-08-24', '2025-08-26'),
(18, 4, 2, 'HP-Daniel', 'ASUS 2025', 'VivoBook GO 15', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', 'Equipo en buenas condiciones', 'hardware', 'En proceso', 1, '2025-09-04', NULL),
(19, 3, 4, 'LENOVO-01', 'LENOVO 503', 'VivoBook', NULL, 'Windows', '11', 'x64', 'Amd Ryzen', '700', '23GHZ', 'R5', '8-GB', '23', 2, '512', '3', 'r503', '2', 'Equipo en buenas condiciones generales.', 'hardware', 'entregado', 1, '2025-09-05', '2025-09-08'),
(20, 4, 2, 'ACER-JOSUE', 'ACER 2020', 'VivoBook GO 15', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', 'Listo para reparacion', 'hardware', 'entregado', 1, '2025-09-06', NULL),
(21, 4, 2, 'ACER-GAMER', 'ACER GAMER', 'VivoBook GO 15', NULL, 'Windows', '11', 'x64', 'Intel', 'i5', '23GHZ', 'R5', '16-GB', '23', 2, '512', '6', 'r503', '4', '', 'software', 'No iniciado', 1, '2025-09-06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(180) NOT NULL,
  `marca` varchar(120) DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL DEFAULT '0.00',
  `categoria_id` bigint UNSIGNED NOT NULL,
  `proveedor_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `tipo_presentacion` varchar(50) NOT NULL,
  `unidades_por_presentacion` int DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `destacado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `marca`, `precio`, `categoria_id`, `proveedor_id`, `stock`, `tipo_presentacion`, `unidades_por_presentacion`, `imagen`, `is_active`, `creado_en`, `destacado`) VALUES
(2, 'HOLA', NULL, 400.00, 7, 1, 5, 'caja', 20, 'HTTPS', 0, '2025-08-30 21:12:02', 1),
(3, 'Cubbit', NULL, 40.00, 3, 3, 9, 'unidad', NULL, 'HTTPS', 1, '2025-08-30 21:28:08', 1),
(4, 'Asus Vivobook', NULL, 400.00, 1, 5, 9, 'caja', 5, 'HTTPS', 1, '2025-08-30 21:29:05', 1),
(5, 'Teclado Mecanico', 'Logic', 50.00, 3, 3, 9, 'unidad', NULL, 'HTTPS', 1, '2025-08-30 22:29:02', 0),
(8, 'Monitor 34 pulgadas', 'HP - 5', 30.00, 4, 2, 5, 'unidad', NULL, 'HTTPS', 1, '2025-08-30 22:39:46', 0),
(9, 'prueba-5', 'prueba-5', 56.00, 3, 1, 10, 'caja', 5, 'prueba-5', 1, '2025-08-30 23:19:51', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `telefono` varchar(40) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `telefono`, `email`, `direccion`, `is_active`) VALUES
(1, 'Proveedor A', '7777-1111', 'proveedorA@mail.com', 'Av. Principal 123, Ciudad', 1),
(2, 'Proveedor B', '7777-2222', 'proveedorB@mail.com', 'Calle Secundaria 456, Ciudad', 1),
(3, 'Proveedor C', '7777-3333', 'contacto@proveedorC.com', 'Colonia Central, Ciudad', 1),
(4, 'Proveedor D', NULL, 'info@proveedorD.com', 'Barrio Norte, Ciudad', 1),
(5, 'Proveedor E', '7777-5555', NULL, 'Zona Industrial, Ciudad', 1),
(6, 'Proveedor F', NULL, NULL, 'Parque Empresarial, Ciudad', 1),
(10, 'FANTA', '55557777', 'FANTA@GMAIL.COM', '1234666', 1),
(11, 'Sprite', '50370303030', 'sprite@gmail.com', 'la majada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparaciones`
--

CREATE TABLE `reparaciones` (
  `id` bigint UNSIGNED NOT NULL,
  `equipo_id` bigint UNSIGNED NOT NULL,
  `descripcion_proceso` text NOT NULL,
  `detalles_problemas` text,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `reparaciones`
--

INSERT INTO `reparaciones` (`id`, `equipo_id`, `descripcion_proceso`, `detalles_problemas`, `fecha_registro`) VALUES
(1, 13, 'Se cambio una pieza principal y reiniciamos routers', 'La pantalla parpadeaba', '2025-08-31 16:41:57'),
(2, 16, 'Prueba 2', 'Prueba 2', '2025-08-31 17:02:39'),
(3, 19, 'reparacion inmediata', 'solucionados', '2025-09-06 10:22:54'),
(4, 18, 'Equipo en buenas condiciones', 'Equipo en buenas condiciones', '2025-09-06 11:40:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `telefono` varchar(40) DEFAULT NULL,
  `rol` enum('admin','tecnico','cliente') NOT NULL DEFAULT 'cliente',
  `pass_hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `creado_en` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `email`, `telefono`, `rol`, `pass_hash`, `is_active`, `creado_en`) VALUES
(1, 'Daniel Alas', 'alas@gmail.com', NULL, 'admin', '$2y$10$dcqSTwmNAAkMw6Bd7JeylOiWXvVxFL7j9EBYqjw3tykUCKudEKk9S', 1, '2025-08-30 15:31:50'),
(2, 'CESAR', 'cesarito@gmail.com', '7008-9000', 'tecnico', '$2y$10$4I2s8CmXzmfFORwMROrstOuobai/FaEm.obL2GJUcr9y7YMHrwFh6', 1, '2025-08-30 23:38:32'),
(3, 'Alexander', 'alex@gmail.com', '7049-1520', 'cliente', '$2y$10$Oa4pKN/5SxhV67ajMSPUi.3Q2jQZxWFagl8NorDl7G1wdaB2apDx6', 1, '2025-08-31 00:09:20'),
(4, 'usuario cliente', 'user@gmail.com', '7070-7070', 'cliente', '$2y$10$dYn0.uCPclfVWWcj.vCatusOTOT5kjOD.zQhaXw6CdJYwM0VlPHkm', 1, '2025-09-06 09:03:52'),
(5, 'Josue Alas', 'josue@gmail.com', '7049-1520', 'tecnico', '$2y$10$.HP2w0t3JSb034WOOXWsWO2vLoG1AsuTNiLAvzw1KTT1tine9Ekj2', 1, '2025-09-06 21:41:26'),
(6, 'Josué Adonay Alas Sánchez', 'josuealas@gmail.com', '7055-9000', 'cliente', '$2y$10$2RVtMumaLs1aImqGfW.Jc.353GzsjkkYYIdoFJMsjD8GvDKfyGmzG', 1, '2025-09-10 21:42:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `propietario_id` (`propietario_id`),
  ADD KEY `tecnico_id` (`tecnico_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_productos_categoria` (`categoria_id`),
  ADD KEY `fk_productos_proveedor` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_id` (`equipo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_productos`
--
ALTER TABLE `categorias_productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`propietario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `equipos_ibfk_2` FOREIGN KEY (`tecnico_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_productos` (`id`),
  ADD CONSTRAINT `fk_productos_proveedor` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `reparaciones`
--
ALTER TABLE `reparaciones`
  ADD CONSTRAINT `reparaciones_ibfk_1` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
