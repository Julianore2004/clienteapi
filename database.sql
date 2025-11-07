-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2025 a las 00:29:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cliente_api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens_api`
--

CREATE TABLE `tokens_api` (
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tokens_api`
--

INSERT INTO `tokens_api` (`id_client_api`, `token`) VALUES
('589e4cf1e5c2024e8d74d482b4bad2df-20251003-02'),
('710602c970c9f224d6f041b2984b2a0d-20251003-04'),
('a69e9f2a3850558dfd439bf27d27ede9-20251003-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre_completo` varchar(120) NOT NULL,
  `rol` enum('admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `nombre_completo`, `rol`, `created_at`, `updated_at`) VALUES
(4, 'admin', '$2y$10$a4qsOmIrUcXN4ptudcU57uOQ7li/aLuuuRedYHOb1YoBnoRQsWgPi', 'Administrador General', 'admin', '2025-09-04 16:18:50', '2025-09-04 16:27:16'),
(5, 'julian', '$2y$10$c4ciki.RcE21wQp3VQp7eOIgSHU6hpTMNhNEUkpDYWF8axQJdfq9.', 'julian', 'admin', '2025-09-08 13:35:39', '2025-09-08 13:35:39');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

APIDOCENTES:
/APIDOCENTES
│── /config
│    └── database.php
│
│── /controllers
│    └── AuthController.php
│
│── /models
│    └── Usuario.php
│
│── /views
│    ├── include/
│    │     ├── header.php
│    │     └── footer.php
│    ├── login.php
│    ├── dashboard.php
│    ├── docentes_list.php
│    └── docente_form.php
│
│── /public
│    └── index.php
│    └── css/
│    └── js/
│
└── index.php
└── .htaccess


-- ================================
