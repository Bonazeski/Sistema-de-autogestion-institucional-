-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2025 a las 17:43:30
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
-- Base de datos: `sistemaautogestionalumnado`
--
CREATE DATABASE IF NOT EXISTS `sistemaautogestionalumnado` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistemaautogestionalumnado`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativos`
--

CREATE TABLE `administrativos` (
  `id_adm` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion_documento` varchar(100) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `dni` varchar(20) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `lugar_nacimiento` varchar(100) DEFAULT NULL,
  `provincia_r` varchar(150) DEFAULT NULL,
  `departamento_r` varchar(150) DEFAULT NULL,
  `barrio_r` varchar(150) DEFAULT NULL,
  `calle` varchar(100) DEFAULT NULL,
  `casa` int(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `escuela_secundaria` varchar(150) DEFAULT NULL,
  `provincia_escuela` varchar(150) DEFAULT NULL,
  `departamento_escuela` varchar(150) DEFAULT NULL,
  `titulo_secundario` varchar(150) DEFAULT NULL,
  `anio_egreso` date DEFAULT NULL,
  `adeuda_materias` varchar(2) DEFAULT NULL,
  `cantidad_materias_adeuda` int(11) DEFAULT NULL,
  `nombre_materias_adeuda` varchar(255) DEFAULT NULL,
  `ocupacion_laboral` varchar(100) DEFAULT NULL,
  `horarios_laborales` varchar(100) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`dni`, `apellido`, `nombre`, `fecha_nac`, `edad`, `estado_civil`, `lugar_nacimiento`, `provincia_r`, `departamento_r`, `barrio_r`, `calle`, `casa`, `correo`, `escuela_secundaria`, `provincia_escuela`, `departamento_escuela`, `titulo_secundario`, `anio_egreso`, `adeuda_materias`, `cantidad_materias_adeuda`, `nombre_materias_adeuda`, `ocupacion_laboral`, `horarios_laborales`, `id_user`) VALUES
('45190822', 'sanchez', 'martin', '2004-07-09', 21, 'soltero', 'candelaria', 'misiones', 'capital', 'san isidro', 'laprida', 802, 'martin.sanchez@example.com', 'bachiller nro 2', 'misiones', 'capital', 'bachiller en ciencias naturales', '2021-12-01', 'no', NULL, NULL, 'mozo', 'manana', 1),
('45321987', 'gomez', 'mariana', '2004-03-12', 21, 'soltera', 'posadas', 'misiones', 'capital', 'villa cabello', 'marconi', 1450, 'mariana.gomez@example.com', 'bachiller nro 1', 'misiones', 'capital', 'bachiller en ciencias sociales', '2021-12-01', 'no', NULL, NULL, NULL, NULL, 2),
('45988710', 'barrios', 'valentina', '2003-05-30', 22, 'soltera', 'posadas', 'misiones', 'capital', 'chacra 32-33', 'ayacucho', 998, 'valentina.barrios@example.com', 'instituto polivalente', 'misiones', 'capital', 'bachiller en humanidades y ciencias sociales', '2020-12-01', 'no', NULL, NULL, NULL, NULL, 3),
('46852144', 'pereira', 'lucas', '2003-11-22', 21, 'soltero', 'garupa', 'misiones', 'capital', 'santa helena', 'los pinos', 320, 'lucas.pereira@example.com', 'epet 1', 'misiones', 'capital', 'tecnico en informatica personal y profesional', '2020-12-01', 'no', NULL, NULL, 'empleado de libreria', 'manana', 4),
('47200331', 'fernandez', 'sofia', '2005-01-15', 20, 'soltera', 'posadas', 'misiones', 'capital', 'itaembe mini', 'av las americas', 510, 'sofia.fernandez@example.com', 'bachiller nro 3', 'misiones', 'capital', 'bachiller en economia y administracion', '2022-12-01', 'no', NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `duracion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre`, `duracion`) VALUES
(1, 'tecnicatura superior en programacion y analisis de sistemas', '3 años'),
(2, 'tecnicatura superior en administracion de pequeñas y medianas empresas (pymes)', '3 años'),
(3, 'tecnicatura superior en comercializacion y marketing', '3 años'),
(4, 'tecnicatura superior en diseño grafico digital', '3 años');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id_comision` int(11) NOT NULL,
  `comision` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id_comision`, `comision`) VALUES
(1, 'a'),
(2, 'b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correralatividades`
--

CREATE TABLE `correralatividades` (
  `id_correlatividad` int(11) NOT NULL,
  `cod_materia` varchar(10) NOT NULL,
  `haber` varchar(100) NOT NULL,
  `materia_requerida` varchar(10) NOT NULL,
  `para` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correralatividades`
--

INSERT INTO `correralatividades` (`id_correlatividad`, `cod_materia`, `haber`, `materia_requerida`, `para`) VALUES
(1, 'a301', 'regularizado', 'a101', 'cursar'),
(2, 'a301', 'regularizado', 'a102', 'cursar'),
(3, 'a301', 'regularizado', 'a103', 'cursar'),
(4, 'a301', 'regularizado', 'a104', 'cursar'),
(5, 'a301', 'regularizado', 'a105', 'cursar'),
(6, 'a301', 'regularizado', 'c111', 'cursar'),
(7, 'a301', 'regularizado', 'c112', 'cursar'),
(8, 'a301', 'regularizado', 'c113', 'cursar'),
(9, 'a301', 'regularizado', 'c114', 'cursar'),
(10, 'a301', 'regularizado', 'c121', 'cursar'),
(11, 'a301', 'regularizado', 'c122', 'cursar'),
(12, 'a301', 'regularizado', 'c123', 'cursar'),
(13, 'a301', 'regularizado', 'c124', 'cursar'),
(14, 'a301', 'regularizado', 'a201', 'cursar'),
(15, 'a301', 'regularizado', 'a202', 'cursar'),
(16, 'a301', 'regularizado', 'a203', 'cursar'),
(17, 'a301', 'regularizado', 'a204', 'cursar'),
(18, 'a301', 'regularizado', 'c211', 'cursar'),
(19, 'a301', 'regularizado', 'c212', 'cursar'),
(20, 'a301', 'regularizado', 'c213', 'cursar'),
(21, 'a301', 'regularizado', 'c214', 'cursar'),
(22, 'a301', 'regularizado', 'c215', 'cursar'),
(23, 'a301', 'regularizado', 'c221', 'cursar'),
(24, 'a301', 'regularizado', 'c222', 'cursar'),
(25, 'a301', 'regularizado', 'c223', 'cursar'),
(26, 'a301', 'regularizado', 'c224', 'cursar'),
(27, 'a301', 'regularizado', 'c225', 'cursar'),
(28, 'a301', 'aprobado', 'a101', 'rendir'),
(29, 'a301', 'aprobado', 'a102', 'rendir'),
(30, 'a301', 'aprobado', 'a103', 'rendir'),
(31, 'a301', 'aprobado', 'a104', 'rendir'),
(32, 'a301', 'aprobado', 'a105', 'rendir'),
(33, 'a301', 'aprobado', 'c111', 'rendir'),
(34, 'a301', 'aprobado', 'c112', 'rendir'),
(35, 'a301', 'aprobado', 'c113', 'rendir'),
(36, 'a301', 'aprobado', 'c114', 'rendir'),
(37, 'a301', 'aprobado', 'c121', 'rendir'),
(38, 'a301', 'aprobado', 'c122', 'rendir'),
(39, 'a301', 'aprobado', 'c123', 'rendir'),
(40, 'a301', 'aprobado', 'c124', 'rendir'),
(41, 'a301', 'aprobado', 'a201', 'rendir'),
(42, 'a301', 'aprobado', 'a202', 'rendir'),
(43, 'a301', 'aprobado', 'a203', 'rendir'),
(44, 'a301', 'aprobado', 'a204', 'rendir'),
(45, 'a301', 'aprobado', 'c211', 'rendir'),
(46, 'a301', 'aprobado', 'c212', 'rendir'),
(47, 'a301', 'aprobado', 'c213', 'rendir'),
(48, 'a301', 'aprobado', 'c214', 'rendir'),
(49, 'a301', 'aprobado', 'c215', 'rendir'),
(50, 'a301', 'aprobado', 'c221', 'rendir'),
(51, 'a301', 'aprobado', 'c222', 'rendir'),
(52, 'a301', 'aprobado', 'c223', 'rendir'),
(53, 'a301', 'aprobado', 'c224', 'rendir'),
(54, 'a301', 'aprobado', 'c225', 'rendir'),
(55, 'a103', 'regularizado', 'c112', 'cursar'),
(56, 'a103', 'regularizado', 'c113', 'cursar'),
(57, 'a103', 'regularizado', 'c111', 'rendir'),
(58, 'a103', 'regularizado', 'c112', 'rendir'),
(59, 'c123', 'regularizado', 'c111', 'cursar'),
(60, 'c123', 'regularizado', 'c112', 'cursar'),
(61, 'c123', 'regularizado', 'c113', 'cursar'),
(62, 'c123', 'aprobado', 'c113', 'rendir'),
(63, 'a104', 'regularizado', 'c114', 'cursar'),
(64, 'a104', 'regularizado', 'c122', 'cursar'),
(65, 'c124', 'regularizado', 'c112', 'cursar'),
(66, 'c211', 'regularizado', 'a104', 'cursar'),
(67, 'c211', 'regularizado', 'c114', 'cursar'),
(68, 'c211', 'regularizado', 'c122', 'cursar'),
(69, 'c211', 'aprobado', 'a104', 'rendir'),
(70, 'c211', 'aprobado', 'c114', 'rendir'),
(71, 'c211', 'aprobado', 'c122', 'rendir'),
(72, 'c211', 'regularizado', 'a104', 'cursar'),
(73, 'c211', 'regularizado', 'c114', 'cursar'),
(74, 'c211', 'regularizado', 'c122', 'cursar'),
(75, 'c211', 'aprobado', 'a104', 'rendir'),
(76, 'c211', 'aprobado', 'c114', 'rendir'),
(77, 'c211', 'aprobado', 'c122', 'rendir'),
(78, 'c311', 'regularizado', 'a201', 'cursar'),
(79, 'c311', 'aprobado', 'a201', 'rendir'),
(80, 'c312', 'regularizado', 'a201', 'cursar'),
(81, 'c312', 'regularizado', 'c222', 'cursar'),
(82, 'c312', 'regularizado', 'c213', 'cursar'),
(83, 'c312', 'regularizado', 'c212', 'cursar'),
(84, 'c312', 'aprobado', 'a201', 'rendir'),
(85, 'c312', 'aprobado', 'c222', 'rendir'),
(86, 'c312', 'aprobado', 'c213', 'rendir'),
(87, 'c312', 'aprobado', 'c212', 'rendir'),
(88, 'c313', 'regularizado', 'a201', 'cursar'),
(89, 'c313', 'regularizado', 'c222', 'cursar'),
(90, 'c313', 'regularizado', 'c213', 'cursar'),
(91, 'c313', 'aprobado', 'a201', 'rendir'),
(92, 'c313', 'aprobado', 'c222', 'rendir'),
(93, 'c313', 'aprobado', 'c213', 'rendir'),
(94, 'c314', 'regularizado', 'a203', 'cursar'),
(95, 'c314', 'regularizado', 'c221', 'cursar'),
(96, 'c314', 'regularizado', 'c223', 'cursar'),
(97, 'c314', 'regularizado', 'c222', 'cursar'),
(98, 'c314', 'aprobado', 'a203', 'rendir'),
(99, 'c314', 'aprobado', 'c221', 'rendir'),
(100, 'c314', 'aprobado', 'c223', 'rendir'),
(101, 'c314', 'aprobado', 'c222', 'rendir'),
(102, 'c316', 'regularizado', 'c225', 'cursar'),
(103, 'c316', 'regularizado', 'c211', 'cursar'),
(104, 'c316', 'aprobado', 'c225', 'rendir'),
(105, 'c316', 'aprobado', 'c211', 'rendir'),
(106, 'c321', 'regularizado', 'c316', 'cursar'),
(107, 'c321', 'aprobado', 'c316', 'rendir'),
(108, 'c322', 'regularizado', 'a201', 'cursar'),
(109, 'c322', 'regularizado', 'c222', 'cursar'),
(110, 'c322', 'regularizado', 'a203', 'cursar'),
(111, 'c322', 'regularizado', 'c212', 'cursar'),
(112, 'c322', 'regularizado', 'c213', 'cursar'),
(113, 'c322', 'aprobado', 'a201', 'rendir'),
(114, 'c322', 'aprobado', 'c222', 'rendir'),
(115, 'c322', 'aprobado', 'a203', 'rendir'),
(116, 'c322', 'aprobado', 'c212', 'rendir'),
(117, 'c322', 'aprobado', 'c213', 'rendir'),
(118, 'c311', 'regularizado', 'a201', 'cursar'),
(119, 'c311', 'aprobado', 'a201', 'rendir'),
(120, 'c312', 'regularizado', 'a201', 'cursar'),
(121, 'c312', 'regularizado', 'c222', 'cursar'),
(122, 'c312', 'regularizado', 'c213', 'cursar'),
(123, 'c312', 'regularizado', 'c212', 'cursar'),
(124, 'c312', 'aprobado', 'a201', 'rendir'),
(125, 'c312', 'aprobado', 'c222', 'rendir'),
(126, 'c312', 'aprobado', 'c213', 'rendir'),
(127, 'c312', 'aprobado', 'c212', 'rendir'),
(128, 'c313', 'regularizado', 'a201', 'cursar'),
(129, 'c313', 'regularizado', 'c222', 'cursar'),
(130, 'c313', 'regularizado', 'c213', 'cursar'),
(131, 'c313', 'aprobado', 'a201', 'rendir'),
(132, 'c313', 'aprobado', 'c222', 'rendir'),
(133, 'c313', 'aprobado', 'c213', 'rendir'),
(134, 'c314', 'regularizado', 'a203', 'cursar'),
(135, 'c314', 'regularizado', 'c221', 'cursar'),
(136, 'c314', 'regularizado', 'c223', 'cursar'),
(137, 'c314', 'regularizado', 'c222', 'cursar'),
(138, 'c314', 'aprobado', 'a203', 'rendir'),
(139, 'c314', 'aprobado', 'c221', 'rendir'),
(140, 'c314', 'aprobado', 'c223', 'rendir'),
(141, 'c314', 'aprobado', 'c222', 'rendir'),
(142, 'c316', 'regularizado', 'c225', 'cursar'),
(143, 'c316', 'regularizado', 'c211', 'cursar'),
(144, 'c316', 'aprobado', 'c225', 'rendir'),
(145, 'c316', 'aprobado', 'c211', 'rendir'),
(146, 'c321', 'regularizado', 'c316', 'cursar'),
(147, 'c321', 'aprobado', 'c316', 'rendir'),
(148, 'c322', 'regularizado', 'a201', 'cursar'),
(149, 'c322', 'regularizado', 'c222', 'cursar'),
(150, 'c322', 'regularizado', 'a203', 'cursar'),
(151, 'c322', 'regularizado', 'c212', 'cursar'),
(152, 'c322', 'regularizado', 'c213', 'cursar'),
(153, 'c322', 'aprobado', 'a201', 'rendir'),
(154, 'c322', 'aprobado', 'c222', 'rendir'),
(155, 'c322', 'aprobado', 'a203', 'rendir'),
(156, 'c322', 'aprobado', 'c212', 'rendir'),
(157, 'c322', 'aprobado', 'c213', 'rendir'),
(158, 'c323', 'regularizado', 'c221', 'cursar'),
(159, 'c323', 'regularizado', 'c222', 'cursar'),
(160, 'c323', 'regularizado', 'c223', 'cursar'),
(161, 'c323', 'aprobado', 'c221', 'rendir'),
(162, 'c323', 'aprobado', 'c222', 'rendir'),
(163, 'c323', 'aprobado', 'c223', 'rendir'),
(164, 'c325', 'regularizado', 'c214', 'cursar'),
(165, 'c325', 'regularizado', 'c224', 'cursar'),
(166, 'c325', 'aprobado', 'c214', 'rendir'),
(167, 'c325', 'aprobado', 'c224', 'rendir'),
(168, 'c327', 'regularizado', 'c215', 'cursar'),
(169, 'c327', 'aprobado', 'c215', 'rendir');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `telefono` int(30) DEFAULT NULL,
  `direccion_documento` varchar(100) DEFAULT NULL,
  `titulo_profesional` varchar(255) DEFAULT NULL,
  `detalles` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombre`, `apellido`, `correo`, `telefono`, `direccion_documento`, `titulo_profesional`, `detalles`) VALUES
(1, 'mariana', 'gomez', 'mariana.gomez@example.com', 2147483647, 'calle junin 823, posadas, misiones', 'licenciada en sistemas', 'docente de primer ano'),
(2, 'lucas', 'fernandez', 'lucas.fernandez@example.com', 2147483647, 'av mitre 1245, posadas, misiones', 'ingeniero en informatica', 'especialista en bases de datos'),
(3, 'carolina', 'benitez', 'c.benitez@example.com', 2147483647, 'calle roca 312, obera, misiones', 'tecnica universitaria en programacion', 'docente del area de programacion'),
(4, 'jorge', 'martinez', 'jorge.martinez@example.com', 2147483647, 'av libertad 2010, posadas, misiones', 'analista en sistemas', 'dicta analisis de sistemas'),
(5, 'esteban', 'nuñez', 'esteban.nunez@example.com', 2147483647, 'av san martin 755, apostoles, misiones', 'licenciado en administracion', 'docente del area administrativa'),
(6, 'rocio', 'castro', 'rocio.castro@example.com', 2147483647, 'barrio belgrano m12 c4, eldorado, misiones', 'ingeniera en computacion', 'especialista en hardware'),
(7, 'diego', 'ortiz', 'diego.ortiz@example.com', 2147483647, 'calle moreno 455, posadas, misiones', 'ingeniero electronico', 'docente de electronica'),
(8, 'valeria', 'acosta', 'valeria.acosta@example.com', 2147483647, 'av sarmiento 987, obera, misiones', 'licenciada en matematica', 'docente de matematica y estadistica'),
(9, 'hernan', 'rios', 'hernan.rios@example.com', 2147483647, 'av tamarindo 1540, posadas, misiones', 'tecnico superior en redes', 'especialista en redes y comunicaciones'),
(10, 'sofia', 'pereyra', 'sofia.pereyra@example.com', 2147483647, 'calle paraguay 245, jardin america, misiones', 'licenciada en informatica', 'docente del area de programacion'),
(11, 'marcos', 'salinas', 'marcos.salinas@example.com', 2147483647, 'av corrientes 1458, posadas, misiones', 'analista programador', 'dicta estructura de datos'),
(12, 'julieta', 'ramirez', 'julieta.ramirez@example.com', 2147483647, 'calle salta 600, obera, misiones', 'licenciada en comunicacion', 'docente de expresion oral y escrita'),
(13, 'fernando', 'paz', 'fernando.paz@example.com', 2147483647, 'barrio chacra 32, posadas, misiones', 'tecnico en desarrollo web', 'docente de programacion web'),
(14, 'natalia', 'vera', 'natalia.vera@example.com', 2147483647, 'av uruguay 2250, posadas, misiones', 'ingeniera en software', 'docente de ingenieria del software'),
(15, 'ricardo', 'lopez', 'ricardo.lopez@example.com', 2147483647, 'calle cordoba 900, posadas, misiones', 'contador publico', 'docente de contabilidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_carrera`
--

CREATE TABLE `inscripciones_carrera` (
  `id_carrera` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `legajo` varchar(30) DEFAULT NULL,
  `fecha_insc` date NOT NULL,
  `estado_carrera` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripciones_carrera`
--

INSERT INTO `inscripciones_carrera` (`id_carrera`, `dni`, `legajo`, `fecha_insc`, `estado_carrera`) VALUES
(1, '45190822', 'a2301', '2023-03-14', 'cursando'),
(1, '45321987', 'a2207', '2022-11-22', 'cursando'),
(1, '45988710', 'a2404', '2024-03-05', 'cursando'),
(1, '46852144', 'a2503', '2025-02-27', 'cursando'),
(1, '47200331', 'a2312', '2023-12-03', 'cursando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_materias`
--

CREATE TABLE `inscripciones_materias` (
  `id_carrera` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cod_materia` varchar(10) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `fecha_ins` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_mesas`
--

CREATE TABLE `inscripciones_mesas` (
  `id_carrera` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cod_materia` varchar(10) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `id_mesa` int(11) NOT NULL,
  `fecha_ins` date DEFAULT NULL,
  `condicion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `cod_materia` varchar(10) NOT NULL,
  `nombre_materia` varchar(150) NOT NULL,
  `modalidad_dictada` varchar(100) DEFAULT NULL,
  `regimen_evauacion` varchar(100) DEFAULT NULL,
  `anio_cursada` varchar(100) DEFAULT NULL,
  `carga_horaria` varchar(100) DEFAULT NULL,
  `periodo` varchar(100) DEFAULT NULL,
  `id_planes_estudio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`cod_materia`, `nombre_materia`, `modalidad_dictada`, `regimen_evauacion`, `anio_cursada`, `carga_horaria`, `periodo`, `id_planes_estudio`) VALUES
('a101', 'matematica', 'materia/asignatura', 'promocional', '1', '4 hs', 'anual', 1),
('a102', 'ingles', 'materia/asignatura', 'promocional', '1', '3 hs', 'anual', 1),
('a103', 'sistemas operativos', 'materia/asignatura', 'promocional', '1', '3 hs', 'anual', 1),
('a104', 'taller de hardware', 'taller', 'examen', '1', '3 hs', 'anual', 1),
('a105', 'expresion oral y escrita 1', 'materia/asignatura', 'promocional', '1', '2 hs', 'primer cuatrimestre', 1),
('a201', 'analisis de sistemas', 'materia/asignatura', 'promocional', '2', '4 hs', 'anual', 1),
('a202', 'analisis matematico', 'materia/asignatura', 'promocional', '2', '3 hs', 'anual', 1),
('a203', 'programacion orientada a objetos', 'materia/asignatura', 'promocional', '2', '3 hs', 'anual', 1),
('a204', 'expresion oral y escrita 2', 'materia/asignatura', 'promocional', '2', '2 hs', 'primer cuatrimestre', 1),
('a301', 'seminario de aplicacion', 'materia/asignatura', 'promocional', '3', '3 hs', 'anual', 1),
('c111', 'logica', 'materia/asignatura', 'promocional', '1', '3 hs', 'primer cuatrimestre', 1),
('c112', 'introduccion a la computacion', 'materia/asignatura', 'promocional', '1', '3 hs', 'primer cuatrimestre', 1),
('c113', 'introduccion a la programacion', 'materia/asignatura', 'promocional', '1', '4 hs', 'primer cuatrimestre', 1),
('c114', 'arquitectura de ordenadores personales', 'materia/asignatura', 'promocional', '1', '4 hs', 'primer cuatrimestre', 1),
('c121', 'contabilidad', 'materia/asignatura', 'promocional', '1', '3 hs', 'segundo cuatrimestre', 1),
('c122', 'fundamentos de electronica', 'materia/asignatura', 'promocional', '1', '4 hs', 'segundo cuatrimestre', 1),
('c123', 'lenguajes 1', 'materia/asignatura', 'promocional', '1', '4 hs', 'segundo cuatrimestre', 1),
('c124', 'taller de software', 'taller', 'examen', '1', '4 hs', 'segundo cuatrimestre', 1),
('c211', 'fundamentos de redes', 'materia/asignatura', 'promocional', '2', '4 hs', 'primer cuatrimestre', 1),
('c212', 'base de datos', 'materia/asignatura', 'promocional', '2', '4 hs', 'primer cuatrimestre', 1),
('c213', 'estructura de datos', 'materia/asignatura', 'promocional', '2', '3 hs', 'primer cuatrimestre', 1),
('c214', 'introduccion a la economia', 'materia/asignatura', 'promocional', '2', '3 hs', 'primer cuatrimestre', 1),
('c215', 'pasantias 1', 'pasantia', '-', '2', '4 hs', 'primer cuatrimestre', 1),
('c221', 'estadistica y probabilidad', 'materia/asignatura', 'promocional', '2', '4 hs', 'segundo cuatrimestre', 1),
('c222', 'lenguajes 2', 'materia/asignatura', 'promocional', '2', '4 hs', 'segundo cuatrimestre', 1),
('c223', 'matematica aplicada', 'materia/asignatura', 'promocional', '2', '3 hs', 'segundo cuatrimestre', 1),
('c224', 'matematica financiera', 'materia/asignatura', 'promocional', '2', '3 hs', 'segundo cuatrimestre', 1),
('c225', 'taller de redes', 'taller', 'examen', '2', '4 hs', 'segundo cuatrimestre', 1),
('c311', 'recursos humanos', 'materia/asignatura', 'promocional', '3', '3 hs', 'primer cuatrimestre', 1),
('c312', 'diseno de sistemas', 'materia/asignatura', 'promocional', '3', '4 hs', 'primer cuatrimestre', 1),
('c313', 'organizacion y metodos', 'materia/asignatura', 'promocional', '3', '3 hs', 'primer cuatrimestre', 1),
('c314', 'inteligencia artificial', 'materia/asignatura', 'promocional', '3', '3 hs', 'primer cuatrimestre', 1),
('c315', 'administracion de la produccion', 'materia/asignatura', 'promocional', '3', '3 hs', 'primer cuatrimestre', 1),
('c316', 'programacion web', 'materia/asignatura', 'promocional', '3', '4 hs', 'primer cuatrimestre', 1),
('c321', 'taller de paginas web', 'taller', 'promocional', '3', '4 hs', 'segundo cuatrimestre', 1),
('c322', 'ingenieria del software', 'materia/asignatura', 'promocional', '3', '4 hs', 'segundo cuatrimestre', 1),
('c323', 'modelos y simulacion', 'materia/asignatura', 'promocional', '3', '3 hs', 'segundo cuatrimestre', 1),
('c324', 'marketing', 'materia/asignatura', 'promocional', '3', '3 hs', 'segundo cuatrimestre', 1),
('c325', 'finanzas', 'materia/asignatura', 'promocional', '3', '3 hs', 'segundo cuatrimestre', 1),
('c326', 'etica', 'materia/asignatura', 'promocional', '3', '3 hs', 'segundo cuatrimestre', 1),
('c327', 'pasantias 2', 'pasantia', 'promocional', '3', '4 hs', 'segundo cuatrimestre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_por_comision`
--

CREATE TABLE `materias_por_comision` (
  `cod_materia` varchar(10) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `cargo_docente` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias_por_comision`
--

INSERT INTO `materias_por_comision` (`cod_materia`, `id_docente`, `id_comision`, `cargo_docente`) VALUES
('a101', 5, 1, 'titular'),
('a101', 5, 2, 'titular'),
('a102', 4, 1, 'titular'),
('a102', 4, 2, 'titular'),
('a103', 2, 1, 'titular'),
('a103', 13, 2, 'titular'),
('a104', 3, 1, 'titular'),
('a104', 3, 2, 'titular'),
('a105', 4, 1, 'interino'),
('a105', 4, 2, 'interino'),
('a201', 14, 1, 'titular'),
('a202', 5, 1, 'titular'),
('a203', 7, 1, 'titular'),
('a204', 4, 1, 'interino'),
('a301', 9, 1, 'titular'),
('c111', 5, 1, 'interino'),
('c111', 5, 2, 'interino'),
('c112', 1, 1, 'interino'),
('c112', 1, 2, 'interino'),
('c113', 7, 1, 'interino'),
('c113', 7, 2, 'interino'),
('c114', 3, 1, 'interino'),
('c114', 3, 2, 'interino'),
('c121', 6, 1, 'interino'),
('c121', 9, 2, 'interino'),
('c122', 3, 1, 'interino'),
('c122', 3, 2, 'interino'),
('c123', 1, 2, 'interino'),
('c123', 7, 1, 'interino'),
('c124', 7, 1, 'interino'),
('c124', 15, 2, 'interino'),
('c211', 13, 1, 'interino'),
('c212', 14, 1, 'interino'),
('c213', 1, 1, 'interino'),
('c214', 6, 1, 'interino'),
('c215', 9, 1, 'interino'),
('c221', 8, 1, 'interino'),
('c222', 7, 1, 'interino'),
('c223', 11, 1, 'interino'),
('c224', 6, 1, 'interino'),
('c225', 13, 1, 'interino'),
('c311', 9, 1, 'interino'),
('c312', 14, 1, 'interino'),
('c313', 9, 1, 'interino'),
('c314', 11, 1, 'interino'),
('c315', 9, 1, 'interino'),
('c316', 15, 1, 'interino'),
('c321', 15, 1, 'interino'),
('c322', 14, 1, 'interino'),
('c323', 11, 1, 'interino'),
('c324', 10, 1, 'interino'),
('c325', 6, 1, 'interino'),
('c326', 12, 1, 'interino'),
('c327', 9, 1, 'interino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas_examen`
--

CREATE TABLE `mesas_examen` (
  `id_mesa` int(11) NOT NULL,
  `fecha_mesa` date NOT NULL,
  `hora_examen` time NOT NULL,
  `docente_titular` int(11) NOT NULL,
  `cod_materia` varchar(10) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `priemra_vocal` int(11) NOT NULL,
  `segunda_vocal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_alumnos`
--

CREATE TABLE `notas_alumnos` (
  `id_carrera` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cod_materia` varchar(10) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `nota` decimal(10,0) DEFAULT NULL,
  `instancia` varchar(100) NOT NULL,
  `condicion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_estudio`
--

CREATE TABLE `planes_estudio` (
  `id_planes_estudio` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `nombre_plan` varchar(200) NOT NULL,
  `id_carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes_estudio`
--

INSERT INTO `planes_estudio` (`id_planes_estudio`, `fecha_inicio`, `nombre_plan`, `id_carrera`) VALUES
(1, '2015-06-15', 'plan de estudios de programacion y analisis de sistemas', 1),
(2, '2017-06-16', 'plan de estudios de administracion de pequeñas y medianas empresas', 2),
(3, '2017-06-16', 'plan de estudios de diseño grafico digital', 4),
(4, '2023-08-23', 'plan de estudios de comercializacion y marketing', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'alumno'),
(2, 'secretaria'),
(3, 'preceptoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasenia` varchar(255) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `correo`, `contrasenia`, `usuario`, `id_rol`) VALUES
(1, 'martin.sanchez@example.com', '$2b$12$WA5q30JxLHgVw3EAs61PA.62EMGNyPDJXJ6TyBzffhO2HXazby/UW', '45190822', 1),
(2, 'mariana.gomez@example.com', '$2b$12$1j7BZAZ1qexyrO2NcYxwrOBNktD0hV2t86a2qzaOzG6ymIfypiDra', '45321987', 1),
(3, 'valentina.barrios@example.com', '$2b$12$PCvcmNnbINKlW3KuqYvnoOIqAa03Wx8gtmtb47cEWZDs8dCGVkhTO', '45988710', 1),
(4, 'lucas.pereira@example.com', '$2b$12$qF4AX5p.vEDF7HwBUzr0YuTOUJlqTBdWUOnVnY/kl3P/J/6d8kC02', '46852144', 1),
(5, 'sofia.fernandez@example.com', '$2b$12$IE8BLKi1l4ifAMKHez0zcu3i7/5kfYfbj6HgsevBqTEFdVMKSGH6u', '47200331', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrativos`
--
ALTER TABLE `administrativos`
  ADD PRIMARY KEY (`id_adm`),
  ADD KEY `Ref1441` (`id_user`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `Ref1440` (`id_user`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `correralatividades`
--
ALTER TABLE `correralatividades`
  ADD PRIMARY KEY (`id_correlatividad`),
  ADD KEY `Ref417` (`cod_materia`),
  ADD KEY `Ref418` (`materia_requerida`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `inscripciones_carrera`
--
ALTER TABLE `inscripciones_carrera`
  ADD PRIMARY KEY (`id_carrera`,`dni`),
  ADD KEY `Ref125` (`id_carrera`),
  ADD KEY `Ref526` (`dni`);

--
-- Indices de la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  ADD PRIMARY KEY (`id_carrera`,`dni`,`cod_materia`,`id_docente`,`id_comision`),
  ADD KEY `Ref327` (`dni`,`id_carrera`),
  ADD KEY `Ref1728` (`id_comision`,`id_docente`,`cod_materia`),
  ADD KEY `Refmaterias_por_comision28` (`cod_materia`,`id_docente`,`id_comision`);

--
-- Indices de la tabla `inscripciones_mesas`
--
ALTER TABLE `inscripciones_mesas`
  ADD PRIMARY KEY (`id_carrera`,`dni`,`cod_materia`,`id_docente`,`id_comision`,`id_mesa`),
  ADD KEY `Ref930` (`id_docente`,`cod_materia`,`dni`,`id_comision`,`id_carrera`),
  ADD KEY `Ref632` (`id_mesa`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`cod_materia`),
  ADD KEY `Ref216` (`id_planes_estudio`);

--
-- Indices de la tabla `materias_por_comision`
--
ALTER TABLE `materias_por_comision`
  ADD PRIMARY KEY (`cod_materia`,`id_docente`,`id_comision`),
  ADD KEY `Ref422` (`cod_materia`),
  ADD KEY `Ref1023` (`id_docente`),
  ADD KEY `Ref724` (`id_comision`);

--
-- Indices de la tabla `mesas_examen`
--
ALTER TABLE `mesas_examen`
  ADD PRIMARY KEY (`id_mesa`),
  ADD KEY `Ref1735` (`cod_materia`,`id_comision`,`docente_titular`),
  ADD KEY `Ref1036` (`priemra_vocal`),
  ADD KEY `Ref1037` (`segunda_vocal`);

--
-- Indices de la tabla `notas_alumnos`
--
ALTER TABLE `notas_alumnos`
  ADD PRIMARY KEY (`id_carrera`,`dni`,`cod_materia`,`id_docente`,`id_comision`),
  ADD KEY `Ref929` (`id_comision`,`id_carrera`,`id_docente`,`cod_materia`,`dni`);

--
-- Indices de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  ADD PRIMARY KEY (`id_planes_estudio`),
  ADD KEY `Ref115` (`id_carrera`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `Ref1321` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrativos`
--
ALTER TABLE `administrativos`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `correralatividades`
--
ALTER TABLE `correralatividades`
  MODIFY `id_correlatividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `inscripciones_carrera`
--
ALTER TABLE `inscripciones_carrera`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripciones_mesas`
--
ALTER TABLE `inscripciones_mesas`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas_examen`
--
ALTER TABLE `mesas_examen`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  MODIFY `id_planes_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativos`
--
ALTER TABLE `administrativos`
  ADD CONSTRAINT `Refusuarios41` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `Refusuarios40` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_user`);

--
-- Filtros para la tabla `correralatividades`
--
ALTER TABLE `correralatividades`
  ADD CONSTRAINT `Refmaterias17` FOREIGN KEY (`cod_materia`) REFERENCES `materias` (`cod_materia`),
  ADD CONSTRAINT `Refmaterias18` FOREIGN KEY (`materia_requerida`) REFERENCES `materias` (`cod_materia`);

--
-- Filtros para la tabla `inscripciones_carrera`
--
ALTER TABLE `inscripciones_carrera`
  ADD CONSTRAINT `Refalumnos26` FOREIGN KEY (`dni`) REFERENCES `alumnos` (`dni`),
  ADD CONSTRAINT `Refcarreras25` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `inscripciones_materias`
--
ALTER TABLE `inscripciones_materias`
  ADD CONSTRAINT `Refinscripciones_carrera27` FOREIGN KEY (`id_carrera`,`dni`) REFERENCES `inscripciones_carrera` (`id_carrera`, `dni`),
  ADD CONSTRAINT `Refmaterias_por_comision28` FOREIGN KEY (`cod_materia`,`id_docente`,`id_comision`) REFERENCES `materias_por_comision` (`cod_materia`, `id_docente`, `id_comision`);

--
-- Filtros para la tabla `inscripciones_mesas`
--
ALTER TABLE `inscripciones_mesas`
  ADD CONSTRAINT `Refinscripciones_materias30` FOREIGN KEY (`id_carrera`,`dni`,`cod_materia`,`id_docente`,`id_comision`) REFERENCES `inscripciones_materias` (`id_carrera`, `dni`, `cod_materia`, `id_docente`, `id_comision`),
  ADD CONSTRAINT `Refmesas_examen32` FOREIGN KEY (`id_mesa`) REFERENCES `mesas_examen` (`id_mesa`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `Refplanes_estudio16` FOREIGN KEY (`id_planes_estudio`) REFERENCES `planes_estudio` (`id_planes_estudio`);

--
-- Filtros para la tabla `materias_por_comision`
--
ALTER TABLE `materias_por_comision`
  ADD CONSTRAINT `Refcomisiones24` FOREIGN KEY (`id_comision`) REFERENCES `comisiones` (`id_comision`),
  ADD CONSTRAINT `Refdocentes23` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `Refmaterias22` FOREIGN KEY (`cod_materia`) REFERENCES `materias` (`cod_materia`);

--
-- Filtros para la tabla `mesas_examen`
--
ALTER TABLE `mesas_examen`
  ADD CONSTRAINT `Refdocentes36` FOREIGN KEY (`priemra_vocal`) REFERENCES `docentes` (`id_docente`);

--
-- Filtros para la tabla `planes_estudio`
--
ALTER TABLE `planes_estudio`
  ADD CONSTRAINT `planes_estudio_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
