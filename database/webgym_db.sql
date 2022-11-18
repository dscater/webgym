-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2022 a las 19:03:15
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `webgym_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materno` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_cobro` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracions`
--

CREATE TABLE `configuracions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_sistema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configuracions`
--

INSERT INTO `configuracions` (`id`, `nombre_sistema`, `alias`, `razon_social`, `nit`, `ciudad`, `dir`, `fono`, `web`, `actividad`, `correo`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'SISTEMA DE ADMINISTRACIÓN DE GIMNASIO CON RFID', 'WEBGYM', 'EMPRESA DE PRUEBA GIMNASIO', '1212121', 'LA PAZ', 'LOS OLIVOS', '222222', '', 'ACTIVIDAD', '', '1668795859_logo.png', NULL, '2022-11-18 18:24:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(24,2) NOT NULL,
  `subtotal` decimal(24,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(155) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paterno` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materno` varchar(155) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci_exp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fono_referencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salario` decimal(24,2) NOT NULL,
  `horario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion_fisicas`
--

CREATE TABLE `evaluacion_fisicas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `talla` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_sangre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persona_referencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `peso_inicial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patologias` text COLLATE utf8mb4_unicode_ci,
  `obs_postura` text COLLATE utf8mb4_unicode_ci,
  `recomendaciones` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imcs`
--

CREATE TABLE `imcs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluacion_id` bigint(20) UNSIGNED NOT NULL,
  `peso1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peso4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imc1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imc2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imc3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imc4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `glicemia1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `glicemia2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `glicemia3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `glicemia4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rpm1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rpm2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rpm3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rpm4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpm1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpm2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpm3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lpm4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oxigeno1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oxigeno2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oxigeno3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `oxigeno4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_productos`
--

CREATE TABLE `ingreso_productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcions`
--

CREATE TABLE `inscripcions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `codigo_rfid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento_maquinas`
--

CREATE TABLE `mantenimiento_maquinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `maquina_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_mantenimiento` date DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `fecha_proximo` date DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_incorporacion` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000001_create_sucursals_table', 1),
(2, '2014_10_12_000002_create_users_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_10_13_132625_create_configuracions_table', 1),
(5, '2022_11_18_144204_create_plans_table', 1),
(6, '2022_11_18_144548_create_clientes_table', 1),
(7, '2022_11_18_144833_create_empleados_table', 1),
(8, '2022_11_18_145102_create_categorias_table', 1),
(9, '2022_11_18_145103_create_maquinas_table', 1),
(10, '2022_11_18_145359_create_mantenimiento_maquinas_table', 1),
(11, '2022_11_18_145527_create_inscripcions_table', 1),
(12, '2022_11_18_145718_create_accesos_table', 1),
(13, '2022_11_18_145834_create_cobros_table', 1),
(14, '2022_11_18_145937_create_evaluacion_fisicas_table', 1),
(15, '2022_11_18_150435_create_pliegues_table', 1),
(16, '2022_11_18_150444_create_perimetrias_table', 1),
(17, '2022_11_18_150459_create_imcs_table', 1),
(18, '2022_11_18_151115_create_productos_table', 1),
(19, '2022_11_18_151528_create_ingreso_productos_table', 1),
(20, '2022_11_18_151616_create_ventas_table', 1),
(21, '2022_11_18_151800_create_detalle_ventas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perimetrias`
--

CREATE TABLE `perimetrias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluacion_id` bigint(20) UNSIGNED NOT NULL,
  `hombros1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hombros2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hombros3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hombros4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pecho1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pecho2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pecho3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pecho4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_relajado1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_relajado2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_relajado3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_relajado4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_contraido1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_contraido2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_contraido3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biceps_contraido4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `antebrazo1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `antebrazo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `antebrazo3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `antebrazo4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muneca1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muneca2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muneca3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muneca4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cintura1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cintura2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cintura3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cintura4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdomen1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdomen2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdomen3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdomen4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadera1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadera2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadera3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cadera4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodilla1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodilla2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodilla3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rodilla4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tobillo1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tobillo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tobillo3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tobillo4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo` decimal(24,2) NOT NULL,
  `duracion` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pliegues`
--

CREATE TABLE `pliegues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluacion_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `bicipital1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bicipital2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bicipital3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bicipital4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tricipital1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tricipital2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tricipital3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tricipital4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subescapular1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subescapular2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subescapular3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subescapular4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `axilar1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `axilar2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `axilar3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `axilar4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pectoral1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pectoral2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pectoral3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pectoral4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdominal1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdominal2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdominal3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abdominal4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supraliaco1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supraliaco2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supraliaco3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supraliaco4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muslo4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pantorilla4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resultado4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `precio` decimal(24,2) NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_actual` int(11) NOT NULL,
  `ingresos` int(11) NOT NULL,
  `salidas` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursals`
--

CREATE TABLE `sucursals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursals`
--

INSERT INTO `sucursals` (`id`, `nombre`, `dir`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, '*', NULL, '2022-11-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `codigo`, `email`, `password`, `correo`, `tipo`, `foto`, `sucursal_id`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$cDSOdzTsMDQAfqcb6.WFtu40s.wmQ4Jl8poIwW69MSZnnedD3prKu', NULL, 'GERENTE', 'default.png', 1, '2022-11-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sucursal_id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(24,2) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_venta_id_foreign` (`venta_id`),
  ADD KEY `detalle_ventas_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleados_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `evaluacion_fisicas`
--
ALTER TABLE `evaluacion_fisicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imcs`
--
ALTER TABLE `imcs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imcs_evaluacion_id_foreign` (`evaluacion_id`);

--
-- Indices de la tabla `ingreso_productos`
--
ALTER TABLE `ingreso_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingreso_productos_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `ingreso_productos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inscripcions_codigo_rfid_unique` (`codigo_rfid`),
  ADD KEY `inscripcions_cliente_id_foreign` (`cliente_id`),
  ADD KEY `inscripcions_plan_id_foreign` (`plan_id`),
  ADD KEY `inscripcions_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `mantenimiento_maquinas`
--
ALTER TABLE `mantenimiento_maquinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mantenimiento_maquinas_maquina_id_foreign` (`maquina_id`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maquinas_categoria_id_foreign` (`categoria_id`),
  ADD KEY `maquinas_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perimetrias`
--
ALTER TABLE `perimetrias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perimetrias_evaluacion_id_foreign` (`evaluacion_id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `pliegues`
--
ALTER TABLE `pliegues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pliegues_evaluacion_id_foreign` (`evaluacion_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `productos_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_codigo_unique` (`codigo`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_sucursal_id_foreign` (`sucursal_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `ventas_cliente_id_foreign` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracions`
--
ALTER TABLE `configuracions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `evaluacion_fisicas`
--
ALTER TABLE `evaluacion_fisicas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imcs`
--
ALTER TABLE `imcs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_productos`
--
ALTER TABLE `ingreso_productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenimiento_maquinas`
--
ALTER TABLE `mantenimiento_maquinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `perimetrias`
--
ALTER TABLE `perimetrias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pliegues`
--
ALTER TABLE `pliegues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursals`
--
ALTER TABLE `sucursals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `detalle_ventas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `imcs`
--
ALTER TABLE `imcs`
  ADD CONSTRAINT `imcs_evaluacion_id_foreign` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion_fisicas` (`id`);

--
-- Filtros para la tabla `ingreso_productos`
--
ALTER TABLE `ingreso_productos`
  ADD CONSTRAINT `ingreso_productos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `ingreso_productos_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `inscripcions`
--
ALTER TABLE `inscripcions`
  ADD CONSTRAINT `inscripcions_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `inscripcions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `inscripcions_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `mantenimiento_maquinas`
--
ALTER TABLE `mantenimiento_maquinas`
  ADD CONSTRAINT `mantenimiento_maquinas_maquina_id_foreign` FOREIGN KEY (`maquina_id`) REFERENCES `maquinas` (`id`);

--
-- Filtros para la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD CONSTRAINT `maquinas_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `maquinas_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `perimetrias`
--
ALTER TABLE `perimetrias`
  ADD CONSTRAINT `perimetrias_evaluacion_id_foreign` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion_fisicas` (`id`);

--
-- Filtros para la tabla `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `pliegues`
--
ALTER TABLE `pliegues`
  ADD CONSTRAINT `pliegues_evaluacion_id_foreign` FOREIGN KEY (`evaluacion_id`) REFERENCES `evaluacion_fisicas` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `productos_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
