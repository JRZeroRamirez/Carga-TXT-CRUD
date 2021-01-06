-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-01-2021 a las 06:58:35
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `sample`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(10) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `email`, `nombre`, `apellido`, `codigo`) VALUES
(133, 'm.a.a.r.92@hotmail.com', 'Miguel Angel', 'Angarita Rios', 30),
(136, 'lauraPerez@hotmail.com', 'Laura', 'Ordoñez Perez', 27),
(159, 'laura@hotmail.com', ' Laura', ' Perez', 10),
(161, 'm.a.a.r.92@hotmail.com', 'Miguel', 'Angarita', 28),
(162, 'hurracanegra@hotmail.com', 'David', ' Huertas', 26),
(163, 'laura@hotmail.com', 'Laura', ' Huertas', 27);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
COMMIT;
