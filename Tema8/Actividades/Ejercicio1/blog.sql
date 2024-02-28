-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2024 a las 10:17:10
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
-- Base de datos: `blog`
--
CREATE DATABASE `blog` CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `blog`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id` int(11) NOT NULL,
  `titulo` varchar(1000) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `contenido` varchar(8000) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id`, `titulo`, `categoria`, `contenido`, `fecha`) VALUES
(2, 'Viaje Madrid', 'Viajes', 'fqawgfewgewb', '2024-02-12 10:27:28'),
(3, 'Ejercicios PHP', 'Programacion', 'wfccsgvbegvbewsgvwsgv', '2024-02-12 10:33:22'),
(4, 'Nota 1', 'Notas', 'sadfasfagsag', '2024-02-12 11:01:34'),
(5, 'gdsgd', 'Pruebas', 'gdsdbdsb', '2024-02-12 11:01:58'),
(6, '343432', 'Pruebas', 'dgfvsdbgsd', '2024-02-12 11:02:05'),
(7, 'aaaaaaaaaaaaa', 'Pruebas', 'aaaaaaaaaaaaaaaaaa', '2024-02-27 09:35:16'),
(8, 'bbbbbbbbbbbbbbbbb', 'Pruebas', 'bbbbbbbbbbbbbbbbbbbbbb', '2024-02-27 09:35:22'),
(9, 'ccccccccccccccccccc', 'Pruebas', 'cccccccccccccccccccccc', '2024-02-27 09:35:27'),
(10, 'dddddddddddddddddddd', 'Pruebas', 'ddddddddddddddddddd', '2024-02-27 09:35:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
