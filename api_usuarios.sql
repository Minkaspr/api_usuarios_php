-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2023 a las 03:27:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `api_usuarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `genero` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `hora_registro` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `direccion`, `correo_electronico`, `genero`, `estado`, `fecha_nacimiento`, `hora_registro`) VALUES
(1, 'Juan', 'Pérez', 'Calle 123, Ciudad de México', 'juan.perez@example.com', 0, 1, '1990-01-01', '12:00:00'),
(2, 'María', 'García', 'Avenida 456, Guadalajara', 'maria.garcia@example.com', 1, 1, '1991-02-02', '13:00:00'),
(3, 'Pedro', 'López', 'Calle 789, Monterrey', 'pedro.lopez@example.com', 2, 1, '1992-03-03', '14:00:00'),
(4, 'Ana', 'Rodríguez', 'Avenida 1012, Puebla', 'ana.rodriguez@example.com', 0, 0, '1993-04-04', '15:00:00'),
(5, 'José', 'Martínez', 'Calle 1314, Veracruz', 'jose.martinez@example.com', 1, 0, '1994-05-05', '16:00:00'),
(6, 'Luisa', 'Sánchez', 'Avenida 1516, Oaxaca', 'luisa.sanchez@example.com', 2, 0, '1995-06-06', '17:00:00'),
(7, 'Pablo', 'Gómez', 'Calle 1718, Chiapas', 'pablo.gomez@example.com', 0, 1, '1996-07-07', '18:00:00'),
(8, 'Laura', 'Hernández', 'Avenida 1920, Tabasco', 'laura.hernandez@example.com', 1, 0, '1997-08-08', '19:00:00'),
(9, 'Daniel', 'Álvarez', 'Calle 2122, Campeche', 'daniel.alvarez@example.com', 2, 1, '1998-09-09', '20:00:00'),
(10, 'José Carlos', 'González Ramírez', 'Avenida 456, Lima', 'carlos.gonzalez@example.com', 1, 1, '1985-05-15', '15:30:00'),
(14, 'Lucas Pedro', 'Suarez Peréz', 'Avenida 456, Lima', 'carlos.gonzalez@example.com', 1, 1, '1985-05-15', '15:30:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
