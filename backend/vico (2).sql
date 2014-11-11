-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2014 a las 05:38:51
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `vico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formado_por`
--

CREATE TABLE IF NOT EXISTS `formado_por` (
  `idpunto` varchar(100) NOT NULL,
  `idtramo` varchar(100) NOT NULL,
  `idparada` varchar(100) NOT NULL,
  `orden` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE IF NOT EXISTS `linea` (
  `idlinea` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo_transporte` varchar(20) NOT NULL,
  `idsindicato` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idlinea`, `nombre`, `tipo_transporte`, `idsindicato`) VALUES
('1', 'cotranstur', 'Minibus', '1'),
('2', 'teleferico-ruta roja', 'Teleferico', '6'),
('3', '663', 'Minibus', '3'),
('4', 'parada x', 'Micro', '2'),
('5', 'bus-frd', 'Bus', '4'),
('6', 'pepelucho', 'Micro', '5'),
('7', 'rata buchera', 'Micro', '4'),
('', '', '', ''),
('1', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres`
--

CREATE TABLE IF NOT EXISTS `nombres` (
  `nick` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nombres`
--

INSERT INTO `nombres` (`nick`) VALUES
('juan'),
('carlos'),
('carlos'),
('carlos'),
('maria'),
('martha'),
('abraham'),
('pedro'),
('arturo'),
('vico'),
('wilson'),
('wilson'),
('arturo'),
('mijael'),
('jose'),
('carol'),
('francisco'),
('yoselin'),
('marcos'),
('pedro'),
('magiver'),
('adrian'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('rodilfito'),
('marcos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parada`
--

CREATE TABLE IF NOT EXISTS `parada` (
  `idparada` varchar(100) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parada`
--

INSERT INTO `parada` (`idparada`, `latitud`, `longitud`) VALUES
('1', -16.497069434938645, -68.16055297851562),
('2', -16.507109457733225, -68.1525707244873),
('3', -16.512705309753507, -68.1438159942627),
('4', -16.518465576423313, -68.13797950744629),
('5', -16.501842625522446, -68.15900802612305),
('6', -16.50266557751112, -68.15317153930664),
('7', -16.50225410195451, -68.14810752868652),
('8', -16.51731353682677, -68.1617546081543),
('9', -16.518712441157437, -68.15857887268066),
('10', -16.52142793241249, -68.15282821655273),
('11', -16.507767801672525, -68.15875053405762),
('12', -16.51081261322927, -68.15531730651855),
('13', -16.514515697780816, -68.15531730651855),
('14', -16.51484485741823, -68.15926551818848),
('15', -16.5033239365807, -68.15754890441895),
('16', -16.504558353795105, -68.1511116027832),
('17', -16.508426143370006, -68.14973831176758),
('18', -16.524883956980403, -68.16458702087402),
('19', -16.528422203773886, -68.16132545471191),
('20', -16.53113755850192, -68.15488815307617),
('21', -16.533935156758893, -68.15608978271484),
('22', -16.536403592134644, -68.15995216369629),
('23', -16.538954275519085, -68.16647529602051),
('24', -16.532124950751918, -68.16587448120117),
('25', -16.53566306483702, -68.16784858703613),
('26', -16.54101125368762, -68.17299842834473),
('27', -16.49945604495348, -68.15840721130371),
('28', -16.503570820653955, -68.1533432006836),
('29', -16.50941365171261, -68.15128326416016),
('30', -16.49040323032578, -68.18201065063477),
('31', -16.49262532404615, -68.17703247070312),
('32', -16.496164161368878, -68.17497253417969);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto`
--

CREATE TABLE IF NOT EXISTS `punto` (
  `idpunto` varchar(100) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sindicato`
--

CREATE TABLE IF NOT EXISTS `sindicato` (
  `idsindicato` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sindicato`
--

INSERT INTO `sindicato` (`idsindicato`, `nombre`, `direccion`, `telefono`) VALUES
('1', 'cotrastur', 'aeropueto el alto', '1234567'),
('2', 'seÃ±or de mayo', '14 de septiembre el alto', '7894561'),
('3', '21de septiembre', 'santiago segundo calle 23', '7894561'),
('4', '14 de septiembre', 'ceja el alto', '7894563'),
('5', 'lapaz bus', 'lapaz centro urvano', '32114569'),
('6', 'Alcaldia de lapaz', 'centro urbano', '6547891');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE IF NOT EXISTS `tiene` (
  `idtramo` varchar(100) NOT NULL,
  `idparada` varchar(100) NOT NULL,
  `tiempo` double NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `trazo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiene`
--

INSERT INTO `tiene` (`idtramo`, `idparada`, `tiempo`, `tipo`, `trazo`) VALUES
('1', '1', 0, '', 'ruta'),
('1', '2', 6.6, '', 'ruta'),
('1', '3', 13.55, '', 'ruta'),
('1', '4', 17.733333333333334, '', 'ruta'),
('2', '5', 0, '', 'ruta'),
('2', '6', 2.6166666666666667, '', 'ruta'),
('2', '7', 4.75, '', 'ruta'),
('3', '8', 0, '', 'ruta'),
('3', '9', 1.55, '', 'ruta'),
('3', '10', 9.216666666666667, '', 'ruta'),
('4', '11', 0, '', 'ruta'),
('4', '12', 2.066666666666667, '', 'ruta'),
('4', '13', 3.55, '', 'ruta'),
('4', '14', 6.3, '', 'ruta'),
('5', '15', 0, '', 'ruta'),
('5', '16', 2.8333333333333335, '', 'ruta'),
('5', '17', 5.1, '', 'ruta'),
('6', '18', 0, '', 'ruta'),
('6', '19', 3.3833333333333333, '', 'ruta'),
('6', '20', 9.45, '', 'ruta'),
('7', '21', 0, '', 'ruta'),
('7', '22', 2.4, '', 'ruta'),
('7', '23', 5.533333333333333, '', 'ruta'),
('8', '24', 0, '', 'ruta'),
('8', '25', 1.15, '', 'ruta'),
('8', '26', 4.233333333333333, '', 'ruta'),
('9', '27', 0, '', 'ruta'),
('9', '28', 3.033333333333333, '', 'ruta'),
('9', '29', 6.05, '', 'ruta'),
('10', '30', 0, '', 'ruta'),
('10', '31', 1.7166666666666666, '', 'ruta'),
('10', '32', 4.65, '', 'ruta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo`
--

CREATE TABLE IF NOT EXISTS `tramo` (
  `idtramo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tramo`
--

INSERT INTO `tramo` (`idtramo`) VALUES
('1'),
('2'),
('3'),
('4'),
('5'),
('6'),
('7'),
('8'),
('9'),
('10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
