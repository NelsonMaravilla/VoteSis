-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2015 a las 05:32:23
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tse`
--
CREATE DATABASE IF NOT EXISTS `tse` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tse`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio_elecciones`
--

DROP TABLE IF EXISTS `anio_elecciones`;
CREATE TABLE IF NOT EXISTS `anio_elecciones` (
`id_anioe` int(10) NOT NULL,
  `anio_eleccion` int(4) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `tipo_eleccion` varchar(50) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anio_elecciones`
--

INSERT INTO `anio_elecciones` (`id_anioe`, `anio_eleccion`, `titulo`, `tipo_eleccion`, `estado`) VALUES
(5, 2015, 'ELECCIONES DE CONSEJOS MUNICIPALES Y DIPUTADOS', '2', 'ACTIVADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

DROP TABLE IF EXISTS `candidato`;
CREATE TABLE IF NOT EXISTS `candidato` (
`id_candidato` int(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `fecha_ven` date NOT NULL,
  `fecha_naci` date NOT NULL,
  `residencia` varchar(150) NOT NULL,
  `genero` varchar(15) NOT NULL,
  `imag_can` varchar(100) NOT NULL,
  `id_departamento` varchar(2) NOT NULL,
  `id_municipio` varchar(4) NOT NULL,
  `id_partido` int(9) NOT NULL,
  `tipo_candidatura` int(2) NOT NULL,
  `id_coalicion` int(10) NOT NULL,
  `id_anoe` int(10) NOT NULL,
  `voto` int(25) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `candidato`
--

INSERT INTO `candidato` (`id_candidato`, `nombre`, `apellido`, `dui`, `fecha_ven`, `fecha_naci`, `residencia`, `genero`, `imag_can`, `id_departamento`, `id_municipio`, `id_partido`, `tipo_candidatura`, `id_coalicion`, `id_anoe`, `voto`) VALUES
(1, 'SADWERW', 'EHJGHJ', '42456456-4', '2015-05-27', '2015-05-21', 'DRFTSERWERWERQWER', 'MASCULINO', 'personas/42456456-4.jpg', '06', '0601', 1, 2, 2, 2015, 15),
(2, 'DSFGSDFGSDFG', 'SDFGSFG', '41427527-5', '2015-05-27', '2015-05-09', 'ERWERTWERTRTERTWERTW', 'MASCULINO', 'personas/41427527-5.jpg', '06', '0601', 2, 2, 2, 2015, 10),
(3, 'NELSON IVAN', 'RIVAS PALACIOS', '32132131-3', '2015-06-01', '1995-06-04', 'SADJFHASDF ADJLHADJAHD AJDHA DFADFADAF', 'MASCULINO', 'personas/32132131-3.jpg', '08', '0821', 2, 1, 0, 2015, 7),
(6, 'OSCAR', 'RIVAS', '45343435-3', '2015-06-05', '2015-06-17', 'DFGDFGDGDGHDGDGDGH', 'MASCULINO', 'personas/45343435-3.jpg', '08', '0821', 1, 1, 0, 2015, 3),
(10, 'EDWIN ALEXANDER', 'RIVAS PALACIOS', '35634546-5', '2015-06-04', '2015-06-17', 'SEFLASKDJAKEJASDKASDKLFASD', 'MASCULINO', 'personas/35634546-5.jpg', '08', '0821', 4, 1, 0, 2015, 2),
(11, 'KEYRI MARIELOS', 'RIVAS PALACIOS', '36546546-5', '2015-06-04', '2015-06-17', 'SEFLASKDJAKEJASDKASDKLFASD', 'FEMENINO', 'personas/36546546-5.jpg', '08', '0821', 5, 1, 0, 2015, 5),
(12, 'ALEXIS EDENILSON', 'RIVAS PALACIOS', '65465465-4', '2015-06-04', '2015-06-17', 'SEFLASKDJAKEJASDKASDKLFASD', 'MASCULINO', 'personas/65465465-4.jpg', '08', '0821', 6, 1, 0, 2015, 6),
(13, 'MAYRA EDITH', 'TENORIO DE RIVAS', '12345678-9', '2015-06-05', '2015-06-10', 'SASDASDASDASDASDASDASDA', 'FEMENINO', 'personas/12345678-9.png', '08', '0821', 1, 2, 0, 2015, 4),
(14, 'NOOOO', 'SIII', '12312312-4', '2015-06-01', '2015-06-01', 'QQWFASFASFAF', 'MASCULINO', 'personas/12312312-4.jpg', '08', '0821', 6, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coalicion`
--

DROP TABLE IF EXISTS `coalicion`;
CREATE TABLE IF NOT EXISTS `coalicion` (
`id` int(11) NOT NULL,
  `Nombre_coa` varchar(30) NOT NULL,
  `Tipo` int(11) NOT NULL,
  `codigo_loca` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coalicion`
--

INSERT INTO `coalicion` (`id`, `Nombre_coa`, `Tipo`, `codigo_loca`) VALUES
(1, 'ARENA-FMLN', 1, '0301'),
(2, 'ARENA-FMLN', 2, '06'),
(3, 'ARENA-FMLN', 1, '1001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE IF NOT EXISTS `departamentos` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(2) NOT NULL,
  `can_diputados` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `codigo`, `can_diputados`) VALUES
(1, 'Ahuachapán', '01', 4),
(2, 'Santa Ana', '02', 7),
(3, 'Sonsonate', '03', 6),
(4, 'Chalatenango', '04', 3),
(5, 'La Libertad', '05', 10),
(6, 'San Salvador', '06', 24),
(7, 'Cuscatlán', '07', 3),
(8, 'La Paz', '08', 4),
(9, 'Cabañas', '09', 3),
(10, 'San Vicente', '10', 3),
(11, 'Usulután', '11', 5),
(12, 'San Miguel', '12', 6),
(13, 'Morazán', '13', 3),
(14, 'La Unión', '14', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elecciones`
--

DROP TABLE IF EXISTS `elecciones`;
CREATE TABLE IF NOT EXISTS `elecciones` (
`id_elecciones` int(9) NOT NULL,
  `id_anioe` int(9) NOT NULL,
  `descripcion` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elecciones_activas`
--

DROP TABLE IF EXISTS `elecciones_activas`;
CREATE TABLE IF NOT EXISTS `elecciones_activas` (
  `ano` int(4) NOT NULL,
  `tipo` int(2) NOT NULL,
  `estado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elecciones_activas`
--

INSERT INTO `elecciones_activas` (`ano`, `tipo`, `estado`) VALUES
(2015, 1, 'ACTIVADO'),
(2015, 2, 'ACTIVADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
`id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(4) NOT NULL,
  `codigo_depto` varchar(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `codigo`, `codigo_depto`) VALUES
(1, 'Ahuachapán', '0101', '01'),
(2, 'Apaneca', '0102', '01'),
(3, 'Atiquizaya', '0103', '01'),
(4, 'Concepción de Ataco', '0104', '01'),
(5, 'El Refugio', '0105', '01'),
(6, 'Guaymango', '0106', '01'),
(7, 'Jujutla', '0107', '01'),
(8, 'San Francisco Menéndez', '0108', '01'),
(9, 'San Lorenzo', '0109', '01'),
(10, 'San Pedro Puxtla', '0110', '01'),
(11, 'Tacuba', '0111', '01'),
(12, 'Turín', '0112', '01'),
(13, 'Candelaria de la Frontera', '0201', '02'),
(14, 'Coatepeque', '0202', '02'),
(15, 'Chalchuapa', '0203', '02'),
(16, 'El Congo', '0204', '02'),
(17, 'El Porvenir', '0205', '02'),
(18, 'Masahuat', '0206', '02'),
(19, 'Metapán', '0207', '02'),
(20, 'San Antonio Pajonal', '0208', '02'),
(21, 'San Sebastián Salitrillo', '0209', '02'),
(22, 'Santa Ana', '0210', '02'),
(23, 'Santa Rosa Guachipilín', '0211', '02'),
(24, 'Santiago de la Frontera', '0212', '02'),
(25, 'Texistepeque', '0213', '02'),
(26, 'Acajutla', '0301', '03'),
(27, 'Armenia', '0302', '03'),
(28, 'Caluco', '0303', '03'),
(29, 'Cuisnahuat', '0304', '03'),
(30, 'Santa Isabel Ishuatán', '0305', '03'),
(31, 'Izalco', '0306', '03'),
(32, 'Juayúa', '0307', '03'),
(33, 'Nahuizalco', '0308', '03'),
(34, 'Nahulingo', '0309', '03'),
(35, 'Salcoatitán', '0310', '03'),
(36, 'San Antonio del Monte', '0311', '03'),
(37, 'San Julián', '0312', '03'),
(38, 'Santa Catarina Masahuat', '0313', '03'),
(39, 'Santo Domingo de Guzmán', '0314', '03'),
(40, 'Sonsonate', '0315', '03'),
(41, 'Sonzacate', '0316', '03'),
(42, 'Agua Caliente', '0401', '04'),
(43, 'Arcatao', '0402', '04'),
(44, 'Azacualpa', '0403', '04'),
(45, 'Citalá', '0404', '04'),
(46, 'Comalapa', '0405', '04'),
(47, 'Concepción Quezaltepeque', '0406', '04'),
(48, 'Chalatenango', '0407', '04'),
(49, 'Dulce Nombre de María', '0408', '04'),
(50, 'El Carrizal', '0409', '04'),
(51, 'El Paraíso', '0410', '04'),
(52, 'La Laguna', '0411', '04'),
(53, 'La Palma', '0412', '04'),
(54, 'La Reina', '0413', '04'),
(55, 'Las Vueltas', '0414', '04'),
(56, 'Nombre de Jesús', '0415', '04'),
(57, 'Nueva Concepción', '0416', '04'),
(58, 'Nueva Trinidad', '0417', '04'),
(59, 'Ojos de Agua', '0418', '04'),
(60, 'Potonico', '0419', '04'),
(61, 'San Antonio de la Cruz', '0420', '04'),
(62, 'San Antonio Los Ranchos', '0421', '04'),
(63, 'San Fernando', '0422', '04'),
(64, 'San Francisco Lempa', '0423', '04'),
(65, 'San Francisco Morazán', '0424', '04'),
(66, 'San Ignacio', '0425', '04'),
(67, 'San Isidro Labrador', '0426', '04'),
(68, 'San José Cancasque', '0427', '04'),
(69, 'San José Las Flores ', '0428', '04'),
(70, 'San Luis del Carmen', '0429', '04'),
(71, 'San Miguel de Mercedes', '0430', '04'),
(72, 'San Rafael', '0431', '04'),
(73, 'Santa Rita', '0432', '04'),
(74, 'Tejutla', '0433', '04'),
(75, 'Antiguo Cuscatlán', '0501', '05'),
(76, 'Ciudad Arce', '0502', '05'),
(77, 'Colón', '0503', '05'),
(78, 'Comasagua', '0504', '05'),
(79, 'Chiltiupán', '0505', '05'),
(80, 'Huizúcar', '0506', '05'),
(81, 'Jayaque', '0507', '05'),
(82, 'Jicalapa', '0508', '05'),
(83, 'La Libertad', '0509', '05'),
(84, 'Nuevo Cuscatlán', '0510', '05'),
(85, 'Santa Tecla', '0511', '05'),
(86, 'Quezaltepeque', '0512', '05'),
(87, 'Sacacoyo', '0513', '05'),
(88, 'San José Villanueva', '0514', '05'),
(89, 'San Juan Opico', '0515', '05'),
(90, 'San Matías', '0516', '05'),
(91, 'San Pablo Tacachico', '0517', '05'),
(92, 'Tamanique', '0518', '05'),
(93, 'Talnique', '0519', '05'),
(94, 'Teotepeque', '0520', '05'),
(95, 'Tepecoyo', '0521', '05'),
(96, 'Zaragoza', '0522', '05'),
(97, 'Aguilares', '0601', '06'),
(98, 'Apopa', '0602', '06'),
(99, 'Ayutuxtepeque', '0603', '06'),
(100, 'Cuscatancingo', '0604', '06'),
(101, 'El Paisnal', '0605', '06'),
(102, 'Guazapa', '0606', '06'),
(103, 'Ilopango', '0607', '06'),
(104, 'Mejicanos', '0608', '06'),
(105, 'Nejapa', '0609', '06'),
(106, 'Panchimalco', '0610', '06'),
(107, 'Rosario de Mora', '0611', '06'),
(108, 'San Marcos', '0612', '06'),
(109, 'San Martín', '0613', '06'),
(110, 'San Salvador', '0614', '06'),
(111, 'Santiago Texacuangos', '0615', '06'),
(112, 'Santo Tomás', '0616', '06'),
(113, 'Soyapango', '0617', '06'),
(114, 'Tonacatepeque', '0618', '06'),
(115, 'Delgado', '0619', '06'),
(116, 'Candelaria', '0701', '07'),
(117, 'Cojutepeque', '0702', '07'),
(118, 'El Carmen', '0703', '07'),
(119, 'El Rosario', '0704', '07'),
(120, 'Monte San Juan', '0705', '07'),
(121, 'Oratorio de Concepción', '0706', '07'),
(122, 'San Bartolomé Perulapía', '0707', '07'),
(123, 'San Cristóbal', '0708', '07'),
(124, 'San José Guayabal', '0709', '07'),
(125, 'San Pedro Perulapán', '0710', '07'),
(126, 'San Rafael Cedros', '0711', '07'),
(127, 'San Ramón', '0712', '07'),
(128, 'Santa Cruz Analquito', '0713', '07'),
(129, 'Santa Cruz Michapa', '0714', '07'),
(130, 'Suchitoto', '0715', '07'),
(131, 'Tenancingo', '0716', '07'),
(132, 'Cuyultitán', '0801', '08'),
(133, 'El Rosario', '0802', '08'),
(134, 'Jerusalén', '0803', '08'),
(135, 'Mercedes La Ceiba', '0804', '08'),
(136, 'Olocuilta', '0805', '08'),
(137, 'Paraíso de Osorio', '0806', '08'),
(138, 'San Antonio Masahuat', '0807', '08'),
(139, 'San Emigdio', '0808', '08'),
(140, 'San Francisco Chinameca', '0809', '08'),
(141, 'San Juan Nonualco', '0810', '08'),
(142, 'San Juan Talpa', '0811', '08'),
(143, 'San Juan Tepezontes', '0812', '08'),
(144, 'San Luis Talpa', '0813', '08'),
(145, 'San Miguel Tepezontes', '0814', '08'),
(146, 'San Pedro Masahuat', '0815', '08'),
(147, 'San Pedro Nonualco', '0816', '08'),
(148, 'San Rafael Obrajuelo', '0817', '08'),
(149, 'Santa María Ostuma', '0818', '08'),
(150, 'Santiago Nonualco', '0819', '08'),
(151, 'Tapalhuaca', '0820', '08'),
(152, 'Zacatecoluca', '0821', '08'),
(153, 'San Luis La Herradura', '0822', '08'),
(154, 'Cinquera', '0901', '09'),
(155, 'Guacotecti', '0902', '09'),
(156, 'Ilobasco', '0903', '09'),
(157, 'Jutiapa', '0904', '09'),
(158, 'San Isidro', '0905', '09'),
(159, 'Sensuntepeque', '0906', '09'),
(160, 'Tejutepeque', '0907', '09'),
(161, 'Victoria', '0908', '09'),
(162, 'Villa Dolores', '0909', '09'),
(163, 'Apastepeque', '1001', '10'),
(164, 'Guadalupe', '1002', '10'),
(165, 'San Cayetano Istepeque', '1003', '10'),
(166, 'Santa Clara', '1004', '10'),
(167, 'Santo Domingo', '1005', '10'),
(168, 'San Esteban Catarina', '1006', '10'),
(169, 'San Ildefonso', '1007', '10'),
(170, 'San Lorenzo', '1008', '10'),
(171, 'San Sebastián', '1009', '10'),
(172, 'San Vicente', '1010', '10'),
(173, 'Tecoluca', '1011', '10'),
(174, 'Tepetitán', '1012', '10'),
(175, 'Verapaz', '1013', '10'),
(176, 'Alegría', '1101', '11'),
(177, 'Berlín', '1102', '11'),
(178, 'California', '1103', '11'),
(179, 'Concepción Batres', '1104', '11'),
(180, 'El Triunfo', '1105', '11'),
(181, 'Ereguayquín', '1106', '11'),
(182, 'Estanzuelas', '1107', '11'),
(183, 'Jiquilisco', '1108', '11'),
(184, 'Jucuapa', '1109', '11'),
(185, 'Jucuarán', '1110', '11'),
(186, 'Mercedes Umaña', '1111', '11'),
(187, 'Nueva Granada', '1112', '11'),
(188, 'Ozatlán', '1113', '11'),
(189, 'Puerto El Triunfo', '1114', '11'),
(190, 'San Agustín', '1115', '11'),
(191, 'San Buenaventura', '1116', '11'),
(192, 'San Dionisio', '1117', '11'),
(193, 'Santa Elena', '1118', '11'),
(194, 'San Francisco Javier', '1119', '11'),
(195, 'Santa María', '1120', '11'),
(196, 'Santiago de María', '1121', '11'),
(197, 'Tecapán', '1122', '11'),
(198, 'Usulután', '1123', '11'),
(199, 'Carolina', '1201', '12'),
(200, 'Ciudad Barrios', '1202', '12'),
(201, 'Comacarán', '1203', '12'),
(202, 'Chapeltique', '1204', '12'),
(203, 'Chinameca', '1205', '12'),
(204, 'Chirilagua', '1206', '12'),
(205, 'El Tránsito', '1207', '12'),
(206, 'Lolotique', '1208', '12'),
(207, 'Moncagua', '1209', '12'),
(208, 'Nueva Guadalupe', '1210', '12'),
(209, 'Nuevo Edén de San Juan', '1211', '12'),
(210, 'Quelepa', '1212', '12'),
(211, 'San Antonio del Mosco', '1213', '12'),
(212, 'San Gerardo', '1214', '12'),
(213, 'San Jorge', '1215', '12'),
(214, 'San Luis de la Reina', '1216', '12'),
(215, 'San Miguel', '1217', '12'),
(216, 'San Rafael Oriente', '1218', '12'),
(217, 'Sesori', '1219', '12'),
(218, 'Uluazapa', '1220', '12'),
(219, 'Arambala', '1301', '13'),
(220, 'Cacaopera', '1302', '13'),
(221, 'Corinto', '1303', '13'),
(222, 'Chilanga', '1304', '13'),
(223, 'Delicias de Concepción', '1305', '13'),
(224, 'El Divisadero', '1306', '13'),
(225, 'El Rosario', '1307', '13'),
(226, 'Gualococti', '1308', '13'),
(227, 'Guatajiagua', '1309', '13'),
(228, 'Joateca', '1310', '13'),
(229, 'Jocoaitique', '1311', '13'),
(230, 'Jocoro', '1312', '13'),
(231, 'Lolotiquillo', '1313', '13'),
(232, 'Meanguera', '1314', '13'),
(233, 'Osicala', '1315', '13'),
(234, 'Perquín', '1316', '13'),
(235, 'San Carlos', '1317', '13'),
(236, 'San Fernando', '1318', '13'),
(237, 'San Francisco Gotera', '1319', '13'),
(238, 'San Isidro', '1320', '13'),
(239, 'San Simón', '1321', '13'),
(240, 'Sensembra', '1322', '13'),
(241, 'Sociedad', '1323', '13'),
(242, 'Torola', '1324', '13'),
(243, 'Yamabal', '1325', '13'),
(244, 'Yoloaiquín', '1326', '13'),
(245, 'Anamorós', '1401', '14'),
(246, 'Bolívar', '1402', '14'),
(247, 'Concepción de Oriente', '1403', '14'),
(248, 'Conchagua', '1404', '14'),
(249, 'El Carmen', '1405', '14'),
(250, 'El Sauce', '1406', '14'),
(251, 'Intipucá', '1407', '14'),
(252, 'La Unión', '1408', '14'),
(253, 'Lilisque', '1409', '14'),
(254, 'Meanguera del Golfo', '1410', '14'),
(255, 'Nueva Esparta', '1411', '14'),
(256, 'Pasaquina', '1412', '14'),
(257, 'Polorós', '1413', '14'),
(258, 'San Alejo', '1414', '14'),
(259, 'San José', '1415', '14'),
(260, 'Santa Rosa de Lima', '1416', '14'),
(261, 'Yayantique', '1417', '14'),
(262, 'Yucuaiquín', '1418', '14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

DROP TABLE IF EXISTS `partido`;
CREATE TABLE IF NOT EXISTS `partido` (
`id_partido` int(9) NOT NULL,
  `nombre_partido` varchar(100) NOT NULL,
  `representante` varchar(30) NOT NULL,
  `dui_representante` varchar(10) NOT NULL,
  `iniciales_p` varchar(15) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id_partido`, `nombre_partido`, `representante`, `dui_representante`, `iniciales_p`, `url`) VALUES
(1, 'Alianza Republicana Nacionalista', 'EL Luss', '12346546-5', 'ARENA', 'imagenes/ARENA.jpg'),
(2, 'Frente Farabundo Martin para la Liveracion Naciona', 'Sifrido reyes', '32132132-1', 'FMLN', 'imagenes/FMLN.png'),
(3, 'No Partidario', 'Ninguno', '00000000-0', 'N/P', 'imagenes/NP.png'),
(4, 'Partido DdemÃ³crata Cristiano', 'benjamin palacios', '36541346-4', 'PDC', 'imagenes/PDC.png'),
(5, 'Partido de Concertacion Nacional', 'keiry rivas', '64316562-1', 'PCN', 'imagenes/PCN.png'),
(6, 'Gran Alianza por la Unidad Nacional', 'antonio saca', '65432146-5', 'GANA', 'imagenes/GANA.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos_coalicion`
--

DROP TABLE IF EXISTS `partidos_coalicion`;
CREATE TABLE IF NOT EXISTS `partidos_coalicion` (
`id_pc` int(9) NOT NULL,
  `id_coalicion` int(9) NOT NULL,
  `id_partido` int(9) NOT NULL,
  `id_anio` int(9) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `partidos_coalicion`
--

INSERT INTO `partidos_coalicion` (`id_pc`, `id_coalicion`, `id_partido`, `id_anio`) VALUES
(1, 1, 1, 2015),
(2, 1, 2, 2015),
(3, 2, 1, 2015),
(4, 2, 2, 2015),
(5, 3, 1, 2015),
(6, 3, 2, 2015);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
`id` int(11) NOT NULL,
  `Nombres` varchar(60) NOT NULL,
  `Apellidos` varchar(60) NOT NULL,
  `DUI` varchar(10) NOT NULL,
  `Fecha_vncdui` date NOT NULL,
  `fecha_nac` date NOT NULL,
  `codigo_depto` varchar(2) NOT NULL,
  `codigo_muni` varchar(4) NOT NULL,
  `residencia` longtext NOT NULL,
  `Genero` varchar(20) NOT NULL,
  `imag_per` varchar(60) NOT NULL,
  `estado` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `Nombres`, `Apellidos`, `DUI`, `Fecha_vncdui`, `fecha_nac`, `codigo_depto`, `codigo_muni`, `residencia`, `Genero`, `imag_per`, `estado`) VALUES
(5, 'BENJAMIN ANTONIO', 'RIVAS PALACIOS', '00496041-4', '2015-05-30', '1981-02-04', '08', '0821', '4TA. CALLE PONIENTE #28 BARRIO SAN SEBASTIAN ANALCO', 'MASCULINO', 'personas/00496041-4.png', 'SI'),
(6, 'PATY', 'CORTEZ', '00000000-0', '2015-06-01', '2015-06-01', '08', '0821', 'WERERWERWERWERWERER', 'FEMENINO', 'personas/00000000-0.jpg', 'SI'),
(7, 'RENAN ARQUIMIDES', 'LOVOS PICHINTE', '56654334-5', '2015-06-27', '2015-06-01', '08', '0821', 'QWDQWDASDASDAS', 'MASCULINO', 'personas/56654334-5.jpg', 'SI'),
(8, 'RICARDO ', 'ALVAREZ', '23253634-6', '2015-06-30', '1996-03-01', '08', '0821', 'QWEQDASFSFS', 'MASCULINO', 'personas/23253634-6.jpg', 'SI'),
(9, 'ROXANA ABIGAIL', 'PINEDA ANGULO', '23244355-4', '2025-06-17', '1997-06-19', '08', '0821', 'SAN SEBASTIAN', 'FEMENINO', 'personas/23244355-4.jpg', 'NO'),
(10, 'CLAUDIA MARISON', 'PINEDA DE PEREIRA', '23424242-4', '2022-11-11', '1994-11-24', '11', '1108', 'COMUNIDAD LA GAVIOTA ', 'FEMENINO', 'personas/23424242-4.jpg', 'NO'),
(11, 'CLAUDIA MARISON', 'PINEDA MARTINEZ', '63467642-7', '2021-07-15', '1992-06-16', '08', '0821', 'CALLEJON LA CERO', 'FEMENINO', 'personas/63467642-7.jpg', 'NO'),
(12, 'NOHEMI ARACELY', 'PARADA DE PEREIRA', '38958395-3', '2016-04-14', '1987-06-16', '08', '0821', 'LA CERO', 'FEMENINO', 'personas/38958395-3.jpg', 'NO'),
(14, 'JOSSELINE  ABIGAIL', 'MENA DE PEREIRA', '77538758-3', '2023-03-15', '1993-02-09', '08', '0821', 'EL NILO', 'FEMENINO', 'personas/77538758-3.jpg', 'NO'),
(15, 'JOSSELINE  ABIGAIL', 'MENA DE PEREIRA', '98645877-6', '2021-10-28', '2007-03-14', '08', '0821', 'EL NILO', 'FEMENINO', 'personas/98645877-6.jpg', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
`id_usuario` int(11) NOT NULL,
  `contrasena` char(40) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `contrasena`, `usuario`, `nombre`, `apellido`, `tipo`, `cargo`, `dui`, `estado`) VALUES
(5, 'e10adc3949ba59abbe56e057f20f883e', 'benjamin', 'benjamin', 'rivas', 'Administrador', '', '3216346546', 'ACTIVO'),
(6, '2b9cdebb444dbb2fe8380860104f0573', 'Ian', 'Nelson', 'Pereira', 'Administrador', '', '7777777777', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto_persona`
--

DROP TABLE IF EXISTS `voto_persona`;
CREATE TABLE IF NOT EXISTS `voto_persona` (
`id_voto` int(16) NOT NULL,
  `id_partido` int(16) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `tipo_candidatura` int(2) NOT NULL,
  `ano` int(4) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB AUTO_INCREMENT=424 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `voto_persona`
--

INSERT INTO `voto_persona` (`id_voto`, `id_partido`, `dui`, `tipo_candidatura`, `ano`, `estado`) VALUES
(416, 1, '00496041-4', 1, 2015, 'CERRADO'),
(417, 1, '00496041-4', 2, 2015, 'CERRADO'),
(418, 1, '00000000-0', 1, 2015, 'CERRADO'),
(419, 1, '00000000-0', 2, 2015, 'CERRADO'),
(420, 1, '56654334-5', 2, 2015, 'CERRADO'),
(421, 1, '56654334-5', 1, 2015, 'CERRADO'),
(422, 1, '23253634-6', 2, 2015, 'CERRADO'),
(423, 2, '23253634-6', 1, 2015, 'CERRADO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anio_elecciones`
--
ALTER TABLE `anio_elecciones`
 ADD PRIMARY KEY (`id_anioe`);

--
-- Indices de la tabla `candidato`
--
ALTER TABLE `candidato`
 ADD PRIMARY KEY (`id_candidato`);

--
-- Indices de la tabla `coalicion`
--
ALTER TABLE `coalicion`
 ADD PRIMARY KEY (`id`) COMMENT 'Coalicion';

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- Indices de la tabla `elecciones`
--
ALTER TABLE `elecciones`
 ADD PRIMARY KEY (`id_elecciones`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
 ADD PRIMARY KEY (`id_partido`);

--
-- Indices de la tabla `partidos_coalicion`
--
ALTER TABLE `partidos_coalicion`
 ADD PRIMARY KEY (`id_pc`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
 ADD PRIMARY KEY (`id`) COMMENT 'persona', ADD UNIQUE KEY `DUI` (`DUI`), ADD KEY `Depto` (`codigo_depto`) COMMENT 'Departamento', ADD KEY `muni` (`codigo_muni`) COMMENT 'municipio';

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `voto_persona`
--
ALTER TABLE `voto_persona`
 ADD PRIMARY KEY (`id_voto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anio_elecciones`
--
ALTER TABLE `anio_elecciones`
MODIFY `id_anioe` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `candidato`
--
ALTER TABLE `candidato`
MODIFY `id_candidato` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `coalicion`
--
ALTER TABLE `coalicion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `elecciones`
--
ALTER TABLE `elecciones`
MODIFY `id_elecciones` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=263;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
MODIFY `id_partido` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `partidos_coalicion`
--
ALTER TABLE `partidos_coalicion`
MODIFY `id_pc` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `voto_persona`
--
ALTER TABLE `voto_persona`
MODIFY `id_voto` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=424;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
ADD CONSTRAINT `codigo_depto` FOREIGN KEY (`codigo_depto`) REFERENCES `departamentos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `codigo_muni` FOREIGN KEY (`codigo_muni`) REFERENCES `municipio` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
