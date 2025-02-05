-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2025 a las 01:16:52
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
-- Base de datos: `issste_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `foto_carnet` varchar(255) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_cita` time NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_citas`
--

CREATE TABLE `control_citas` (
  `fecha` date NOT NULL,
  `citas_disponibles` int(11) NOT NULL DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_citas`
--

INSERT INTO `control_citas` (`fecha`, `citas_disponibles`) VALUES
('2025-02-04', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_carnet` varchar(20) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_carnet`, `nombre_completo`, `telefono`, `correo`, `password`) VALUES
('121224', 'alan perez mtz', '7292360178', 'alanperezmtz220@gmail.com', '$2y$10$V7IIPoPoTPFmMx9hBa/uLudFXPtsM0j18hk1Bqe8.T6EZqkT8.0SK'),
('54321', 'eliot peres alan', '7293345678', 'alanperezmtz420@gmail.com', '$2y$10$awNR2IUbGV6Vfdqe1Ec45eu7Ow4gc1cy4.TvksRIlsJXvizxvD0VK'),
('7654', 'alan jusdaf', '3524543543', 'josecuarvo@unive.mx', '$2y$10$Vk/1./6P97feas9yFyJR.uevxSm8Qt94CpB5hAiNwRS0EOCMwp4Be');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD UNIQUE KEY `registro_unico` (`nombre_completo`,`fecha_cita`);

--
-- Indices de la tabla `control_citas`
--
ALTER TABLE `control_citas`
  ADD PRIMARY KEY (`fecha`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_carnet`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
