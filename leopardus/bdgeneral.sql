-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2019 a las 20:38:36
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wpprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `tickets_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comentario` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total` double NOT NULL,
  `referred_email` varchar(100) NOT NULL,
  `referred_level` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `edo_liquidacion` tinyint(1) NOT NULL DEFAULT '0',
  `concepto` varchar(100) NOT NULL,
  `tipo_comision` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE `contenidos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `id` int(11) NOT NULL,
  `label` varchar(250) NOT NULL,
  `nameinput` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `requerido` tinyint(1) NOT NULL DEFAULT '0',
  `input_edad` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` varchar(200) NOT NULL DEFAULT 'text',
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `desactivable` tinyint(1) NOT NULL DEFAULT '1',
  `unico` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`id`, `label`, `nameinput`, `estado`, `requerido`, `input_edad`, `tipo`, `min`, `max`, `desactivable`, `unico`, `created_at`, `updated_at`) VALUES
(1, 'Nombre', 'firstname', 1, 1, 0, 'text', 0, 0, 0, 0, '2019-02-18 15:26:42', '2019-02-18 20:19:56'),
(2, 'Apellido', 'lastname', 1, 1, 0, 'text', 0, 0, 0, 0, '2019-02-18 20:12:39', '2019-02-19 01:12:39'),
(3, 'Sexo', 'genero', 1, 0, 0, 'select', 0, 0, 1, 0, '2019-03-01 00:03:55', '2019-03-01 05:03:55'),
(4, 'Fecha de Nacimiento', 'edad', 1, 1, 1, 'date', 0, 0, 1, 0, '2019-02-18 15:48:38', '2019-01-08 06:52:23'),
(5, 'Usuario', 'nameuser', 1, 1, 0, 'text', 0, 0, 0, 1, '2019-02-18 15:48:35', '2019-01-08 04:55:50'),
(12, 'N de Documento', 'document', 1, 1, 0, 'text', 5, 20, 1, 0, '2019-02-18 15:48:43', '2019-01-29 01:57:12'),
(7, 'Direccion', 'direccion', 1, 1, 0, 'text', 0, 0, 1, 0, '2019-02-18 15:48:41', '2019-02-09 02:33:39'),
(13, 'Direccion 2', 'direccion2', 0, 0, 0, 'text', 5, 100, 1, 0, '2019-02-18 15:48:46', '2019-01-30 03:19:23'),
(18, 'Estado', 'estado', 0, 1, 0, 'text', 20, 100, 1, 0, '2019-02-18 15:48:49', '2019-01-30 03:51:28'),
(38, 'Pais', 'pais', 0, 1, 0, 'text', 10, 20, 1, 0, '2019-02-18 15:48:51', '2019-01-30 19:24:23'),
(19, 'Ciudad', 'ciudad', 0, 1, 0, 'text', 20, 100, 1, 0, '2019-02-18 15:48:54', '2019-02-01 18:47:31'),
(20, 'Codigo Postal', 'codigo', 0, 0, 0, 'text', 7, 10, 1, 0, '2019-02-18 15:48:56', '2019-01-30 03:52:34'),
(21, 'Celular', 'phone', 0, 0, 0, 'number', 0, 0, 1, 0, '2019-02-18 15:48:59', '2019-01-30 19:18:56'),
(22, 'Telefono fijo', 'fijo', 0, 0, 0, 'number', 0, 0, 1, 0, '2019-02-18 15:49:01', '2019-01-30 03:54:11'),
(23, 'Facebook', 'facebook', 0, 0, 0, 'url', 30, 100, 1, 0, '2019-02-18 15:49:07', '2019-01-30 03:59:43'),
(24, 'Twitter', 'twitter', 0, 0, 0, 'url', 30, 100, 1, 0, '2019-02-18 15:49:09', '2019-01-30 04:01:10'),
(25, 'Nombre del Banco', 'banco', 0, 0, 0, 'text', 20, 40, 1, 0, '2019-02-18 15:49:11', '2019-01-30 04:01:45'),
(26, 'Nombre de la rama', 'Branch', 0, 0, 0, 'text', 20, 50, 1, 0, '2019-02-18 15:49:14', '2019-01-30 04:03:42'),
(27, 'Titular de la cuenta', 'titular', 0, 0, 0, 'text', 20, 40, 1, 0, '2019-02-18 15:49:16', '2019-01-30 04:04:11'),
(28, 'Numero de cuenta', 'cuenta', 0, 0, 0, 'number', 0, 0, 1, 0, '2019-02-18 15:49:18', '2019-01-30 04:04:38'),
(29, 'Codigo IFSC', 'ifsc', 0, 0, 0, 'text', 0, 0, 1, 0, '2019-02-18 15:49:21', '2019-02-01 18:47:25'),
(30, 'Numero PAN', 'pan', 0, 0, 0, 'number', 0, 0, 1, 0, '2019-02-18 15:49:23', '2019-01-30 04:07:15'),
(31, 'Cuenta Paypal', 'paypal', 0, 0, 0, 'text', 10, 20, 1, 0, '2019-02-18 15:49:25', '2019-01-30 04:08:26'),
(32, 'Direccion de Blocktrail', 'blocktrail', 0, 0, 0, 'text', 10, 20, 1, 0, '2019-02-18 15:49:27', '2019-01-30 04:09:16'),
(33, 'Direccion de blockchain', 'blockchain', 0, 0, 0, 'text', 10, 20, 1, 0, '2019-02-18 15:49:29', '2019-01-30 04:09:40'),
(34, 'Direccion de Bitgo', 'bitgo', 0, 0, 0, 'text', 10, 20, 1, 0, '2019-02-18 15:49:36', '2019-01-30 04:10:03'),
(39, 'Metodo de pago', 'pago', 0, 0, 0, 'select', 0, 0, 1, 0, '2019-02-18 15:49:39', '2019-01-30 19:25:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `header_navs`
--

CREATE TABLE `header_navs` (
  `id` int(10) UNSIGNED NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callback` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidaciones`
--

CREATE TABLE `liquidaciones` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `comision` float NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_actions`
--

CREATE TABLE `menu_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `callback` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `simbolo` varchar(200) NOT NULL,
  `mostrar_a_d` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 o false - despue del monto, 1 o true - antes del monto',
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_type` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `route` varchar(200) NOT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_select`
--

CREATE TABLE `opciones_select` (
  `id` int(11) NOT NULL,
  `idselect` int(11) NOT NULL,
  `valor` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones_select`
--

INSERT INTO `opciones_select` (`id`, `idselect`, `valor`, `created_at`, `updated_at`) VALUES
(1, 3, 'M', '2019-01-08 02:13:50', '2019-01-08 02:13:50'),
(2, 3, 'F', '2019-01-08 02:13:50', '2019-01-08 02:13:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `iduser` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `monto` float NOT NULL,
  `fechasoli` date NOT NULL,
  `fechapago` date DEFAULT NULL,
  `metodo` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tipopago` text,
  `descuento` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referidos` int(11) DEFAULT '0',
  `refeact` int(11) DEFAULT '0',
  `referidosd` int(11) DEFAULT NULL,
  `compras` float DEFAULT '0',
  `grupal` float DEFAULT NULL COMMENT 'puntos grupales',
  `comisiones` float DEFAULT '0',
  `bonos` float DEFAULT '0',
  `niveles` int(11) DEFAULT '0',
  `rolprevio` int(11) DEFAULT NULL,
  `acepta_comision` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesions`
--

CREATE TABLE `sesions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actividad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingactivacion`
--

CREATE TABLE `settingactivacion` (
  `id` int(11) NOT NULL,
  `tipoactivacion` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 - producto, 2 - dinero',
  `tiporecompra` tinyint(4) DEFAULT '0' COMMENT '1 - producto, 2 - dinero',
  `requisitoactivacion` float NOT NULL,
  `requisitorecompra` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingcliente`
--

CREATE TABLE `settingcliente` (
  `id` int(11) NOT NULL,
  `cliente` tinyint(1) NOT NULL,
  `permiso` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingcomision`
--

CREATE TABLE `settingcomision` (
  `id` int(11) NOT NULL,
  `niveles` int(11) NOT NULL,
  `tipocomision` varchar(200) NOT NULL,
  `valorgeneral` float NOT NULL,
  `valordetallado` text NOT NULL,
  `tipopago` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comisionretiro` float DEFAULT NULL COMMENT 'esta es para el metodo de pago, es la comision por retiro de dinero en la billetera',
  `comisiontransf` float DEFAULT NULL COMMENT 'esta es para el metodo de pago, es la comision por transferencia de dinero en la billetera',
  `bonoactivacion` float DEFAULT NULL,
  `directos` tinyint(1) DEFAULT '1' COMMENT 'si solo los directos aceptan el bono de activacion',
  `primera_compra` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingpagos`
--

CREATE TABLE `settingpagos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `feed` float NOT NULL,
  `monto_min` float DEFAULT '0',
  `tipofeed` tinyint(1) NOT NULL COMMENT '0 - monto fijo 1 - porcentaje',
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `correo` tinyint(1) DEFAULT '0',
  `wallet` tinyint(1) DEFAULT '0',
  `datosbancarios` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingpermiso`
--

CREATE TABLE `settingpermiso` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `nameuser` varchar(200) NOT NULL,
  `nuevo_registro` tinyint(4) DEFAULT '0',
  `red_usuario` tinyint(4) DEFAULT '0',
  `vision_usuario` tinyint(4) DEFAULT '0',
  `billetera` tinyint(4) DEFAULT '0',
  `pago` tinyint(4) DEFAULT '0',
  `informes` tinyint(4) DEFAULT '0',
  `tickets` tinyint(4) DEFAULT '0',
  `buzon` tinyint(4) DEFAULT '0',
  `ranking` tinyint(4) DEFAULT '0',
  `historial_actividades` tinyint(4) DEFAULT '0',
  `email_marketing` tinyint(4) DEFAULT '0',
  `administrar_redes` tinyint(4) DEFAULT '0',
  `soporte` tinyint(4) DEFAULT '0',
  `ajuste` tinyint(4) DEFAULT '0',
  `herramienta` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingplantilla`
--

CREATE TABLE `settingplantilla` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `contenido` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AIO System',
  `slogan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Uno para todo.',
  `name_styled` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'AIO <strong>System</strong>',
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_type` int(11) DEFAULT NULL,
  `enable_register` tinyint(1) DEFAULT '1',
  `enable_auth_fb` tinyint(1) DEFAULT '0',
  `enable_auth_tw` tinyint(1) DEFAULT '0',
  `enable_auth_google` tinyint(1) DEFAULT '0',
  `version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0.2.0',
  `keycode` int(11) DEFAULT NULL,
  `logo` int(11) DEFAULT '1',
  `rol_default` int(11) DEFAULT '3',
  `status_web` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_id_default` int(11) NOT NULL DEFAULT '1',
  `referred_level_max` int(11) NOT NULL DEFAULT '5',
  `edad_minino` int(11) NOT NULL COMMENT 'edad minimo para ingresar al sistema',
  `licencia` text COLLATE utf8mb4_unicode_ci,
  `fecha_vencimiento` date DEFAULT NULL,
  `prefijo_wp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_no_comision` text COLLATE utf8mb4_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settingsestructura`
--

CREATE TABLE `settingsestructura` (
  `id` int(11) NOT NULL,
  `tipoestructura` varchar(50) NOT NULL,
  `cantnivel` int(11) NOT NULL,
  `cantfilas` int(11) DEFAULT NULL,
  `estructuraprincipal` tinyint(1) DEFAULT NULL COMMENT '1: arbol - 2: matriz',
  `usuarioprincipal` tinyint(1) DEFAULT NULL COMMENT '1: admin - 2:user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `setttingsroles`
--

CREATE TABLE `setttingsroles` (
  `id` int(11) NOT NULL,
  `rangos` int(11) NOT NULL,
  `compras` tinyint(1) DEFAULT '0',
  `comisiones` tinyint(1) DEFAULT '0',
  `niveles` tinyint(1) DEFAULT '0',
  `referidos` tinyint(1) DEFAULT '0',
  `referidosact` tinyint(1) DEFAULT '0',
  `referidosd` tinyint(1) DEFAULT '0',
  `grupal` tinyint(1) DEFAULT '0' COMMENT 'puntos grupales',
  `valorpuntos` float DEFAULT NULL,
  `bonos` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sidebars`
--

CREATE TABLE `sidebars` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0' COMMENT '0 = sidebar para usuarios. 1 =Sidebar para Administrador. 2 = Sidebar para ambos',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sidebar_headers`
--

CREATE TABLE `sidebar_headers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sidebar_items`
--

CREATE TABLE `sidebar_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sidebar_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentario` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `admin` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'assets/img/avatar.png',
  `provider` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users2`
--

CREATE TABLE `users2` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `dni` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `names` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_names` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` timestamp,
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `provider` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_id` int(11) DEFAULT '0',
  `sponsor_id` bigint(20) DEFAULT '0',
  `position_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `rol_id` int(11) NOT NULL DEFAULT '1',
  `wallet_amount` double NOT NULL DEFAULT '0',
  `bank_amount` double NOT NULL DEFAULT '0',
  `clave` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activacion` tinyint(1) DEFAULT '0',
  `token_correo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipouser` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'Normal'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_campo`
--

CREATE TABLE `user_campo` (
  `ID` bigint(20) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `genero` varchar(250) DEFAULT NULL,
  `edad` date DEFAULT NULL,
  `nameuser` varchar(250) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `document` varchar(250) DEFAULT NULL,
  `direccion2` varchar(250) DEFAULT NULL,
  `estado` varchar(250) DEFAULT NULL,
  `ciudad` varchar(250) DEFAULT NULL,
  `codigo` varchar(250) DEFAULT NULL,
  `phone` float DEFAULT NULL,
  `fijo` float DEFAULT NULL,
  `facebook` varchar(250) DEFAULT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `banco` varchar(250) DEFAULT NULL,
  `Branch` varchar(250) DEFAULT NULL,
  `titular` varchar(250) DEFAULT NULL,
  `cuenta` float DEFAULT NULL,
  `ifsc` varchar(250) DEFAULT NULL,
  `pan` float DEFAULT NULL,
  `paypal` varchar(250) DEFAULT NULL,
  `blocktrail` varchar(250) DEFAULT NULL,
  `blockchain` varchar(250) DEFAULT NULL,
  `bitgo` varchar(250) DEFAULT NULL,
  `pais` varchar(250) DEFAULT NULL,
  `pago` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `walletlog`
--

CREATE TABLE `walletlog` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `debito` float NOT NULL,
  `credito` float NOT NULL,
  `balance` float NOT NULL,
  `descuento` float NOT NULL,
  `tipotransacion` tinyint(4) NOT NULL COMMENT '0 - transferencia, 1 - retiros, 2 - comisiones,  3 - liquidaciones',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentarios_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`,`nameinput`);

--
-- Indices de la tabla `header_navs`
--
ALTER TABLE `header_navs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liquidaciones`
--
ALTER TABLE `liquidaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu_actions`
--
ALTER TABLE `menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `opciones_select`
--
ALTER TABLE `opciones_select`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sesions`
--
ALTER TABLE `sesions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sesions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `settingactivacion`
--
ALTER TABLE `settingactivacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingcliente`
--
ALTER TABLE `settingcliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingcomision`
--
ALTER TABLE `settingcomision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingpagos`
--
ALTER TABLE `settingpagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingpermiso`
--
ALTER TABLE `settingpermiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingplantilla`
--
ALTER TABLE `settingplantilla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settingsestructura`
--
ALTER TABLE `settingsestructura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `setttingsroles`
--
ALTER TABLE `setttingsroles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sidebars`
--
ALTER TABLE `sidebars`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sidebar_headers`
--
ALTER TABLE `sidebar_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sidebar_items`
--
ALTER TABLE `sidebar_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indices de la tabla `user_campo`
--
ALTER TABLE `user_campo`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `walletlog`
--
ALTER TABLE `walletlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contenidos`
--
ALTER TABLE `contenidos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `header_navs`
--
ALTER TABLE `header_navs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `liquidaciones`
--
ALTER TABLE `liquidaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu_actions`
--
ALTER TABLE `menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opciones_select`
--
ALTER TABLE `opciones_select`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesions`
--
ALTER TABLE `sesions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingactivacion`
--
ALTER TABLE `settingactivacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingcliente`
--
ALTER TABLE `settingcliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingcomision`
--
ALTER TABLE `settingcomision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingpagos`
--
ALTER TABLE `settingpagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingpermiso`
--
ALTER TABLE `settingpermiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingplantilla`
--
ALTER TABLE `settingplantilla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `settingsestructura`
--
ALTER TABLE `settingsestructura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `setttingsroles`
--
ALTER TABLE `setttingsroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sidebars`
--
ALTER TABLE `sidebars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sidebar_headers`
--
ALTER TABLE `sidebar_headers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sidebar_items`
--
ALTER TABLE `sidebar_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users2`
--
ALTER TABLE `users2`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `walletlog`
--
ALTER TABLE `walletlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
