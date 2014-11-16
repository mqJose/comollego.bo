drop database IF EXISTS vico;

CREATE DATABASE  IF NOT EXISTS `vico`;

USE `vico`;

-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-11-2014 a las 23:08:49
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.4.4-14+deb7u11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `contiene`
--

CREATE TABLE IF NOT EXISTS `contiene` (
  `idlinea` varchar(100) NOT NULL,
  `idtramo` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`idlinea`, `idtramo`, `orden`) VALUES
('1', '1', 0),
('1', '2', 1),
('2', '3', 0),
('3', '2', 0),
('4', '1', 0),
('5', '1', 0),
('5', '3', 1),
('6', '5', 0),
('6', '6', 1),
('6', '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formado_por`
--

CREATE TABLE IF NOT EXISTS `formado_por` (
  `idpunto` varchar(100) NOT NULL,
  `idtramo` varchar(100) NOT NULL,
  `idparada` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formado_por`
--

INSERT INTO `formado_por` (`idpunto`, `idtramo`, `idparada`, `orden`) VALUES
('0', '1', '2', 0),
('1', '1', '2', 1),
('2', '1', '2', 2),
('3', '1', '2', 3),
('4', '1', '3', 4),
('5', '1', '3', 5),
('6', '1', '3', 6),
('7', '1', '4', 7),
('8', '1', '4', 8),
('9', '1', '4', 9),
('10', '1', '4', 10),
('11', '1', '5', 11),
('12', '1', '5', 12),
('13', '1', '5', 13),
('14', '1', '5', 14),
('15', '1', '6', 15),
('16', '1', '6', 16),
('17', '1', '6', 17),
('18', '1', '6', 18),
('19', '1', '6', 19),
('20', '1', '6', 20),
('21', '1', '6', 21),
('22', '1', '6', 22),
('23', '1', '6', 23),
('24', '1', '6', 24),
('25', '1', '6', 25),
('26', '2', '7', 0),
('27', '2', '7', 1),
('28', '2', '7', 2),
('29', '2', '7', 3),
('30', '2', '7', 4),
('31', '2', '7', 5),
('32', '2', '7', 6),
('33', '2', '7', 7),
('34', '2', '7', 8),
('35', '2', '8', 9),
('36', '2', '8', 10),
('37', '2', '8', 11),
('38', '2', '8', 12),
('39', '2', '8', 13),
('40', '2', '8', 14),
('41', '2', '9', 15),
('42', '2', '9', 16),
('43', '2', '9', 17),
('44', '2', '9', 18),
('45', '2', '9', 19),
('46', '2', '9', 20),
('47', '3', '11', 0),
('48', '3', '11', 1),
('49', '3', '11', 2),
('50', '3', '11', 3),
('51', '3', '11', 4),
('52', '3', '11', 5),
('53', '3', '11', 6),
('54', '3', '11', 7),
('55', '3', '11', 8),
('56', '3', '11', 9),
('57', '3', '12', 10),
('58', '3', '12', 11),
('59', '3', '13', 12),
('60', '3', '13', 13),
('61', '3', '13', 14),
('62', '3', '13', 15),
('63', '3', '14', 16),
('64', '3', '14', 17),
('65', '3', '14', 18),
('66', '3', '14', 19),
('67', '3', '14', 20),
('68', '3', '14', 21),
('69', '3', '14', 22),
('70', '3', '14', 23),
('71', '3', '14', 24),
('72', '3', '15', 25),
('73', '3', '15', 26),
('74', '3', '15', 27),
('75', '3', '15', 28),
('76', '3', '15', 29),
('77', '3', '15', 30),
('78', '3', '15', 31),
('79', '3', '15', 32),
('80', '3', '15', 33),
('81', '3', '15', 34),
('82', '3', '15', 35),
('83', '4', '17', 0),
('84', '4', '17', 1),
('85', '4', '17', 2),
('86', '4', '17', 3),
('87', '4', '17', 4),
('88', '4', '17', 5),
('89', '4', '17', 6),
('90', '4', '17', 7),
('91', '4', '17', 8),
('92', '4', '17', 9),
('93', '4', '17', 10),
('94', '4', '17', 11),
('95', '4', '17', 12),
('96', '4', '17', 13),
('97', '4', '17', 14),
('98', '4', '17', 15),
('99', '4', '17', 16),
('100', '4', '17', 17),
('101', '4', '17', 18),
('102', '4', '17', 19),
('103', '4', '17', 20),
('104', '4', '17', 21),
('105', '4', '17', 22),
('106', '4', '17', 23),
('107', '4', '17', 24),
('108', '4', '17', 25),
('109', '4', '17', 26),
('110', '4', '18', 27),
('111', '4', '18', 28),
('112', '4', '19', 29),
('113', '4', '19', 30),
('114', '4', '19', 31),
('115', '4', '19', 32),
('116', '4', '20', 33),
('117', '4', '20', 34),
('118', '4', '20', 35),
('119', '4', '20', 36),
('120', '4', '20', 37),
('121', '4', '20', 38),
('122', '4', '20', 39),
('123', '4', '20', 40),
('124', '4', '20', 41),
('125', '4', '20', 42),
('126', '4', '21', 43),
('127', '4', '21', 44),
('128', '4', '21', 45),
('129', '4', '21', 46),
('130', '4', '21', 47),
('131', '4', '21', 48),
('132', '4', '21', 49),
('133', '4', '21', 50),
('134', '4', '21', 51),
('135', '4', '21', 52),
('136', '4', '21', 53),
('137', '4', '21', 54),
('138', '4', '21', 55),
('139', '4', '21', 56),
('140', '4', '21', 57),
('141', '4', '21', 58),
('142', '4', '21', 59),
('143', '4', '22', 60),
('144', '4', '22', 61),
('145', '4', '22', 62),
('146', '4', '22', 63),
('147', '4', '22', 64),
('148', '4', '22', 65),
('149', '4', '23', 66),
('150', '4', '23', 67),
('151', '4', '23', 68),
('152', '4', '23', 69),
('153', '4', '23', 70),
('154', '4', '23', 71),
('155', '4', '23', 72),
('156', '4', '23', 73),
('157', '4', '23', 74),
('158', '4', '24', 75),
('159', '4', '24', 76),
('160', '4', '24', 77),
('161', '4', '24', 78),
('162', '4', '24', 79),
('163', '4', '24', 80),
('164', '4', '25', 81),
('165', '4', '25', 82),
('166', '4', '25', 83),
('167', '4', '25', 84),
('168', '4', '26', 85),
('169', '4', '26', 86),
('170', '4', '26', 87),
('171', '4', '26', 88),
('172', '4', '27', 89),
('173', '4', '27', 90),
('174', '4', '27', 91),
('175', '4', '27', 92),
('176', '4', '27', 93),
('177', '4', '27', 94),
('178', '4', '27', 95),
('179', '4', '27', 96),
('180', '4', '27', 97),
('181', '4', '27', 98),
('182', '5', '29', 0),
('183', '5', '29', 1),
('184', '5', '30', 2),
('185', '5', '30', 3),
('186', '5', '30', 4),
('187', '5', '30', 5),
('188', '5', '31', 6),
('189', '5', '31', 7),
('190', '5', '32', 8),
('191', '5', '32', 9),
('192', '5', '32', 10),
('193', '5', '33', 11),
('194', '5', '33', 12),
('195', '5', '33', 13),
('196', '5', '33', 14),
('197', '5', '33', 15),
('198', '5', '33', 16),
('199', '5', '33', 17),
('200', '5', '33', 18),
('201', '5', '33', 19),
('202', '5', '33', 20),
('203', '5', '33', 21),
('204', '5', '33', 22),
('205', '5', '33', 23),
('206', '5', '33', 24),
('207', '5', '33', 25),
('208', '5', '33', 26),
('209', '5', '33', 27),
('210', '5', '33', 28),
('211', '5', '33', 29),
('212', '5', '33', 30),
('213', '5', '34', 31),
('214', '5', '34', 32),
('215', '5', '35', 33),
('216', '5', '35', 34),
('217', '5', '36', 35),
('218', '5', '36', 36),
('219', '5', '37', 37),
('220', '5', '37', 38),
('221', '5', '38', 39),
('222', '5', '38', 40),
('223', '5', '38', 41),
('224', '5', '38', 42),
('225', '5', '38', 43),
('226', '5', '39', 44),
('227', '5', '39', 45),
('228', '5', '39', 46),
('229', '5', '39', 47),
('230', '5', '39', 48),
('231', '5', '39', 49),
('232', '5', '39', 50),
('233', '5', '39', 51),
('234', '5', '39', 52),
('235', '5', '40', 53),
('236', '5', '40', 54),
('237', '5', '41', 55),
('238', '5', '41', 56),
('239', '5', '42', 57),
('240', '5', '42', 58),
('241', '5', '43', 59),
('242', '5', '43', 60),
('243', '5', '44', 61),
('244', '5', '44', 62),
('245', '5', '45', 63),
('246', '5', '45', 64),
('247', '5', '45', 65),
('248', '5', '46', 66),
('249', '5', '46', 67),
('250', '5', '47', 68),
('251', '5', '47', 69),
('252', '6', '48', 0),
('253', '6', '48', 1),
('254', '6', '48', 2),
('255', '6', '48', 3),
('256', '6', '48', 4),
('257', '6', '48', 5),
('258', '6', '48', 6),
('259', '6', '49', 7),
('260', '6', '49', 8),
('261', '6', '49', 9),
('262', '6', '49', 10),
('263', '6', '50', 11),
('264', '6', '50', 12),
('265', '6', '50', 13),
('266', '6', '50', 14),
('267', '6', '50', 15),
('268', '6', '50', 16),
('269', '6', '50', 17),
('270', '6', '50', 18),
('271', '6', '50', 19),
('272', '6', '51', 20),
('273', '6', '51', 21),
('274', '6', '51', 22),
('275', '6', '51', 23),
('276', '6', '51', 24),
('277', '6', '51', 25),
('278', '6', '51', 26),
('279', '6', '51', 27),
('280', '6', '51', 28),
('281', '6', '51', 29),
('282', '6', '51', 30),
('283', '6', '51', 31),
('284', '6', '51', 32),
('285', '6', '51', 33),
('286', '6', '51', 34),
('287', '6', '51', 35),
('288', '6', '51', 36),
('289', '6', '51', 37),
('290', '6', '51', 38),
('291', '6', '51', 39),
('292', '6', '51', 40),
('293', '6', '51', 41),
('294', '6', '51', 42),
('295', '6', '51', 43),
('296', '6', '51', 44),
('297', '6', '51', 45),
('298', '6', '52', 46),
('299', '6', '52', 47),
('300', '6', '52', 48),
('301', '6', '52', 49),
('302', '6', '52', 50),
('303', '6', '52', 51),
('304', '6', '52', 52),
('305', '6', '52', 53),
('306', '6', '52', 54),
('307', '6', '52', 55),
('308', '6', '52', 56),
('309', '6', '52', 57),
('310', '6', '52', 58),
('311', '6', '52', 59),
('312', '6', '52', 60),
('313', '6', '52', 61),
('314', '6', '52', 62),
('315', '6', '52', 63),
('316', '6', '52', 64),
('317', '6', '52', 65),
('318', '6', '52', 66),
('319', '6', '52', 67),
('320', '6', '52', 68),
('321', '6', '52', 69),
('322', '6', '52', 70),
('323', '6', '52', 71),
('324', '6', '52', 72),
('325', '6', '52', 73),
('326', '6', '52', 74),
('327', '6', '52', 75),
('328', '6', '52', 76),
('329', '6', '52', 77),
('330', '6', '52', 78),
('331', '6', '52', 79),
('332', '6', '52', 80),
('333', '6', '52', 81),
('334', '6', '52', 82),
('335', '6', '52', 83),
('336', '6', '52', 84),
('337', '6', '52', 85),
('338', '6', '52', 86),
('339', '6', '52', 87),
('340', '6', '52', 88),
('341', '6', '52', 89),
('342', '6', '52', 90),
('343', '6', '52', 91),
('344', '6', '52', 92),
('345', '6', '52', 93),
('346', '6', '52', 94),
('347', '6', '52', 95),
('348', '6', '52', 96),
('349', '6', '52', 97),
('350', '6', '52', 98),
('351', '6', '52', 99),
('352', '6', '52', 100),
('353', '6', '52', 101),
('354', '6', '52', 102),
('355', '6', '52', 103),
('356', '6', '52', 104),
('357', '6', '52', 105),
('358', '6', '52', 106),
('359', '6', '52', 107),
('360', '6', '52', 108),
('361', '6', '52', 109),
('362', '6', '53', 110),
('363', '6', '53', 111),
('364', '6', '53', 112),
('365', '6', '53', 113),
('366', '6', '53', 114),
('367', '6', '53', 115),
('368', '6', '53', 116),
('369', '6', '53', 117),
('370', '6', '53', 118),
('371', '6', '53', 119),
('372', '6', '53', 120),
('373', '6', '53', 121),
('374', '6', '53', 122),
('375', '6', '54', 123),
('376', '6', '54', 124),
('377', '6', '54', 125),
('378', '6', '54', 126),
('379', '6', '54', 127),
('380', '6', '54', 128),
('381', '6', '54', 129),
('382', '6', '54', 130),
('383', '6', '54', 131),
('384', '6', '54', 132),
('385', '6', '54', 133),
('386', '6', '54', 134),
('387', '6', '54', 135),
('388', '6', '54', 136),
('389', '6', '55', 137),
('390', '6', '55', 138),
('391', '6', '55', 139),
('392', '6', '55', 140),
('393', '6', '55', 141),
('394', '6', '55', 142),
('395', '6', '55', 143),
('396', '6', '55', 144),
('397', '6', '55', 145),
('398', '6', '55', 146),
('399', '6', '55', 147),
('400', '6', '55', 148),
('401', '6', '55', 149),
('402', '6', '55', 150),
('403', '6', '55', 151),
('404', '6', '55', 152),
('405', '6', '55', 153),
('406', '6', '55', 154),
('407', '6', '55', 155),
('408', '6', '55', 156),
('409', '6', '55', 157),
('410', '6', '55', 158),
('411', '6', '55', 159),
('412', '6', '55', 160),
('413', '6', '55', 161),
('414', '6', '55', 162),
('415', '6', '55', 163),
('416', '6', '55', 164),
('417', '6', '55', 165),
('418', '6', '55', 166),
('419', '6', '55', 167),
('420', '6', '55', 168),
('421', '6', '55', 169),
('422', '6', '55', 170),
('423', '6', '55', 171),
('424', '6', '55', 172),
('425', '6', '55', 173),
('426', '6', '55', 174),
('427', '6', '55', 175),
('428', '6', '55', 176),
('429', '6', '55', 177),
('430', '6', '55', 178),
('431', '6', '55', 179),
('432', '6', '55', 180),
('433', '6', '55', 181),
('434', '6', '56', 182),
('435', '6', '56', 183),
('436', '6', '56', 184),
('437', '6', '56', 185),
('438', '6', '56', 186),
('439', '6', '56', 187),
('440', '6', '56', 188),
('441', '6', '57', 189),
('442', '6', '57', 190),
('443', '6', '57', 191),
('444', '6', '57', 192),
('445', '6', '58', 193),
('446', '6', '58', 194),
('447', '6', '58', 195),
('448', '6', '58', 196),
('449', '6', '58', 197),
('450', '6', '59', 198),
('451', '6', '59', 199),
('452', '6', '59', 200),
('453', '6', '59', 201),
('454', '6', '59', 202),
('455', '6', '59', 203),
('456', '6', '1', 204),
('457', '6', '1', 205),
('458', '6', '1', 206),
('459', '6', '1', 207),
('460', '6', '1', 208),
('461', '6', '1', 209),
('462', '6', '1', 210);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE IF NOT EXISTS `linea` (
  `idlinea` varchar(100) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo_transporte` varchar(20) NOT NULL,
  `idsindicato` varchar(20) NOT NULL,
  PRIMARY KEY (`idlinea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idlinea`, `nombre`, `tipo_transporte`, `idsindicato`) VALUES
('1', 'Linea 0001', 'Minibus', '1'),
('2', 'Linea 0002', 'Minibus', '1'),
('3', 'Linea 0003', 'Bus', '1'),
('4', 'Linea 0004', 'Minibus', '1'),
('5', 'Linea 005', 'Bus', '1'),
('6', 'Muy muy lejos', 'Minibus', '1');

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
('1', -16.495715845033462, -68.13689343642181),
('2', -16.497577827882115, -68.13613168906159),
('3', -16.4989563008772, -68.13520900916046),
('4', -16.500458208111613, -68.13398592180874),
('5', -16.502698161621296, -68.13205121079591),
('6', -16.504344054815466, -68.13121436158326),
('7', -16.50624110963241, -68.12893923377482),
('8', -16.509891153040815, -68.12539212383848),
('9', -16.511209515823403, -68.12409516413027),
('10', -16.503911160815967, -68.1313585863063),
('11', -16.50524329834459, -68.13181992625687),
('12', -16.506662863371997, -68.13282307226473),
('13', -16.508565887247297, -68.13471671215666),
('14', -16.511029503330157, -68.13431438080443),
('15', -16.513328507741008, -68.13426073662413),
('16', -16.498531136983715, -68.12219247211027),
('17', -16.493192059523896, -68.12131807197142),
('18', -16.491838007990147, -68.12140257497953),
('19', -16.487228679684165, -68.12160484487316),
('20', -16.482300808975854, -68.12194816779083),
('21', -16.47423488058055, -68.11783902325254),
('22', -16.47138497462145, -68.1189762805297),
('23', -16.46912148253839, -68.1182038043334),
('24', -16.46946100803619, -68.11938397629996),
('25', -16.471333531913164, -68.1209181993654),
('26', -16.47225949982886, -68.12198035429901),
('27', -16.473912544282246, -68.12014326475031),
('28', -16.52380997396528, -68.15124448345159),
('29', -16.522899682717195, -68.15348681051546),
('30', -16.52142880756604, -68.15741356451326),
('31', -16.519068183824313, -68.15640505408737),
('32', -16.51677439107587, -68.15535899240786),
('33', -16.514254273479413, -68.1563567741614),
('34', -16.512757616658448, -68.15724190321816),
('35', -16.51201699868712, -68.1576978787507),
('36', -16.51123008898301, -68.15816994757824),
('37', -16.510546040689636, -68.15857764334851),
('38', -16.509928851868224, -68.15860446547958),
('39', -16.509008208682477, -68.15953250979868),
('40', -16.50939909714159, -68.16034253708489),
('41', -16.51019630077735, -68.16171046335506),
('42', -16.510582043291752, -68.16164609066618),
('43', -16.510247732843155, -68.16265460092836),
('44', -16.509635686636845, -68.16452678282076),
('45', -16.508468164549992, -68.16421028248442),
('46', -16.50744464819802, -68.16387232414854),
('47', -16.506241109710892, -68.16348072130495),
('48', -16.502357846165644, -68.16250439738724),
('49', -16.500799375393957, -68.16269215218199),
('50', -16.497234904313252, -68.1635987385016),
('51', -16.48645365255494, -68.16703196636809),
('52', -16.462625781395065, -68.15192040012334),
('53', -16.46025415118678, -68.1472479920194),
('54', -16.462898439841837, -68.14998384521459),
('55', -16.488279719029187, -68.1442224602506),
('56', -16.490496693367085, -68.14084287689184),
('57', -16.49077445508744, -68.14014550254797),
('58', -16.492122115494347, -68.13795681999181),
('59', -16.492967811079783, -68.13732221267855);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto`
--

CREATE TABLE IF NOT EXISTS `punto` (
  `idpunto` varchar(100) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `punto`
--

INSERT INTO `punto` (`idpunto`, `latitud`, `longitud`) VALUES
('0', -16.495720000000002, -68.13689000000001),
('1', -16.49586, -68.13689000000001),
('2', -16.49602, -68.13686),
('3', -16.49756, -68.13609000000001),
('4', -16.49756, -68.13609000000001),
('5', -16.498160000000002, -68.13571),
('6', -16.49893, -68.13517),
('7', -16.49893, -68.13517),
('8', -16.49961, -68.1346),
('9', -16.500310000000002, -68.13405),
('10', -16.500410000000002, -68.13394000000001),
('11', -16.500410000000002, -68.13394000000001),
('12', -16.50092, -68.13333),
('13', -16.50176, -68.13267),
('14', -16.50268, -68.13202000000001),
('15', -16.50268, -68.13202000000001),
('16', -16.50328, -68.13162000000001),
('17', -16.50385, -68.13122),
('18', -16.503980000000002, -68.1311),
('19', -16.50399, -68.13113),
('20', -16.504, -68.13116000000001),
('21', -16.50403, -68.13121000000001),
('22', -16.504070000000002, -68.13123),
('23', -16.504160000000002, -68.13127),
('24', -16.504250000000003, -68.13125000000001),
('25', -16.50432, -68.13119),
('26', -16.50432, -68.13119),
('27', -16.504350000000002, -68.1311),
('28', -16.504340000000003, -68.13105),
('29', -16.504330000000003, -68.13102),
('30', -16.50432, -68.131),
('31', -16.50449, -68.13077000000001),
('32', -16.50545, -68.12973000000001),
('33', -16.50572, -68.12942000000001),
('34', -16.506220000000003, -68.12892000000001),
('35', -16.506220000000003, -68.12892000000001),
('36', -16.506960000000003, -68.12818),
('37', -16.507270000000002, -68.12777000000001),
('38', -16.50813, -68.12687000000001),
('39', -16.50879, -68.1263),
('40', -16.509880000000003, -68.12538),
('41', -16.509880000000003, -68.12538),
('42', -16.51011, -68.12518),
('43', -16.51049, -68.12490000000001),
('44', -16.5108, -68.12457),
('45', -16.51103, -68.12433),
('46', -16.51122, -68.1241),
('47', -16.50391, -68.13135000000001),
('48', -16.50404, -68.13121000000001),
('49', -16.504060000000003, -68.13123),
('50', -16.5041, -68.13125000000001),
('51', -16.50419, -68.13127),
('52', -16.50422, -68.13126000000001),
('53', -16.504340000000003, -68.13135000000001),
('54', -16.504730000000002, -68.13162000000001),
('55', -16.50522, -68.13180000000001),
('56', -16.50525, -68.13181),
('57', -16.50525, -68.13181),
('58', -16.50666, -68.13283000000001),
('59', -16.50666, -68.13283000000001),
('60', -16.50766, -68.13391),
('61', -16.508480000000002, -68.13471000000001),
('62', -16.508570000000002, -68.13471000000001),
('63', -16.508570000000002, -68.13471000000001),
('64', -16.50918, -68.13461000000001),
('65', -16.50927, -68.13462000000001),
('66', -16.509520000000002, -68.13473),
('67', -16.509590000000003, -68.13475000000001),
('68', -16.50977, -68.13474000000001),
('69', -16.51024, -68.13465000000001),
('70', -16.510650000000002, -68.13453000000001),
('71', -16.511020000000002, -68.13431),
('72', -16.511020000000002, -68.13431),
('73', -16.511380000000003, -68.13413),
('74', -16.511750000000003, -68.134),
('75', -16.51244, -68.13365),
('76', -16.512600000000003, -68.13355),
('77', -16.512800000000002, -68.13350000000001),
('78', -16.512890000000002, -68.13350000000001),
('79', -16.513060000000003, -68.13358000000001),
('80', -16.51323, -68.13373),
('81', -16.51331, -68.13395),
('82', -16.51332, -68.13426000000001),
('83', -16.498530000000002, -68.12219),
('84', -16.498450000000002, -68.12231),
('85', -16.49839, -68.12243000000001),
('86', -16.49836, -68.12258),
('87', -16.498350000000002, -68.12273),
('88', -16.49838, -68.12291),
('89', -16.49841, -68.12298000000001),
('90', -16.49832, -68.12304),
('91', -16.49821, -68.12309),
('92', -16.49705, -68.12313),
('93', -16.496090000000002, -68.12313),
('94', -16.49592, -68.12313),
('95', -16.494960000000003, -68.12207000000001),
('96', -16.49465, -68.12176000000001),
('97', -16.494600000000002, -68.12169),
('98', -16.494570000000003, -68.1216),
('99', -16.494570000000003, -68.12151),
('100', -16.494590000000002, -68.12144),
('101', -16.49461, -68.12138),
('102', -16.49456, -68.12126),
('103', -16.49452, -68.12121),
('104', -16.49446, -68.12117),
('105', -16.49436, -68.12117),
('106', -16.49427, -68.12121),
('107', -16.49423, -68.12125),
('108', -16.494220000000002, -68.12127000000001),
('109', -16.493190000000002, -68.12133),
('110', -16.493190000000002, -68.12133),
('111', -16.49184, -68.12139),
('112', -16.49184, -68.12139),
('113', -16.49005, -68.12146),
('114', -16.48902, -68.12153),
('115', -16.48723, -68.1216),
('116', -16.48723, -68.1216),
('117', -16.48505, -68.12171000000001),
('118', -16.485030000000002, -68.12105000000001),
('119', -16.48385, -68.12111),
('120', -16.48357, -68.12118000000001),
('121', -16.483410000000003, -68.12129),
('122', -16.48327, -68.12146),
('123', -16.48319, -68.12163000000001),
('124', -16.483130000000003, -68.12190000000001),
('125', -16.482310000000002, -68.12193),
('126', -16.482310000000002, -68.12193),
('127', -16.48213, -68.12191),
('128', -16.48189, -68.12185000000001),
('129', -16.48121, -68.1216),
('130', -16.48, -68.12115),
('131', -16.47971, -68.12101000000001),
('132', -16.478440000000003, -68.12029000000001),
('133', -16.47623, -68.11897),
('134', -16.475080000000002, -68.11828),
('135', -16.47511, -68.11818000000001),
('136', -16.4751, -68.11807),
('137', -16.475060000000003, -68.11800000000001),
('138', -16.474890000000002, -68.1179),
('139', -16.474780000000003, -68.11789),
('140', -16.474700000000002, -68.11792000000001),
('141', -16.47463, -68.11801000000001),
('142', -16.47426, -68.11779),
('143', -16.47426, -68.11779),
('144', -16.4739, -68.11757),
('145', -16.47343, -68.11836000000001),
('146', -16.47326, -68.11854000000001),
('147', -16.473010000000002, -68.1187),
('148', -16.471390000000003, -68.11896),
('149', -16.471390000000003, -68.11896),
('150', -16.47106, -68.11898000000001),
('151', -16.47078, -68.11891),
('152', -16.47054, -68.11877000000001),
('153', -16.470360000000003, -68.11855),
('154', -16.470200000000002, -68.11826),
('155', -16.4696, -68.11847),
('156', -16.4695, -68.11813000000001),
('157', -16.46912, -68.11818000000001),
('158', -16.46912, -68.11818000000001),
('159', -16.468870000000003, -68.11822000000001),
('160', -16.469050000000003, -68.11882),
('161', -16.4691, -68.11895000000001),
('162', -16.469260000000002, -68.11921000000001),
('163', -16.46947, -68.11937),
('164', -16.46947, -68.11937),
('165', -16.470940000000002, -68.12049),
('166', -16.47109, -68.12053),
('167', -16.471330000000002, -68.12089),
('168', -16.471330000000002, -68.12089),
('169', -16.471, -68.12111),
('170', -16.47137, -68.12138),
('171', -16.472260000000002, -68.12198000000001),
('172', -16.472260000000002, -68.12198000000001),
('173', -16.47249, -68.12217000000001),
('174', -16.472620000000003, -68.12196),
('175', -16.47269, -68.12186000000001),
('176', -16.472810000000003, -68.12168000000001),
('177', -16.47303, -68.12154000000001),
('178', -16.47321, -68.12142),
('179', -16.47362, -68.12099),
('180', -16.47401, -68.12073000000001),
('181', -16.473930000000003, -68.12014),
('182', -16.52381, -68.15125),
('183', -16.522910000000003, -68.15349),
('184', -16.522910000000003, -68.15349),
('185', -16.52203, -68.15576),
('186', -16.521600000000003, -68.15690000000001),
('187', -16.521420000000003, -68.15742),
('188', -16.521420000000003, -68.15742),
('189', -16.519070000000003, -68.1564),
('190', -16.519070000000003, -68.1564),
('191', -16.51756, -68.15575000000001),
('192', -16.51677, -68.15538000000001),
('193', -16.51677, -68.15538000000001),
('194', -16.51624, -68.15517000000001),
('195', -16.51631, -68.15508000000001),
('196', -16.51633, -68.15497),
('197', -16.51632, -68.15483),
('198', -16.516280000000002, -68.15473),
('199', -16.516170000000002, -68.15463000000001),
('200', -16.5161, -68.15459),
('201', -16.516000000000002, -68.15458000000001),
('202', -16.51584, -68.15463000000001),
('203', -16.51574, -68.15471000000001),
('204', -16.51563, -68.15483),
('205', -16.51556, -68.15499000000001),
('206', -16.515520000000002, -68.15511000000001),
('207', -16.515530000000002, -68.15524),
('208', -16.51558, -68.15533),
('209', -16.515620000000002, -68.15538000000001),
('210', -16.51556, -68.15549),
('211', -16.51538, -68.15570000000001),
('212', -16.51427, -68.15636),
('213', -16.51427, -68.15636),
('214', -16.51275, -68.15724),
('215', -16.51275, -68.15724),
('216', -16.512030000000003, -68.1577),
('217', -16.512030000000003, -68.1577),
('218', -16.51123, -68.15817000000001),
('219', -16.51123, -68.15817000000001),
('220', -16.510550000000002, -68.15859),
('221', -16.510530000000003, -68.1586),
('222', -16.510160000000003, -68.1588),
('223', -16.51011, -68.15872),
('224', -16.50995, -68.15861000000001),
('225', -16.50993, -68.1586),
('226', -16.50993, -68.1586),
('227', -16.50976, -68.15857000000001),
('228', -16.50958, -68.15862),
('229', -16.50944, -68.15872),
('230', -16.50935, -68.15886),
('231', -16.509310000000003, -68.15902000000001),
('232', -16.509320000000002, -68.15919000000001),
('233', -16.50935, -68.15927),
('234', -16.50899, -68.15952),
('235', -16.509, -68.15954),
('236', -16.50944, -68.16032),
('237', -16.50944, -68.16032),
('238', -16.51021, -68.16170000000001),
('239', -16.51022, -68.16173),
('240', -16.51057, -68.16162),
('241', -16.51059, -68.16165000000001),
('242', -16.510260000000002, -68.16266),
('243', -16.510260000000002, -68.16266),
('244', -16.50964, -68.16453),
('245', -16.50964, -68.16453),
('246', -16.509610000000002, -68.16460000000001),
('247', -16.508490000000002, -68.16424),
('248', -16.508460000000003, -68.16423),
('249', -16.507430000000003, -68.16388),
('250', -16.507430000000003, -68.16388),
('251', -16.506240000000002, -68.16348),
('252', -16.506240000000002, -68.16348),
('253', -16.504630000000002, -68.16295000000001),
('254', -16.50382, -68.16265),
('255', -16.50363, -68.16259000000001),
('256', -16.503500000000003, -68.16256),
('257', -16.50307, -68.16254),
('258', -16.502360000000003, -68.16250000000001),
('259', -16.502360000000003, -68.16250000000001),
('260', -16.502110000000002, -68.16249),
('261', -16.50156, -68.16252),
('262', -16.5008, -68.16268000000001),
('263', -16.5008, -68.16268000000001),
('264', -16.500500000000002, -68.16275),
('265', -16.49949, -68.16295000000001),
('266', -16.49829, -68.16308000000001),
('267', -16.49812, -68.16311),
('268', -16.49789, -68.16317000000001),
('269', -16.497680000000003, -68.16328),
('270', -16.497400000000003, -68.16348),
('271', -16.49725, -68.16361),
('272', -16.49725, -68.16361),
('273', -16.49672, -68.16408000000001),
('274', -16.49603, -68.16477),
('275', -16.49576, -68.16504),
('276', -16.49557, -68.16529),
('277', -16.49546, -68.16545),
('278', -16.49454, -68.16680000000001),
('279', -16.49424, -68.16713),
('280', -16.49369, -68.16763),
('281', -16.49266, -68.16839),
('282', -16.492040000000003, -68.16884),
('283', -16.49184, -68.16896000000001),
('284', -16.49153, -68.16911),
('285', -16.49114, -68.16928),
('286', -16.490750000000002, -68.16940000000001),
('287', -16.49011, -68.16948000000001),
('288', -16.48984, -68.16948000000001),
('289', -16.4895, -68.16944000000001),
('290', -16.48898, -68.16932),
('291', -16.48863, -68.1692),
('292', -16.48823, -68.16899000000001),
('293', -16.48768, -68.16861),
('294', -16.48742, -68.16837000000001),
('295', -16.4872, -68.16813),
('296', -16.486800000000002, -68.16757000000001),
('297', -16.48647, -68.16702000000001),
('298', -16.48647, -68.16702000000001),
('299', -16.4861, -68.16639),
('300', -16.48598, -68.16602),
('301', -16.485950000000003, -68.16583),
('302', -16.48593, -68.16532000000001),
('303', -16.48629, -68.16131),
('304', -16.486230000000003, -68.16086),
('305', -16.486140000000002, -68.16059),
('306', -16.486030000000003, -68.16035000000001),
('307', -16.48591, -68.16013000000001),
('308', -16.4858, -68.16000000000001),
('309', -16.485680000000002, -68.15987000000001),
('310', -16.48552, -68.15974),
('311', -16.48536, -68.15963),
('312', -16.48515, -68.15952),
('313', -16.484740000000002, -68.15937000000001),
('314', -16.48431, -68.15929),
('315', -16.484070000000003, -68.1593),
('316', -16.483780000000003, -68.15936),
('317', -16.48357, -68.15945),
('318', -16.48307, -68.1597),
('319', -16.48217, -68.16012),
('320', -16.48194, -68.16018000000001),
('321', -16.48156, -68.16023),
('322', -16.481070000000003, -68.16018000000001),
('323', -16.47867, -68.15988),
('324', -16.47746, -68.15972000000001),
('325', -16.476670000000002, -68.15955000000001),
('326', -16.4757, -68.15931),
('327', -16.475170000000002, -68.15926),
('328', -16.47474, -68.15932000000001),
('329', -16.47456, -68.15936),
('330', -16.47437, -68.15945),
('331', -16.4735, -68.15991000000001),
('332', -16.473190000000002, -68.16002),
('333', -16.47294, -68.16007),
('334', -16.4727, -68.16008000000001),
('335', -16.47248, -68.16007),
('336', -16.47223, -68.16001),
('337', -16.47183, -68.15987000000001),
('338', -16.471500000000002, -68.15966),
('339', -16.47072, -68.15833),
('340', -16.47044, -68.15774),
('341', -16.470200000000002, -68.15724),
('342', -16.470010000000002, -68.15692),
('343', -16.46978, -68.15660000000001),
('344', -16.469530000000002, -68.15635),
('345', -16.46902, -68.15605000000001),
('346', -16.46874, -68.15596000000001),
('347', -16.46836, -68.15588000000001),
('348', -16.467450000000003, -68.15573),
('349', -16.467090000000002, -68.15563),
('350', -16.46679, -68.1555),
('351', -16.46658, -68.1554),
('352', -16.466330000000003, -68.15522),
('353', -16.465320000000002, -68.15441),
('354', -16.46441, -68.15392),
('355', -16.46383, -68.15365),
('356', -16.463610000000003, -68.15352),
('357', -16.46348, -68.15343),
('358', -16.463350000000002, -68.15331),
('359', -16.463140000000003, -68.15306000000001),
('360', -16.462970000000002, -68.15277),
('361', -16.46262, -68.15192),
('362', -16.46262, -68.15192),
('363', -16.462290000000003, -68.15107),
('364', -16.462, -68.1507),
('365', -16.461820000000003, -68.15050000000001),
('366', -16.460880000000003, -68.14976),
('367', -16.46019, -68.14918),
('368', -16.46002, -68.14897),
('369', -16.45994, -68.14880000000001),
('370', -16.459870000000002, -68.14857),
('371', -16.459850000000003, -68.14815),
('372', -16.45991, -68.14778000000001),
('373', -16.46012, -68.14738000000001),
('374', -16.460250000000002, -68.14724000000001),
('375', -16.460250000000002, -68.14724000000001),
('376', -16.4604, -68.14711000000001),
('377', -16.46055, -68.14705000000001),
('378', -16.46077, -68.14699),
('379', -16.46102, -68.14698),
('380', -16.46122, -68.147),
('381', -16.461450000000003, -68.14707),
('382', -16.46168, -68.14718),
('383', -16.46196, -68.14749),
('384', -16.462210000000002, -68.14789),
('385', -16.462400000000002, -68.14829),
('386', -16.462600000000002, -68.14878),
('387', -16.462850000000003, -68.14966000000001),
('388', -16.46293, -68.14999),
('389', -16.46293, -68.14999),
('390', -16.4632, -68.15095000000001),
('391', -16.46339, -68.15131000000001),
('392', -16.463600000000003, -68.1516),
('393', -16.46387, -68.15185000000001),
('394', -16.464280000000002, -68.15211000000001),
('395', -16.46593, -68.15281),
('396', -16.466230000000003, -68.15287000000001),
('397', -16.466510000000003, -68.15289),
('398', -16.466920000000002, -68.15287000000001),
('399', -16.46815, -68.15268),
('400', -16.47003, -68.15246),
('401', -16.470480000000002, -68.15244),
('402', -16.47229, -68.15246),
('403', -16.4726, -68.15251),
('404', -16.47401, -68.1529),
('405', -16.474970000000003, -68.15316),
('406', -16.47531, -68.15318),
('407', -16.47575, -68.15312),
('408', -16.47614, -68.15301000000001),
('409', -16.47654, -68.15284000000001),
('410', -16.47673, -68.15274000000001),
('411', -16.477, -68.15255),
('412', -16.47758, -68.15208000000001),
('413', -16.47822, -68.15151),
('414', -16.47924, -68.15063),
('415', -16.479570000000002, -68.15029000000001),
('416', -16.479750000000003, -68.15),
('417', -16.48028, -68.14905),
('418', -16.480400000000003, -68.14888),
('419', -16.48064, -68.14862000000001),
('420', -16.480970000000003, -68.14837),
('421', -16.4815, -68.14814000000001),
('422', -16.483310000000003, -68.14743),
('423', -16.48404, -68.14709),
('424', -16.484280000000002, -68.14696),
('425', -16.484440000000003, -68.14683000000001),
('426', -16.48485, -68.14638000000001),
('427', -16.48544, -68.14572000000001),
('428', -16.48579, -68.14548),
('429', -16.486510000000003, -68.14516),
('430', -16.487550000000002, -68.14472),
('431', -16.487840000000002, -68.14453),
('432', -16.48808, -68.14434),
('433', -16.48826, -68.14420000000001),
('434', -16.48826, -68.14420000000001),
('435', -16.48856, -68.1439),
('436', -16.489250000000002, -68.14323),
('437', -16.48964, -68.14272000000001),
('438', -16.48987, -68.1423),
('439', -16.490460000000002, -68.14082),
('440', -16.4905, -68.14084000000001),
('441', -16.4905, -68.14084000000001),
('442', -16.490460000000002, -68.14082),
('443', -16.490540000000003, -68.14069),
('444', -16.49077, -68.14014),
('445', -16.49077, -68.14014),
('446', -16.49117, -68.13921),
('447', -16.49136, -68.13887000000001),
('448', -16.49163, -68.13846000000001),
('449', -16.4921, -68.13796),
('450', -16.4921, -68.13796),
('451', -16.492340000000002, -68.13771000000001),
('452', -16.49249, -68.13756000000001),
('453', -16.492630000000002, -68.13748000000001),
('454', -16.49276, -68.13739000000001),
('455', -16.49294, -68.13731),
('456', -16.49294, -68.13731),
('457', -16.4935, -68.13711),
('458', -16.49407, -68.13697),
('459', -16.494500000000002, -68.13690000000001),
('460', -16.494850000000003, -68.13687),
('461', -16.49519, -68.13686),
('462', -16.495720000000002, -68.13689000000001);

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
('1', 'Sindicato 1', 'Villa esperanza', '123LLAMEYA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiene`
--

CREATE TABLE IF NOT EXISTS `tiene` (
  `idtramo` varchar(100) NOT NULL,
  `idparada` varchar(100) NOT NULL,
  `tiempo` double NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `trazo` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tiene`
--

INSERT INTO `tiene` (`idtramo`, `idparada`, `tiempo`, `tipo`, `trazo`, `orden`) VALUES
('1', '1', 0, '', 'ruta', 0),
('1', '2', 0.45, '', 'ruta', 1),
('1', '3', 0.8166666666666667, '', 'ruta', 2),
('1', '4', 1.4833333333333334, '', 'ruta', 3),
('1', '5', 2.1333333333333333, '', 'ruta', 4),
('1', '6', 2.783333333333333, '', 'ruta', 5),
('2', '6', 0, '', 'ruta', 0),
('2', '7', 0.6, '', 'ruta', 1),
('2', '8', 1.8833333333333333, '', 'ruta', 2),
('2', '9', 2.466666666666667, '', 'ruta', 3),
('3', '10', 0, '', 'ruta', 0),
('3', '11', 1.05, '', 'ruta', 1),
('3', '12', 1.7, '', 'ruta', 2),
('3', '13', 2.466666666666667, '', 'ruta', 3),
('3', '14', 3.1166666666666667, '', 'ruta', 4),
('3', '15', 3.8666666666666667, '', 'ruta', 5),
('4', '16', 0, '', 'ruta', 0),
('4', '17', 2.183333333333333, '', 'ruta', 1),
('4', '18', 2.3666666666666667, '', 'ruta', 2),
('4', '19', 2.9833333333333334, '', 'ruta', 3),
('4', '20', 5.016666666666667, '', 'ruta', 4),
('4', '21', 6.633333333333334, '', 'ruta', 5),
('4', '22', 8.116666666666667, '', 'ruta', 6),
('4', '23', 9.15, '', 'ruta', 7),
('4', '24', 9.65, '', 'ruta', 8),
('4', '25', 10.25, '', 'ruta', 9),
('4', '26', 10.983333333333333, '', 'ruta', 10),
('4', '27', 12.033333333333333, '', 'ruta', 11),
('5', '28', 0, '', 'ruta', 0),
('5', '29', 0.5166666666666667, '', 'ruta', 1),
('5', '30', 1.4166666666666667, '', 'ruta', 2),
('5', '31', 1.9833333333333334, '', 'ruta', 3),
('5', '32', 2.533333333333333, '', 'ruta', 4),
('5', '33', 4.516666666666667, '', 'ruta', 5),
('5', '34', 4.9, '', 'ruta', 6),
('5', '35', 5.083333333333333, '', 'ruta', 7),
('5', '36', 5.283333333333333, '', 'ruta', 8),
('5', '37', 5.45, '', 'ruta', 9),
('5', '38', 5.8, '', 'ruta', 10),
('5', '39', 6.166666666666667, '', 'ruta', 11),
('5', '40', 6.366666666666666, '', 'ruta', 12),
('5', '41', 6.833333333333333, '', 'ruta', 13),
('5', '42', 6.916666666666667, '', 'ruta', 14),
('5', '43', 7.166666666666667, '', 'ruta', 15),
('5', '44', 7.85, '', 'ruta', 16),
('5', '45', 8.5, '', 'ruta', 17),
('5', '46', 8.683333333333334, '', 'ruta', 18),
('5', '47', 8.883333333333333, '', 'ruta', 19),
('6', '47', 0, '', 'ruta', 0),
('6', '48', 0.6833333333333333, '', 'ruta', 1),
('6', '49', 0.9166666666666666, '', 'ruta', 2),
('6', '50', 1.1166666666666667, '', 'ruta', 3),
('6', '51', 1.8833333333333333, '', 'ruta', 4),
('6', '52', 3.8333333333333335, '', 'ruta', 5),
('6', '53', 4.15, '', 'ruta', 6),
('6', '54', 4.45, '', 'ruta', 7),
('6', '55', 6.116666666666666, '', 'ruta', 8),
('6', '56', 6.85, '', 'ruta', 9),
('6', '57', 7.433333333333334, '', 'ruta', 10),
('6', '58', 8, '', 'ruta', 11),
('6', '59', 8.233333333333333, '', 'ruta', 12),
('6', '1', 8.85, '', 'ruta', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramo`
--

CREATE TABLE IF NOT EXISTS `tramo` (
  `idtramo` varchar(100) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  PRIMARY KEY (`idtramo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tramo`
--

INSERT INTO `tramo` (`idtramo`, `referencia`) VALUES
('1', 'Perez Velazco - Plaza del estudiante'),
('2', 'Plaza del Estudiante - Pinilla'),
('3', 'Plaza del estudiante - Plaza Lira'),
('4', 'Estadio Hernando Silez - Calle Chicaloma'),
('5', 'Ciudad Satelite - Ceja'),
('6', 'Ceja El Alto - Perrez Velazco');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
