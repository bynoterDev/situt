-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2019 a las 11:50:29
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tutorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(11) NOT NULL,
  `nombre_c` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(256) NOT NULL,
  `contdesc` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `condicion` tinyint(4) NOT NULL,
  `privileg` varchar(50) NOT NULL,
  `fecha_reg_adm` date NOT NULL,
  `fecha_ult_ses_adm` date NOT NULL,
  `us_mod_rep` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_admin`, `nombre_c`, `correo`, `contrasena`, `contdesc`, `usuario`, `condicion`, `privileg`, `fecha_reg_adm`, `fecha_ult_ses_adm`, `us_mod_rep`) VALUES
(1, 'Marco Aguilar', 'marco@gmail.com', '3829486b93ec44395f0b980424bae9b6fb07b7bc', 'marco', 'tony', 1, 'ALL', '2018-05-29', '2019-03-07', 1),
(2, 'Manuel fernandez arriaga', 'manuel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'mane', 1, 'ALL', '2018-08-19', '2019-01-27', 1),
(3, 'Jacinto perez dominguez', 'jaci@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'jaci', 1, 'LIM', '2018-08-22', '2019-02-26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre_c_al` varchar(100) NOT NULL,
  `correo_al` varchar(80) DEFAULT NULL,
  `contrasena_al` varchar(256) NOT NULL,
  `contdesc_al` varchar(100) NOT NULL,
  `matricula_al` varchar(50) NOT NULL,
  `telefono_al` varchar(50) DEFAULT NULL,
  `sexo_al` varchar(50) DEFAULT NULL,
  `estado_al` tinyint(4) NOT NULL,
  `acept_grp` tinyint(4) DEFAULT NULL,
  `fin_car` tinyint(4) DEFAULT '0',
  `fecha_reg` date NOT NULL,
  `fecha_ult_ses_alm` date NOT NULL,
  `id_detgrupo` int(11) DEFAULT NULL,
  `becado_alm` tinyint(4) DEFAULT NULL,
  `foto_perf_alm` varchar(500) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre_c_al`, `correo_al`, `contrasena_al`, `contdesc_al`, `matricula_al`, `telefono_al`, `sexo_al`, `estado_al`, `acept_grp`, `fin_car`, `fecha_reg`, `fecha_ult_ses_alm`, `id_detgrupo`, `becado_alm`, `foto_perf_alm`, `id_carrera`) VALUES
(24, 'Mario jaimes barrueta', 'mario@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005001', '7223321122', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-15', 14, NULL, NULL, 7),
(25, 'Marco Aguilar', 'marco@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005307', '7321193748', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-25', 12, 0, 'perfilMarc.jpg', 7),
(26, 'Alejandro Solis Reyes', 'yresq@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-002827', '982198219821', 'Masculino', 1, 1, 0, '2018-08-15', '2019-02-15', 12, 0, NULL, 7),
(27, 'Ezequiel Gonzales Avila', 'cheque@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-009383', '2387327832732', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-29', 12, 0, NULL, 7),
(28, 'Carlos Capi Martinez', 'risa@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-008292', '983983298239', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-15', 12, 0, NULL, 7),
(29, 'Alejandra Rios Vazques', 'ale@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005308', '7223312277', 'Femenino', 1, 1, 0, '2018-08-15', '2019-01-23', 13, 0, NULL, 7),
(30, 'Jacinto perez marquez', 'jaci@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005409', '7223219882', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-15', 12, 1, NULL, 7),
(31, 'Bryan David Vidal Hermenegildo', 'bryan@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-004974', '7225667014', 'Masculino', 1, 1, 0, '2018-08-15', '2019-02-14', 12, NULL, NULL, 7),
(32, 'Daniel garcia', 'dani@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005310', '7223435656', 'Masculino', 0, 1, 0, '2018-08-15', '2019-01-10', 12, NULL, NULL, 7),
(33, 'Martin gonzales', 'martin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-008080', '7223112231', 'Masculino', 1, 1, 0, '2018-08-15', '2019-01-28', 12, 1, NULL, 7),
(34, 'Marco', NULL, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005301', NULL, NULL, 1, NULL, 0, '2018-08-15', '2019-02-13', NULL, NULL, NULL, 7),
(35, 'Alex', NULL, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'UTS15S-005101', NULL, NULL, 1, NULL, 0, '2018-08-15', '2019-01-09', NULL, NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajasalm_dat`
--

CREATE TABLE `bajasalm_dat` (
  `id_bajaalmdat` int(11) NOT NULL,
  `tipobaja` varchar(50) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `bajasolicitada` varchar(50) NOT NULL,
  `motivo_baja` varchar(1000) NOT NULL,
  `fecha_reg_baj` date NOT NULL,
  `estado_baj_alm` tinyint(4) NOT NULL,
  `id_alumno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bajasalm_dat`
--

INSERT INTO `bajasalm_dat` (`id_bajaalmdat`, `tipobaja`, `periodo`, `bajasolicitada`, `motivo_baja`, `fecha_reg_baj`, `estado_baj_alm`, `id_alumno`) VALUES
(1, 'Prueba', 'Prueba', 'Si', 'Prueba', '2019-03-11', 0, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becados_alm`
--

CREATE TABLE `becados_alm` (
  `id_becadoalm` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `tipo_beca_alm` varchar(50) DEFAULT NULL,
  `fecha_reg_beca` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas_alm`
--

CREATE TABLE `becas_alm` (
  `id_becaalm` int(11) NOT NULL,
  `beca_nombre` varchar(100) NOT NULL,
  `estado_bec` tinyint(4) NOT NULL,
  `fecha_re_bec` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `becas_alm`
--

INSERT INTO `becas_alm` (`id_becaalm`, `beca_nombre`, `estado_bec`, `fecha_re_bec`) VALUES
(1, 'Prospera', 1, '2018-08-15'),
(2, 'Transporte', 1, '2018-08-15'),
(3, 'Excelencia', 1, '2018-08-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id_carrera` int(11) NOT NULL,
  `nombre_car` varchar(200) NOT NULL,
  `descripcion_car` varchar(500) NOT NULL,
  `estado_car` tinyint(4) NOT NULL,
  `fecha_reg_car` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id_carrera`, `nombre_car`, `descripcion_car`, `estado_car`, `fecha_reg_car`) VALUES
(2, 'Mecatronica', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-06-04'),
(3, 'Enfermeria2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-06-04'),
(4, 'Administración', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-06-04'),
(5, 'Contaduria', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-06-14'),
(6, 'Procesos Alimenticios', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-08-11'),
(7, 'Tecnologías de la Información', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,', 1, '2018-08-11'),
(8, 'Lengua Inglesa', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 1, '2018-08-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo_escolar`
--

CREATE TABLE `ciclo_escolar` (
  `id_ciclo_escolar` int(11) NOT NULL,
  `n_ciclo_escolar` varchar(50) NOT NULL,
  `estado_cic_esc` tinyint(4) NOT NULL,
  `fecha_reg_cic` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinadores`
--

CREATE TABLE `coordinadores` (
  `id_coordinador` int(11) NOT NULL,
  `nombre_c_cor` varchar(80) DEFAULT NULL,
  `correo_cor` varchar(80) DEFAULT NULL,
  `contrasena_cor` varchar(256) DEFAULT NULL,
  `contdesc_cor` varchar(256) DEFAULT NULL,
  `telefono_cor` varchar(256) DEFAULT NULL,
  `sexo_cor` varchar(50) DEFAULT NULL,
  `foto_perf_cor` varchar(256) DEFAULT NULL,
  `estado_cor` tinyint(4) DEFAULT NULL,
  `fecha_reg_cor` date DEFAULT NULL,
  `fecha_ult_ses_cor` date DEFAULT NULL,
  `us_mod_rep` tinyint(4) UNSIGNED DEFAULT '1',
  `connect_cor` tinyint(4) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coordinadores`
--

INSERT INTO `coordinadores` (`id_coordinador`, `nombre_c_cor`, `correo_cor`, `contrasena_cor`, `contdesc_cor`, `telefono_cor`, `sexo_cor`, `foto_perf_cor`, `estado_cor`, `fecha_reg_cor`, `fecha_ult_ses_cor`, `us_mod_rep`, `connect_cor`) VALUES
(1, 'Mario Jaimes', 'mario@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7221155265', 'Masculino', 'aud2.jpg', 1, '2018-08-15', '2019-03-07', 1, 0),
(2, 'Manuel gomez palacios', 'manuel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7682239822', 'Masculino', NULL, 1, '2018-08-15', '2019-02-11', 1, 0),
(3, 'Guillermo perez', 'memo@gmail.com', 'c5c0cba68b55bc343b292366cf8981586e237dab', 'memo', '7228391010', 'Masculino', NULL, 1, '2018-08-15', '2019-02-28', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datpersonales_alm`
--

CREATE TABLE `datpersonales_alm` (
  `id_datpersonalesalm` int(11) NOT NULL,
  `id_alumno` int(11) DEFAULT NULL,
  `curp_dat` varchar(100) DEFAULT NULL,
  `fecha_nac_dat` date DEFAULT NULL,
  `edad_dat` int(11) DEFAULT NULL,
  `estado_civil_dat` varchar(50) DEFAULT NULL,
  `tipo_segsocial_dat` varchar(100) DEFAULT NULL,
  `num_segsocial_dat` varchar(100) DEFAULT NULL,
  `telefono_casa_dat` varchar(100) DEFAULT NULL,
  `telefono_rec_dat` varchar(100) DEFAULT NULL,
  `facebook_alm_dat` varchar(100) DEFAULT NULL,
  `calle_dat_act` varchar(100) DEFAULT NULL,
  `num_casa_dat_act` varchar(100) DEFAULT NULL,
  `colonia_dat_act` varchar(100) DEFAULT NULL,
  `localidad_dat_act` varchar(100) DEFAULT NULL,
  `municipio_dat_act` varchar(100) DEFAULT NULL,
  `estado_dat_act` varchar(100) DEFAULT NULL,
  `codpostal_dat_act` varchar(100) DEFAULT NULL,
  `municipio_dat_org` varchar(100) DEFAULT NULL,
  `estado_dat_org` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datpersonales_alm`
--

INSERT INTO `datpersonales_alm` (`id_datpersonalesalm`, `id_alumno`, `curp_dat`, `fecha_nac_dat`, `edad_dat`, `estado_civil_dat`, `tipo_segsocial_dat`, `num_segsocial_dat`, `telefono_casa_dat`, `telefono_rec_dat`, `facebook_alm_dat`, `calle_dat_act`, `num_casa_dat_act`, `colonia_dat_act`, `localidad_dat_act`, `municipio_dat_act`, `estado_dat_act`, `codpostal_dat_act`, `municipio_dat_org`, `estado_dat_org`) VALUES
(1, 25, 'caam970828hgrrgr11', '1997-08-28', 20, 'Soltero', 'IMSS', '892983232', '7322643556', '7223311231', 'Marco Aguilar', 'independencia', 's/n', 'centro', 'tejupilco', 'tejupilco', 'México', '51400', 'Arcelia', 'Guerrero'),
(2, 30, 'vihb970902hdfdrr01', '1997-09-10', 21, 'Soltero', 'IMSS', '923232323', '9876529898', '1234325676', 'Jacinto Perez', 'independencia', '89', 'centro', 'Tejupilco', 'tejupilco', 'México', '51400', 'Tejupilco', 'México'),
(3, 32, 'vihb970902hdfdrr09', '2018-09-19', 20, 'Casado', 'imss', '818231232', '7233223121', '7896545656', 'Dani garcia', 'centro', 's/n', 'centro', 'tejupilco', 'tejupilco', 'méxico', '51400', 'Tejupilco', 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datsistem`
--

CREATE TABLE `datsistem` (
  `id_datsistem` int(11) NOT NULL,
  `version_sistem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datsistem`
--

INSERT INTO `datsistem` (`id_datsistem`, `version_sistem`) VALUES
(1, '1.0.3.2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_grupo`
--

CREATE TABLE `det_grupo` (
  `id_detgrupo` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `estado_detgrp` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `det_grupo`
--

INSERT INTO `det_grupo` (`id_detgrupo`, `id_grupo`, `id_docente`, `id_carrera`, `estado_detgrp`) VALUES
(12, 1, 10, 7, 1),
(13, 8, 7, 7, 1),
(14, 15, 8, 7, 1),
(15, 22, 9, 7, 0),
(16, 28, 11, 7, 1),
(17, 2, 9, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devop`
--

CREATE TABLE `devop` (
  `id_devop` int(11) NOT NULL,
  `token_seg` varchar(256) DEFAULT NULL,
  `nombre_devop` varchar(50) DEFAULT NULL,
  `user_devop` varchar(50) DEFAULT NULL,
  `correo_devop` varchar(70) DEFAULT NULL,
  `pass_devop` varchar(256) DEFAULT NULL,
  `indic_devop` varchar(5) DEFAULT NULL,
  `estado_devop` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `devop`
--

INSERT INTO `devop` (`id_devop`, `token_seg`, `nombre_devop`, `user_devop`, `correo_devop`, `pass_devop`, `indic_devop`, `estado_devop`) VALUES
(1, '567892', 'Marco Aguilar', 'tony', 'marcocaaguilar@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directores`
--

CREATE TABLE `directores` (
  `id_director` int(11) NOT NULL,
  `nombre_c_dir` varchar(100) NOT NULL,
  `correo_dir` varchar(100) NOT NULL,
  `contrasena_dir` varchar(256) NOT NULL,
  `contdesc_dir` varchar(100) NOT NULL,
  `telefono_dir` varchar(100) NOT NULL,
  `fecha_reg_dir` date NOT NULL,
  `fecha_ult_ses_dir` date NOT NULL,
  `estado_dir` tinyint(4) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `foto_perf_dir` varchar(200) NOT NULL,
  `us_mod_rep` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `directores`
--

INSERT INTO `directores` (`id_director`, `nombre_c_dir`, `correo_dir`, `contrasena_dir`, `contdesc_dir`, `telefono_dir`, `fecha_reg_dir`, `fecha_ult_ses_dir`, `estado_dir`, `id_carrera`, `foto_perf_dir`, `us_mod_rep`) VALUES
(1, 'Sergio rivera', 'sergio@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7225648999', '2018-08-15', '2019-03-11', 1, 7, 'aud1.png', 1),
(2, 'Martin Gomez perez', 'martin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7227899988', '2018-08-15', '2019-02-15', 1, 2, '', 1),
(3, 'Ariel benites gonzales', 'ariel@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7228737722', '2018-08-15', '2019-01-15', 1, 3, '', 1),
(4, 'Gerardo ortiz gomez', 'gerardo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7223322992', '2018-08-15', '2019-02-19', 1, 4, '', 1),
(5, 'Rafael Gonzales perez', 'rafael@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7622299993', '2018-08-15', '2019-02-19', 1, 6, '', 1),
(6, 'Gonzalo pineda vargas', 'gonzalo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7223338999', '2018-08-15', '2019-02-24', 1, 8, '', 1),
(7, 'Eduardo torres vargas', 'eduardo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '7228929292', '2018-08-15', '2019-02-27', 1, 5, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `nombre_c_doc` varchar(50) NOT NULL,
  `correo_doc` varchar(50) NOT NULL,
  `direccion_doc` varchar(200) NOT NULL,
  `contrasena_doc` varchar(250) NOT NULL,
  `contdesc_doc` varchar(250) NOT NULL,
  `edad_doc` int(11) NOT NULL,
  `especialidad_doc` varchar(100) NOT NULL,
  `telefono_doc` varchar(50) NOT NULL,
  `condicion_doc` tinyint(4) NOT NULL,
  `fecha_reg_doc` date NOT NULL,
  `fecha_ult_ses_doc` date NOT NULL,
  `foto_perf_doc` varchar(200) NOT NULL,
  `us_mod_rep` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `nombre_c_doc`, `correo_doc`, `direccion_doc`, `contrasena_doc`, `contdesc_doc`, `edad_doc`, `especialidad_doc`, `telefono_doc`, `condicion_doc`, `fecha_reg_doc`, `fecha_ult_ses_doc`, `foto_perf_doc`, `us_mod_rep`) VALUES
(7, 'Nayelli Rios', 'nay12@gmail.com', 'Tejupilco Edo de México Zacatepec Col Jaimes', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 26, 'Psicologia', '7225566627', 1, '2018-08-15', '2019-01-15', '', 1),
(8, 'Adan Jaimes Jaimes', 'adanja@gmail.com', 'Tejupilco Edo de México San simon', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 40, 'Redes', '2829929010', 1, '2018-08-15', '2019-01-25', '', 1),
(9, 'Jenner Perez Perez', 'jennerpere@hotmail.com', 'Tejupilco Edo de México Col centro', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 45, 'Aplicaciones Moviles', '8712891298', 0, '2018-08-15', '2019-01-28', '', 1),
(10, 'Armando Estrada Jaimes', 'armando@gmail.com', 'Tejupilco Edo México Col Centro', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 50, 'Sistemas informaticos', '2892198768', 1, '2018-08-15', '2019-03-01', '', 1),
(11, 'Armando Jaimes Barrueta', 'jaimes@outlook.com', 'Tejupilco Edo de México Col Centro', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 50, 'Mantenimiento', '9812981298', 1, '2018-08-15', '2019-02-25', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enctes_alm`
--

CREATE TABLE `enctes_alm` (
  `id_enctestalm` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `reside` varchar(100) DEFAULT NULL,
  `tiempo_Res` varchar(100) DEFAULT NULL,
  `especifica_res` varchar(200) DEFAULT NULL,
  `vives` varchar(200) DEFAULT NULL,
  `trabajas` varchar(50) DEFAULT NULL,
  `donde_trabajas` varchar(200) DEFAULT NULL,
  `ingresoTrab` varchar(50) DEFAULT NULL,
  `horas_tr` varchar(50) DEFAULT NULL,
  `ingrDependes` varchar(50) DEFAULT NULL,
  `economicamente` varchar(50) DEFAULT NULL,
  `papa` varchar(200) DEFAULT NULL,
  `mama` varchar(200) DEFAULT NULL,
  `hermanos` varchar(50) DEFAULT NULL,
  `actividad_herm` varchar(1000) DEFAULT NULL,
  `habitas` varchar(50) DEFAULT NULL,
  `ingreso_familiar` varchar(50) DEFAULT NULL,
  `padeces` varchar(50) DEFAULT NULL,
  `especificaEnf` varchar(200) DEFAULT NULL,
  `frec_enferm` varchar(50) DEFAULT NULL,
  `espEnf` varchar(200) DEFAULT NULL,
  `medicamento` varchar(50) DEFAULT NULL,
  `cualMed` varchar(200) DEFAULT NULL,
  `fumas` varchar(50) DEFAULT NULL,
  `cantidadFum` varchar(200) DEFAULT NULL,
  `alchol` varchar(50) DEFAULT NULL,
  `cantidadBeb` varchar(200) DEFAULT NULL,
  `cualidades` varchar(1000) DEFAULT NULL,
  `defectos` varchar(1000) DEFAULT NULL,
  `aprecias` varchar(1000) DEFAULT NULL,
  `disgusta` varchar(1000) DEFAULT NULL,
  `temor` varchar(1000) DEFAULT NULL,
  `novio` varchar(50) DEFAULT NULL,
  `planes` varchar(200) DEFAULT NULL,
  `f_personal` varchar(1000) DEFAULT NULL,
  `f_academico` varchar(1000) DEFAULT NULL,
  `f_profesional` varchar(1000) DEFAULT NULL,
  `t_libre` varchar(100) DEFAULT NULL,
  `bachillerato` varchar(200) DEFAULT NULL,
  `turno` varchar(200) DEFAULT NULL,
  `localidadBach` varchar(200) DEFAULT NULL,
  `entidadBach` varchar(200) DEFAULT NULL,
  `especialidadBach` varchar(200) DEFAULT NULL,
  `promedioBach` varchar(50) DEFAULT NULL,
  `ceneval` varchar(50) DEFAULT NULL,
  `estudiar` varchar(200) DEFAULT NULL,
  `opcionUni` varchar(50) DEFAULT NULL,
  `opcionCar` varchar(50) DEFAULT NULL,
  `carreraEsp` varchar(500) DEFAULT NULL,
  `planExm` varchar(200) DEFAULT NULL,
  `dificultMat` varchar(200) DEFAULT NULL,
  `reprobado` varchar(50) DEFAULT NULL,
  `materiasRep` varchar(500) DEFAULT NULL,
  `tecnica` varchar(50) DEFAULT NULL,
  `cualTec` varchar(500) DEFAULT NULL,
  `libros` varchar(50) DEFAULT NULL,
  `cantLib` varchar(50) DEFAULT NULL,
  `computadora` varchar(50) DEFAULT NULL,
  `fecha_reg` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `enctes_alm`
--

INSERT INTO `enctes_alm` (`id_enctestalm`, `id_alumno`, `reside`, `tiempo_Res`, `especifica_res`, `vives`, `trabajas`, `donde_trabajas`, `ingresoTrab`, `horas_tr`, `ingrDependes`, `economicamente`, `papa`, `mama`, `hermanos`, `actividad_herm`, `habitas`, `ingreso_familiar`, `padeces`, `especificaEnf`, `frec_enferm`, `espEnf`, `medicamento`, `cualMed`, `fumas`, `cantidadFum`, `alchol`, `cantidadBeb`, `cualidades`, `defectos`, `aprecias`, `disgusta`, `temor`, `novio`, `planes`, `f_personal`, `f_academico`, `f_profesional`, `t_libre`, `bachillerato`, `turno`, `localidadBach`, `entidadBach`, `especialidadBach`, `promedioBach`, `ceneval`, `estudiar`, `opcionUni`, `opcionCar`, `carreraEsp`, `planExm`, `dificultMat`, `reprobado`, `materiasRep`, `tecnica`, `cualTec`, `libros`, `cantLib`, `computadora`, `fecha_reg`) VALUES
(1, 25, 'No', '', 'vivo en ixtapan', 'Papas', 'Si', 'tejuq', '2500', '5', '', 'Papa', 'Jubilado', 'Ama de casa', '5', 'maestros', 'Propia', '8200', 'Si', 'dolor de cabeza', 'Mucha', 'dolor de cabeza', 'No', '', 'No', '', 'No', '', 'prueba1', 'prueba2', 'prueba3', 'prueba4', 'prueba de contenido', 'Si', 'No', 'prueba1', 'prueba', 'prueba', 'pruab', 'prueba', 'Matutino', 'pruebaloc', 'pruebaent', 'pruebaesp', '8.2', '', 'no sabia lo que hacia', 'No', 'No', 'muchas cosas', 'n', 'ingles', 'Si', 'ingles', 'No', '', 'Si', '5', 'No', '2018-08-15'),
(2, 30, 'Si', '2 años', '', 'papa', 'No', '', '', '', '4900', 'papa', 'maestro', 'maestra', '1', 'maestro', 'Rentada', '8900', 'No', '', 'Poca', 'dolor de cabez', 'No', '', 'No', '', 'No', '', 'prueba1', 'prueba2', 'prueba3', 'prueba4', 'prueba5', 'No', 'No', 'ninguno', 'ninguno1', 'ninguno2', 'ninguno3', 'prepa 20', 'Matutino', 'arcelia', 'guerrero', 'informatica', '9', '', 'nose', 'No', 'No', 'pasar la carrera', 'no', 'ingles', 'Si', 'ingles', 'No', '', 'No', '', 'Si', '2018-08-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_test`
--

CREATE TABLE `evaluacion_test` (
  `id_evaltest` int(11) NOT NULL,
  `id_enctestalm` int(11) NOT NULL DEFAULT '0',
  `vulnerable` varchar(50) DEFAULT NULL,
  `opcion1` varchar(80) DEFAULT NULL,
  `opcion2` varchar(80) DEFAULT NULL,
  `opcion3` varchar(80) DEFAULT NULL,
  `obseval` varchar(1000) DEFAULT NULL,
  `obesidad` varchar(50) DEFAULT NULL,
  `delgadezExt` varchar(50) DEFAULT NULL,
  `manchasPiel` varchar(50) DEFAULT NULL,
  `faltaEnergia` varchar(50) DEFAULT NULL,
  `problemDen` varchar(50) DEFAULT NULL,
  `problemVis` varchar(50) DEFAULT NULL,
  `problemAud` varchar(50) DEFAULT NULL,
  `discapacidades` varchar(50) DEFAULT NULL,
  `otro` varchar(500) DEFAULT NULL,
  `fecha_reg_eval` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evaluacion_test`
--

INSERT INTO `evaluacion_test` (`id_evaltest`, `id_enctestalm`, `vulnerable`, `opcion1`, `opcion2`, `opcion3`, `obseval`, `obesidad`, `delgadezExt`, `manchasPiel`, `faltaEnergia`, `problemDen`, `problemVis`, `problemAud`, `discapacidades`, `otro`, `fecha_reg_eval`) VALUES
(2, 1, 'Si', 'Aspectos socioeconomicos', '', '', 'prueba de contenido', '', '', '', 'FALTA DE ENERGIA', '', 'PROBLEMAS VISUALES', '', '', '', '2018-09-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `grupo_n` varchar(50) NOT NULL,
  `cuatrimestre_g` varchar(50) NOT NULL,
  `period_cuat` varchar(50) NOT NULL,
  `estado_g` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `grupo_n`, `cuatrimestre_g`, `period_cuat`, `estado_g`) VALUES
(1, '101', 'Primero', 'SEP-DIC', 1),
(2, '102', 'Primero', 'SEP-DIC', 1),
(3, '103', 'Primero', 'SEP-DIC', 1),
(4, '104', 'Primero', 'SEP-DIC', 1),
(5, '105', 'Primero', 'SEP-DIC', 1),
(6, '106', 'Primero', 'SEP-DIC', 1),
(8, '201', 'Segundo', 'ENE-ABR', 1),
(9, '202', 'Segundo', 'ENE-ABR', 1),
(10, '203', 'Segundo', 'ENE-ABR', 1),
(11, '204', 'Segundo', 'ENE-ABR', 1),
(12, '205', 'Segundo', 'ENE-ABR', 1),
(13, '206', 'Segundo', 'ENE-ABR', 1),
(15, '301', 'Tercero', 'MAY-AGO', 1),
(16, '302', 'Tercero', 'MAY-AGO', 1),
(17, '303', 'Tercero', 'MAY-AGO', 1),
(18, '304', 'Tercero', 'MAY-AGO', 1),
(19, '305', 'Tercero', 'MAY-AGO', 1),
(20, '306', 'Tercero', 'MAY-AGO', 1),
(22, '401', 'Cuarto', 'SEP-DIC', 1),
(23, '402', 'Cuarto', 'SEP-DIC', 1),
(24, '403', 'Cuarto', 'SEP-DIC', 1),
(25, '404', 'Cuarto', 'SEP-DIC', 1),
(26, '405', 'Cuarto', 'SEP-DIC', 1),
(27, '406', 'Cuarto', 'SEP-DIC', 1),
(28, '501', 'Quinto', 'ENE-ABR', 1),
(29, '502', 'Quinto', 'ENE-ABR', 1),
(30, '503', 'Quinto', 'ENE-ABR', 1),
(31, '504', 'Quinto', 'ENE-ABR', 1),
(32, '505', 'Quinto', 'ENE-ABR', 1),
(33, '506', 'Quinto', 'ENE-ABR', 1),
(34, '601', 'Sexto', 'MAY-AGO', 1),
(35, '602', 'Sexto', 'MAY-AGO', 1),
(36, '603', 'Sexto', 'MAY-AGO', 1),
(37, '604', 'Sexto', 'MAY-AGO', 1),
(38, '605', 'Sexto', 'MAY-AGO', 1),
(39, '606', 'Sexto', 'MAY-AGO', 1),
(40, '701', 'Septimo', 'SEP-DIC', 1),
(41, '702', 'Septimo', 'SEP-DIC', 1),
(42, '703', 'Septimo', 'SEP-DIC', 1),
(43, '704', 'Septimo', 'SEP-DIC', 1),
(44, '705', 'Septimo', 'SEP-DIC', 1),
(45, '706', 'Septimo', 'SEP-DIC', 1),
(46, '801', 'Octavo', 'ENE-ABR', 1),
(47, '802', 'Octavo', 'ENE-ABR', 1),
(48, '803', 'Octavo', 'ENE-ABR', 1),
(49, '804', 'Octavo', 'ENE-ABR', 1),
(50, '805', 'Octavo', 'ENE-ABR', 1),
(51, '806', 'Octavo', 'ENE-ABR', 1),
(52, '901', 'Noveno', 'MAY-AGO', 1),
(53, '902', 'Noveno', 'MAY-AGO', 1),
(54, '903', 'Noveno', 'MAY-AGO', 1),
(55, '904', 'Noveno', 'MAY-AGO', 1),
(56, '905', 'Noveno', 'MAY-AGO', 1),
(57, '906', 'Noveno', 'MAY-AGO', 1),
(58, '1001', 'Decimo', 'SEP-DIC', 1),
(59, '1002', 'Decimo', 'SEP-DIC', 1),
(60, '1003', 'Decimo', 'SEP-DIC', 1),
(61, '1004', 'Decimo', 'SEP-DIC', 1),
(62, '1005', 'Decimo', 'SEP-DIC', 1),
(63, '1006', 'Decimo', 'SEP-DIC', 1),
(64, '1101', 'Onceavo', 'ENE-ABR', 1),
(65, '1102', 'Onceavo', 'ENE-ABR', 1),
(66, '1103', 'Onceavo', 'ENE-ABR', 1),
(67, '1104', 'Onceavo', 'ENE-ABR', 1),
(68, '1105', 'Onceavo', 'ENE-ABR', 1),
(69, '1106', 'Onceavo', 'ENE-ABR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_academ`
--

CREATE TABLE `historial_academ` (
  `id_historialaca` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `tutor_almhist` varchar(100) NOT NULL,
  `grupo_almhist` varchar(50) NOT NULL,
  `cuatri_almhist` varchar(50) NOT NULL,
  `periodcuat_almhist` varchar(50) NOT NULL,
  `estado_almhist` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_academ`
--

INSERT INTO `historial_academ` (`id_historialaca`, `id_alumno`, `tutor_almhist`, `grupo_almhist`, `cuatri_almhist`, `periodcuat_almhist`, `estado_almhist`) VALUES
(2, 25, 'Armando Estrada Jaimes', '101', 'Primero', 'SEP-DIC', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justificantes`
--

CREATE TABLE `justificantes` (
  `id_justificante` int(11) NOT NULL,
  `situacion_justif` varchar(1000) NOT NULL,
  `cuatrimestre_justif` varchar(1000) NOT NULL,
  `fecha_justif` date NOT NULL,
  `fecha_reg_justif` date NOT NULL,
  `fecha_acept_justif` date DEFAULT NULL,
  `estado_justif` tinyint(4) NOT NULL,
  `archivo_justif` varchar(200) DEFAULT NULL,
  `id_alumno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `justificantes`
--

INSERT INTO `justificantes` (`id_justificante`, `situacion_justif`, `cuatrimestre_justif`, `fecha_justif`, `fecha_reg_justif`, `fecha_acept_justif`, `estado_justif`, `archivo_justif`, `id_alumno`) VALUES
(1, 'Problemas de salud', 'Primero', '2018-08-16', '2018-08-16', '2018-08-16', 1, '', 25),
(2, 'problemas medicos', 'Primero', '2018-08-22', '2018-08-19', '2018-08-19', 1, '', 24),
(3, 'problemas personales', 'Segundo', '2018-08-20', '2018-08-19', '2018-08-19', 1, '', 24),
(4, 'problemas de salud', 'Tercero', '2018-08-14', '2018-08-19', '2018-08-19', 1, 'Apuntes de SQL.pdf', 24),
(5, 'problemas de salud', 'Primero', '2018-09-21', '2018-09-24', '2018-09-24', 1, '', 25),
(6, 'problemas familiares', 'Primero', '2018-10-04', '2018-10-06', '2019-01-28', 1, '', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` int(11) NOT NULL,
  `periodo_n` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id_periodo`, `periodo_n`) VALUES
(1, 'Ene - Abr'),
(2, 'May - Ago'),
(3, 'Sep - Dic');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`id_alumno`, `nombre`, `sexo`, `matricula`, `contraseña`, `id_carrera`, `fecha_nac`) VALUES
(10, 'Masrio', NULL, 'UTS15S-0sd05308', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(11, 'Marcso', NULL, 'sd', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(12, 'Alexs', NULL, 'UTS15S-0051sd01', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(13, 'Marios', NULL, 'UTS15fgfgS-005308', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(14, 'Marsco', NULL, 'UTS15S-sd005301', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(15, 'Mario', NULL, 'UTS15S-005308', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(16, 'Marco', NULL, 'UTS15S-005301', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL),
(17, 'Alex', NULL, 'UTS15S-005101', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportsprob`
--

CREATE TABLE `reportsprob` (
  `id_report` int(11) NOT NULL,
  `num_serie_rep` varchar(50) DEFAULT NULL,
  `fecha_reg_rep` date DEFAULT NULL,
  `estado_rep` tinyint(4) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tag_user` varchar(50) DEFAULT NULL,
  `describ_prob` varchar(500) DEFAULT NULL,
  `arch_prob` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reportsprob`
--

INSERT INTO `reportsprob` (`id_report`, `num_serie_rep`, `fecha_reg_rep`, `estado_rep`, `id_user`, `tag_user`, `describ_prob`, `arch_prob`) VALUES
(7, 'CODaplhs', '2019-02-18', 0, 1, 'Coordinador', 'dfgvhbjnkmfghnj', 'Sin imagen'),
(10, 'COD2sldw', '2019-02-18', 0, 1, 'Coordinador', 'Se soluciono en la versión 1.2 del sistema.', 'Sin imagen'),
(11, 'CODqnd0k', '2019-02-19', 1, 1, 'Coordinador', 'Solucionado el error solo falta probar que sea del agrado del coordinador.', 'Sin imagen'),
(16, 'COD9df8vvcp7', '2019-02-19', 1, 1, 'Administrador', 'Prueba de contenido nuevamente cambio en el git prueba num 2 nuevo codigo', 'Sin imagen'),
(17, 'CODomj5ov1bf', '2019-02-21', 1, 1, 'Coordinador', 'Se soluciono solo se necesita la aprobación trabajo de 18 horas', 'Sin imagen'),
(18, 'CODwscmoccp7', '2019-02-21', 1, 1, 'Coordinador', 'Problema resuelto en la actualización del pasado domingo', 'Sin imagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `represult`
--

CREATE TABLE `represult` (
  `id_represult` int(11) NOT NULL,
  `fecha_result` date DEFAULT NULL,
  `nota_result` varchar(500) DEFAULT NULL,
  `id_reportprob` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `represult`
--

INSERT INTO `represult` (`id_represult`, `fecha_result`, `nota_result`, `id_reportprob`) VALUES
(1, '2019-02-22', 'Prueba de contenido de la resolución del reporte', 7),
(2, '2019-03-03', 'Se soluciono el error en el apartado de coordinadores vista de perfil', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tut_personales`
--

CREATE TABLE `tut_personales` (
  `id_tutpersonales` int(11) NOT NULL,
  `razones_tut` varchar(200) NOT NULL,
  `prioridad_tut` varchar(50) DEFAULT NULL,
  `observaciones_tut` varchar(2000) DEFAULT NULL,
  `cuatrimestre_tut` varchar(50) DEFAULT NULL,
  `fecha_reg_obs` date DEFAULT NULL,
  `fecha_cita_tut` date DEFAULT NULL,
  `hora_cit_tut` time DEFAULT NULL,
  `fecha_acp_tut` date DEFAULT NULL,
  `id_alumno` int(11) NOT NULL,
  `estado_tut` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tut_personales`
--

INSERT INTO `tut_personales` (`id_tutpersonales`, `razones_tut`, `prioridad_tut`, `observaciones_tut`, `cuatrimestre_tut`, `fecha_reg_obs`, `fecha_cita_tut`, `hora_cit_tut`, `fecha_acp_tut`, `id_alumno`, `estado_tut`) VALUES
(1, 'Problemas emocionales', 'Alta', NULL, 'Primero', '2018-08-16', '2018-08-17', '14:00:00', '2018-08-16', 25, 1),
(2, 'problemas personales', 'Media', NULL, 'Primero', '2018-08-19', '2018-08-20', '14:00:00', '2018-08-19', 24, 1),
(3, 'problemas en la familia', 'Media', NULL, 'Segundo', '2018-08-19', '2018-08-20', '13:00:00', '2018-08-19', 24, 1),
(4, 'problemas falimiares', 'Alta', NULL, 'Tercero', '2018-08-19', '2018-08-21', '12:00:00', '2018-08-19', 24, 1),
(5, 'problemas de salud', 'Alta', NULL, 'Tercero', '2018-08-19', '2018-08-22', '13:00:00', '2018-08-19', 24, 1),
(6, 'familiares', 'Alta', NULL, 'Primero', '2018-09-24', '2018-09-26', '13:30:00', '2018-09-24', 25, 1),
(7, 'prueba fecha actual', 'Media', 'Prueba de contenido new', 'Primero', '2019-01-28', '2019-01-27', '02:09:00', '2019-01-28', 25, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `FK_alumnos_det_grupo` (`id_detgrupo`),
  ADD KEY `FK_alumnos_carreras` (`id_carrera`);

--
-- Indices de la tabla `bajasalm_dat`
--
ALTER TABLE `bajasalm_dat`
  ADD PRIMARY KEY (`id_bajaalmdat`),
  ADD KEY `FK_bajasalm_dat_alumnos` (`id_alumno`);

--
-- Indices de la tabla `becados_alm`
--
ALTER TABLE `becados_alm`
  ADD PRIMARY KEY (`id_becadoalm`),
  ADD KEY `FK_becados_alm_alumnos` (`id_alumno`);

--
-- Indices de la tabla `becas_alm`
--
ALTER TABLE `becas_alm`
  ADD PRIMARY KEY (`id_becaalm`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id_carrera`);

--
-- Indices de la tabla `ciclo_escolar`
--
ALTER TABLE `ciclo_escolar`
  ADD PRIMARY KEY (`id_ciclo_escolar`);

--
-- Indices de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  ADD PRIMARY KEY (`id_coordinador`);

--
-- Indices de la tabla `datpersonales_alm`
--
ALTER TABLE `datpersonales_alm`
  ADD PRIMARY KEY (`id_datpersonalesalm`),
  ADD KEY `FK_datpersonales_alm_alumnos` (`id_alumno`);

--
-- Indices de la tabla `datsistem`
--
ALTER TABLE `datsistem`
  ADD PRIMARY KEY (`id_datsistem`);

--
-- Indices de la tabla `det_grupo`
--
ALTER TABLE `det_grupo`
  ADD PRIMARY KEY (`id_detgrupo`),
  ADD KEY `FK_det_grupo_grupos` (`id_grupo`),
  ADD KEY `FK_det_grupo_docentes` (`id_docente`),
  ADD KEY `FK_det_grupo_carreras` (`id_carrera`);

--
-- Indices de la tabla `devop`
--
ALTER TABLE `devop`
  ADD PRIMARY KEY (`id_devop`);

--
-- Indices de la tabla `directores`
--
ALTER TABLE `directores`
  ADD PRIMARY KEY (`id_director`),
  ADD KEY `FK_directores_carreras` (`id_carrera`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `enctes_alm`
--
ALTER TABLE `enctes_alm`
  ADD PRIMARY KEY (`id_enctestalm`),
  ADD KEY `FK__alumnos` (`id_alumno`);

--
-- Indices de la tabla `evaluacion_test`
--
ALTER TABLE `evaluacion_test`
  ADD PRIMARY KEY (`id_evaltest`),
  ADD KEY `FK_evaluacion_test_enctes_alm` (`id_enctestalm`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `historial_academ`
--
ALTER TABLE `historial_academ`
  ADD PRIMARY KEY (`id_historialaca`),
  ADD KEY `FK_historial_academ_alumnos` (`id_alumno`);

--
-- Indices de la tabla `justificantes`
--
ALTER TABLE `justificantes`
  ADD PRIMARY KEY (`id_justificante`),
  ADD KEY `FK_justificantes_alumnos` (`id_alumno`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `reportsprob`
--
ALTER TABLE `reportsprob`
  ADD PRIMARY KEY (`id_report`);

--
-- Indices de la tabla `represult`
--
ALTER TABLE `represult`
  ADD PRIMARY KEY (`id_represult`),
  ADD KEY `FK_represult_reportsprob` (`id_reportprob`);

--
-- Indices de la tabla `tut_personales`
--
ALTER TABLE `tut_personales`
  ADD PRIMARY KEY (`id_tutpersonales`),
  ADD KEY `FK_tut_personales_alumnos` (`id_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `bajasalm_dat`
--
ALTER TABLE `bajasalm_dat`
  MODIFY `id_bajaalmdat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `becados_alm`
--
ALTER TABLE `becados_alm`
  MODIFY `id_becadoalm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `becas_alm`
--
ALTER TABLE `becas_alm`
  MODIFY `id_becaalm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id_carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `ciclo_escolar`
--
ALTER TABLE `ciclo_escolar`
  MODIFY `id_ciclo_escolar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `coordinadores`
--
ALTER TABLE `coordinadores`
  MODIFY `id_coordinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `datpersonales_alm`
--
ALTER TABLE `datpersonales_alm`
  MODIFY `id_datpersonalesalm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `datsistem`
--
ALTER TABLE `datsistem`
  MODIFY `id_datsistem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `det_grupo`
--
ALTER TABLE `det_grupo`
  MODIFY `id_detgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `devop`
--
ALTER TABLE `devop`
  MODIFY `id_devop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `directores`
--
ALTER TABLE `directores`
  MODIFY `id_director` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `enctes_alm`
--
ALTER TABLE `enctes_alm`
  MODIFY `id_enctestalm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evaluacion_test`
--
ALTER TABLE `evaluacion_test`
  MODIFY `id_evaltest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `historial_academ`
--
ALTER TABLE `historial_academ`
  MODIFY `id_historialaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `justificantes`
--
ALTER TABLE `justificantes`
  MODIFY `id_justificante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `reportsprob`
--
ALTER TABLE `reportsprob`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `represult`
--
ALTER TABLE `represult`
  MODIFY `id_represult` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tut_personales`
--
ALTER TABLE `tut_personales`
  MODIFY `id_tutpersonales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `FK_alumnos_carreras` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`),
  ADD CONSTRAINT `FK_alumnos_det_grupo` FOREIGN KEY (`id_detgrupo`) REFERENCES `det_grupo` (`id_detgrupo`);

--
-- Filtros para la tabla `bajasalm_dat`
--
ALTER TABLE `bajasalm_dat`
  ADD CONSTRAINT `FK_bajasalm_dat_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `becados_alm`
--
ALTER TABLE `becados_alm`
  ADD CONSTRAINT `FK_becados_alm_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `datpersonales_alm`
--
ALTER TABLE `datpersonales_alm`
  ADD CONSTRAINT `FK_datpersonales_alm_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `det_grupo`
--
ALTER TABLE `det_grupo`
  ADD CONSTRAINT `FK_det_grupo_carreras` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`),
  ADD CONSTRAINT `FK_det_grupo_docentes` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`),
  ADD CONSTRAINT `FK_det_grupo_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `directores`
--
ALTER TABLE `directores`
  ADD CONSTRAINT `FK_directores_carreras` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id_carrera`);

--
-- Filtros para la tabla `enctes_alm`
--
ALTER TABLE `enctes_alm`
  ADD CONSTRAINT `FK__alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `evaluacion_test`
--
ALTER TABLE `evaluacion_test`
  ADD CONSTRAINT `FK_evaluacion_test_enctes_alm` FOREIGN KEY (`id_enctestalm`) REFERENCES `enctes_alm` (`id_enctestalm`);

--
-- Filtros para la tabla `historial_academ`
--
ALTER TABLE `historial_academ`
  ADD CONSTRAINT `FK_historial_academ_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `justificantes`
--
ALTER TABLE `justificantes`
  ADD CONSTRAINT `FK_justificantes_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);

--
-- Filtros para la tabla `represult`
--
ALTER TABLE `represult`
  ADD CONSTRAINT `FK_represult_reportsprob` FOREIGN KEY (`id_reportprob`) REFERENCES `reportsprob` (`id_report`);

--
-- Filtros para la tabla `tut_personales`
--
ALTER TABLE `tut_personales`
  ADD CONSTRAINT `FK_tut_personales_alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
