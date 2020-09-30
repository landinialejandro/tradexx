-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2020 a las 00:25:34
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tradexx_01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `Account` varchar(40) DEFAULT NULL,
  `masterAccount` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `account`
--

INSERT INTO `account` (`id`, `Account`, `masterAccount`, `code`) VALUES
(1, 'Venta', NULL, 'VENTA'),
(2, 'Credit Card', NULL, 'CC'),
(3, 'Cash', NULL, 'CASH'),
(4, 'Compra', NULL, 'COMPRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accounting`
--

CREATE TABLE `accounting` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `master_acount` int(10) UNSIGNED DEFAULT NULL,
  `account` int(10) UNSIGNED DEFAULT NULL,
  `sub_account` int(10) UNSIGNED DEFAULT NULL,
  `type` int(10) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `invoice` int(10) UNSIGNED DEFAULT NULL,
  `account_plan` int(10) UNSIGNED DEFAULT NULL,
  `master_account` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(40) DEFAULT 'OPEN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accounting`
--

INSERT INTO `accounting` (`id`, `date`, `description`, `master_acount`, `account`, `sub_account`, `type`, `amount`, `balance`, `invoice`, `account_plan`, `master_account`, `status`) VALUES
(1, '2020-09-29', 'MOVIMIENTO AUTOMATICO: Salida por venta  Invoice:1', NULL, 1, 1, 1, '-12.50', NULL, 1, 1, 1, 'CLOSED'),
(2, '2020-09-29', 'MOVIMIENTO AUTOMATICO: Cobro por venta con tarjeta de credito VISA<br>  Invoice:1', NULL, 2, 2, 2, '12.50', NULL, 1, 2, 2, 'CLOSED');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accountplan`
--

CREATE TABLE `accountplan` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `code` varchar(40) NOT NULL,
  `master_account` int(10) UNSIGNED NOT NULL,
  `account` int(10) UNSIGNED NOT NULL,
  `sub_account` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `accountplan`
--

INSERT INTO `accountplan` (`id`, `description`, `code`, `master_account`, `account`, `sub_account`, `type`) VALUES
(1, 'Salida por venta', 'VENTA', 1, 1, 1, 1),
(2, 'Cobro por venta con tarjeta de credito VISA<br>', 'CC-VISA', 2, 2, 2, 2),
(3, 'Cobro por venta con tarjeta de credito AMEX<br>', 'CC-AMEX', 2, 2, 3, 2),
(4, 'Cobro por venta en EFECTIVO<br>', 'CC-CASH', 2, 3, 4, 2),
(5, 'Salida por COMPRA en efectivo<br>', 'PA-CASH', 3, 3, 4, 1),
(6, 'Ingreso por compra<br>', 'COMPRA', 4, 4, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Priority` varchar(40) DEFAULT NULL,
  `Assigned` int(10) UNSIGNED DEFAULT NULL,
  `Completed` blob DEFAULT NULL,
  `Stop` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alert`
--

CREATE TABLE `alert` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Satus` varchar(40) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brand`
--

CREATE TABLE `brand` (
  `id` int(10) UNSIGNED NOT NULL,
  `Brand` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `brand`
--

INSERT INTO `brand` (`id`, `Brand`) VALUES
(1, 'KIA'),
(2, 'HYUNDAI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc`
--

CREATE TABLE `cc` (
  `id` int(10) UNSIGNED NOT NULL,
  `Card` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ccjournal`
--

CREATE TABLE `ccjournal` (
  `id` int(10) UNSIGNED NOT NULL,
  `Card` int(10) UNSIGNED DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Cleared` blob DEFAULT NULL,
  `Amount` varchar(40) DEFAULT NULL,
  `Balance` decimal(10,2) DEFAULT NULL,
  `Logged` int(10) UNSIGNED NOT NULL,
  `Photo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ceo`
--

CREATE TABLE `ceo` (
  `id` int(10) UNSIGNED NOT NULL,
  `Chief` varchar(40) DEFAULT NULL,
  `Department` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `Province` int(10) UNSIGNED DEFAULT NULL,
  `City` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`id`, `Province`, `City`) VALUES
(1, 1, 'DOLEGA'),
(2, 1, 'BOQUETE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `claim`
--

CREATE TABLE `claim` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Invoice` text DEFAULT NULL,
  `Warehouse` int(10) UNSIGNED DEFAULT NULL,
  `Tracking` int(10) UNSIGNED DEFAULT NULL,
  `Selecteds` varchar(40) DEFAULT NULL,
  `Shippingt` varchar(40) DEFAULT NULL,
  `Status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `claim`
--

INSERT INTO `claim` (`id`, `Date`, `Invoice`, `Warehouse`, `Tracking`, `Selecteds`, `Shippingt`, `Status`) VALUES
(1, '2020-09-17', '151706C', 9, 1, 'OCEAN FREIGHT', 'AIR FREIGHT', 'OPEN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Employee` int(10) UNSIGNED DEFAULT NULL,
  `Description` int(10) UNSIGNED DEFAULT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Odate` date DEFAULT NULL,
  `ETA` date DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'UNPAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `Country` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `Country`) VALUES
(1, 'PANAMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm`
--

CREATE TABLE `crm` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Interaction` varchar(40) DEFAULT 'INBOUND',
  `Inboundtype` varchar(40) DEFAULT 'WHATSAPP',
  `Type` varchar(40) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Priority` varchar(40) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Timestamp` datetime DEFAULT NULL,
  `Sent` blob DEFAULT NULL,
  `Assigned` int(10) UNSIGNED DEFAULT NULL,
  `Url` varchar(200) DEFAULT NULL,
  `Url_1` varchar(200) DEFAULT NULL,
  `Url_2` varchar(200) DEFAULT NULL,
  `Url_3` varchar(200) DEFAULT NULL,
  `Url_4` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `crm`
--

INSERT INTO `crm` (`id`, `Customer`, `Interaction`, `Inboundtype`, `Type`, `Description`, `Comments`, `Priority`, `Status`, `Timestamp`, `Sent`, `Assigned`, `Url`, `Url_1`, `Url_2`, `Url_3`, `Url_4`) VALUES
(1, 1, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de bomba de Hydraulic Pump, Steering System', 'Cotizacion de bomba de Hydraulic Pump, Steering System \r\n181.45 + 10.00 + 30.00 = 221.45$', 'PRIORITY 2', 'OPEN', '2020-09-14 10:42:32', NULL, NULL, 'https://www.ebay.com/itm/LAUBER-Hydraulic-Pump-steering-system-55-9263/152781174050', NULL, NULL, NULL, NULL),
(2, 2, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización Mini Foldable Car Door', 'Mini Foldable Car Door Latch Hook Step Foot Pedal Ladder For SUV Truck Roof\r\n1pc.  $19.16+. 5.00      +. 2.00     = $26.16\r\n2pcs. $38.32+. 10.00     +.  2.00    = $50.32', NULL, NULL, '2020-09-14 11:02:09', NULL, NULL, 'https://www.ebay.com/itm/1Pcs-Mini-Foldable-Car-Door-Latch-Hook-Step-Foot-Pedal-Ladder-For-SUV-Truck-Roof/312723248973?fits=Model%253ACherokee%257CMake%253AJeep&hash=item48cfc2174d:g:3S4AAOSwIUddR8CL', NULL, NULL, NULL, NULL),
(3, 3, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de válvula EGR, Fuel Injection Pressure Regulator Assy', 'Cotización de\r\n- válvula EGR\r\nOEM: 164.41 + 3.50 + 20.00 = 187.91$\r\nAftermaket:  98.21 + 3.50 + 20.00 = 121.71$\r\n -Fuel Injection Pressure Regulator Assy\r\nOriginal Toyota: 119.94$\r\nAftermaket: 49.18$', 'PRIORITY 2', 'OPEN', '2020-09-14 11:29:31', NULL, NULL, 'https://partsouq.com/en/search/search?q=2562075030', 'https://www.rockauto.com/en/parts/wve,4F1650,egr+valve,4968', 'https://www.ebay.com/itm/Genuine-OEM-Toyota-23280-75020-Fuel-Injection-Pressure-Regulator-Assy/233588843864', 'https://www.ebay.com/itm/23280-75020-FUEL-INJECTION-PRESSURE-REGULATOR-PR271-Fit-TOYOTA-TACOMA-2-7L-95-04/373139128605', NULL),
(4, 4, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización audífonos', 'HyperX Cloud Stinger - Auriculares de diadema para videojuegos, PS4 oficial con licencia para PlayStation4, ligeros, con almohadillas giratorias, espuma de memoria, comodidad, durabilidad, deslizadores de acero, micrófono de cancelación de ruido de giro a silencio\r\n\r\n       $ 50.73+16.00+5.00= $71.73', NULL, NULL, '2020-09-14 11:52:03', NULL, NULL, 'https://www.amazon.com/-/e...s/dp/B07XFYSTD4', NULL, NULL, NULL, NULL),
(5, 5, 'INBOUND', 'WHATSAPP', NULL, 'cotización t shit', 'Madera Sin Prohibido - Zelda Camiseta Zelda Camisa La Leyenda de Zelda Wind Waker Camisa Enlace Tee Prohibido Woods Zelda Camisa    NEGRO TALLA M   \r\n27,29 US$ + 3.50+2.00    =. $ 32.79', NULL, NULL, '2020-09-14 14:03:39', NULL, NULL, 'https://www.etsy.com/es/listing/575538886/madera-sin-prohibido-zelda-camiseta?ref=related-2&variation1=773319410&variation0=792011449', NULL, NULL, NULL, NULL),
(6, 6, 'INBOUND', 'WHATSAPP', NULL, NULL, '1.8T 20V Forged Piston & Steel Con-Rod Set by Wiseco & BAR-TEK®\r\n\r\n1114.23+.  42.75     +. 5.00   = 1161.98', NULL, NULL, '2020-09-14 15:06:55', NULL, NULL, 'https://www.bar-tek-tuning.com/1-8t-pistons-conrods-set-wiseco-bar-tek', NULL, NULL, NULL, NULL),
(7, 6, 'INBOUND', 'WHATSAPP', NULL, NULL, '1.8T 20V Forged Piston & Steel Con-Rod Set by Wiseco & BAR-TEK®\r\n\r\n1114.23+.  42.75     +. 5.00   = 1161.98', NULL, NULL, '2020-09-14 16:52:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 7, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización cable fibra óptica', 'Gota FTTH cable 1 2 4 core FRP alambre de acero MIEMBRO DE FUERZA INTERIOR Cable de fibra óptica\r\n3000 metros  1 hebra \r\n\r\n3000 metros 2 hebra', NULL, NULL, '2020-09-15 09:59:03', NULL, NULL, 'https://spanish.alibaba.com/product-detail/ftth-drop-cable-1-2-4-core-frp-steel-wire-strength-member-indoor-fiber-optic-cable-62131101908.html?spm=a2700.galleryofferlist.0.0.7a967585oma12E', NULL, NULL, NULL, NULL),
(9, 8, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de flete de Soplador de hojas inalámbrico,', '- Soplador de hojas inalámbrico\r\n30X10X8  18V/5R\r\n26.00$\r\n- Bloque magnético de cuchillos \r\n15X5X10  6V/9R\r\n27.00$', 'PRIORITY 2', 'OPEN', '2020-09-15 10:21:07', NULL, 1, 'https://www.amazon.com/-/es/dp/B0881K29P6/?coliid=I151S1FJQM7KG0&colid=1Z1S95L7HD60V&psc=1&ref_=lv_ov_lig_dp_it', 'https://www.amazon.com/-/es/dp/B07H1S6Y4F/?coliid=I1S3IOT3UFDE8V&colid=1Z1S95L7HD60V&ref_=lv_ov_lig_dp_it&th=1', NULL, NULL, NULL),
(10, 10, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de bateria de computadora', 'Genuine Original  Battery Toshiba Satellite \r\n35.99 + 15.00 + 3.50 = 54.49$', 'PRIORITY 2', 'OPEN', '2020-09-15 11:30:11', NULL, 1, 'https://www.ebay.com/itm/Genuine-Original-PA5185U-1BRS-PA5186U-1BRS-Battery-Toshiba-Satellite-C55T-C55D/173981440572', NULL, NULL, NULL, NULL),
(11, 9, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización Cudy WE3000 AX 3000Mbps', 'Cudy WE3000 AX 3000Mbps Wireless WiFi 6 PCIe Card for PC, Bluetooth 5.0, AX200 Module Inside, 2402Mbps+574Mbps WiFi 6 Speed, Bluetooth 5.0/4.2/4.0, 802.11ax/ac/a/b/g/n, Windows 10 64-bit Only\r\n\r\n   $25.90+3.50+2.00  =$31.40', NULL, NULL, '2020-09-15 11:37:18', NULL, NULL, 'https://www.amazon.com/dp/B082NZYDDM/ref=cm_sw_r_wa_apa_i_qq9xFbJ8G3MRG', NULL, NULL, NULL, NULL),
(12, 12, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Elevador de ventanas izquierdo', 'Elevador de ventanas izquierdo y bota aguas\r\nKia Optima 2003\r\nGENUINE Window Regulator Front Left Fits 99-06 Sonata Kia Optima OEM 82403-38011\r\n$38.40+.11.25     +.  15.00  =. AEREO $64.65   MARITIMO  $60.40\r\n-Smoke Window Sun Vent Visor Rain Guards 4P A046 For KIA 2000-2005 Optima Regal\r\n34.97+. 14.25    +15.00   =      AERERO $64.22.   MARITIMO $58.97', 'PRIORITY 1', 'OPEN', '2020-09-15 12:55:12', NULL, 2, 'https://www.amazon.com/-/es/Elevalunas-eléctrico-delantero-izquierdo-82403-38011/dp/B0883652ZD/ref=sr_1_1?__mk_es_US=ÅMÅŽÕÑ&dchild=1&keywords=82403-38011&qid=1600201056&sr=8-1', 'https://www.ebay.com/itm/Smoke-Window-Sun-Vent-Visor-Rain-Guards-4P-A046-For-KIA-2000-2005-Optima-Regal/262759208487?fits=Year%3A2003%7CModel%3AOptima%7CMake%3AKia&epid=1049115341&hash=item3d2dab5627:', NULL, NULL, NULL),
(13, 11, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización lámparas', '-Universal Rectangle Chrome Housing / Yellow Glass Lens Fog Light Lamp 5\" x 1.75\"\r\n$29.50+ 5.00+ 10.00= $44.50\r\n-Fog Lights Lamps LEFT+RIGHT Fits CHEVROLET ISUZU D-Max Rodeo 2002-2012\r\n$43.09+5.00+ 10.00= $58.09\r\n-Fog Lamps for BMW 3 Series E36 Chrome WorldWide FreeShip US HABM01 XINO US\r\n$85.58+5.00+ 10.00= $100.58', NULL, NULL, '2020-09-15 13:03:57', NULL, NULL, 'https://www.ebay.com/itm/Universal-Rectangle-Chrome-Housing-Yellow-Glass-Lens-Fog-Light-Lamp-5-x-1-75/143348401293?hash=item21603b048d:g:KWkAAOSwqNdeaVdt', 'https://www.ebay.com/itm/Fog-Lights-Lamps-LEFT-RIGHT-Fits-CHEVROLET-ISUZU-D-Max-Rodeo-2002-2012/332230798520?_trkparms=aid%3D111001%26algo%3DREC.SEED%26ao%3D1%26asc%3D225086%26meid%3Df832b5989cf340a49', 'https://www.ebay.com/itm/Fog-Lamps-for-BMW-3-Series-E36-Chrome-WorldWide-FreeShip-US-HABM01-XINO-US/202852667672?hash=item2f3af61118:g:wDoAAOSwvMBd8rDL', NULL, NULL),
(14, 13, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Motosierra', 'Cliente desea cotizar motosierra', 'PRIORITY 2', 'OPEN', '2020-09-15 13:21:11', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(15, 14, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización Amazon', '-Kaisi - Alfombrilla magnética de silicona para soldadura y soldadura de pistolas, resistente al calor, 4 tamaños\r\n\r\n$24.99+.  11.00  +5.00    =. $40.99\r\n\r\n-AUKEY Hub USB C Hub 12 en 1 Tipo C Hub, gris\r\n$ 279.96+.   9.25   + 28.00     = $317.21', NULL, NULL, '2020-09-15 15:09:22', NULL, NULL, 'https://www.amazon.com/-/es/gp/product/B07MQ823BQ/ref=ppx_yo_dt_b_asin_title_o02_s01?ie=UTF8&th=1', 'https://www.amazon.com/-/es/AUKEY-Adapter-Ethernet-MacBookPro-Thunderbolt/dp/B0841T9KC9/ref=psdc_281413_t3_B07M8HLGBF?th=1', NULL, NULL, NULL),
(16, 15, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de artículos de Amazon', '- 2 pegatinas para volante con emblema para F150 F250 F350\r\n$14.49\r\n- Duck and Buck Commander Buck Commander 3d Performance Cap, negro\r\n$26.90\r\n- Sudadera camuflada con capucha de Legendary Whitetails para hombre\r\n$51.29', 'PRIORITY 1', 'OPEN', '2020-09-15 16:00:14', NULL, 1, 'https://www.amazon.com/-/es/gp/product/B087R1TVD7/ref=ox_sc_act_title_1?smid=A26QK38V3T0K5Y&psc=1', 'https://www.amazon.com/-/es/gp/product/B081PFSY1H/ref=ox_sc_act_title_2?smid=ATVPDKIKX0DER&psc=1', 'https://www.amazon.com/-/es/gp/product/B014505U78/ref=ox_sc_act_title_3?smid=ATVPDKIKX0DER&psc=1', NULL, NULL),
(17, 16, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de Chaleco ajustable con peso', '-Cotizacion de Chaleco ajustable con peso 15x12x6    8V/3R\r\n79.95 + 13.50 + 10.00  = 103.45$\r\n- Adjustable Weighted Vest 22lb-132lb Weight \r\n22.90 + 11.00 + 20.00 = 53.90$\r\n- Unbrokenshop.com WOD Chaleco de peso Chaleco Colette (negro)\r\n92.99 + 11.00 + 10.00 = 113.99$', 'PRIORITY 2', 'OPEN', '2020-09-15 16:05:39', NULL, 1, 'https://www.ebay.com/itm/Tactical-Fast-Training-Weight-Vest-Modular-Crossfit-Adjustable-Plate-Carrier/333611016225?hash=item4dacc42021%3Ag%3AFCUAAOSwyEJe1Mmt&LH_ItemCondition=3&LH_BIN=1', 'https://www.ebay.com/itm/Adjustable-Weighted-Vest-22lb-132lb-Weight-Plate-Fitness-Exercise-Training-Empty/143615430653?hash=item2170258ffd:g:r8oAAOSwc6JeQPut&var=442574471912', 'https://www.amazon.com/-/es/Unbrokenshop-com-Chaleco-peso-Colette-negro/dp/B07MWFNWLW/ref=sr_1_54?__mk_es_US=ÅMÅŽÕÑ&crid=LMHV4RCNDZKK&dchild=1&keywords=weighted+vest+for+training&qid=1600204595&sprefi', NULL, NULL),
(18, 17, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de motosierra', '38x9x13 32V/12R\r\n139.99 = 250.00$', 'PRIORITY 3', 'ACCEPTED', '2020-09-15 17:15:40', NULL, 1, 'https://www.ebay.com/itm/62cc-Chainsaw-22-Bar-Powered-Engine-2-Cycle-Gasoline-Chain-Saw-Red/133513965735?hash=item1f160d70a7:g:qZ4AAOSwVOBfVxB-', 'https://www.ebay.com/itm/X-BULL-62cc-Chainsaw-20-Bar-Powered-Engine-2-Cycle-Gasoline-Yellow/223702552216?epid=20030652179&hash=item3415b60e98:g:dl4AAOSwyNBeRT6m', NULL, NULL, NULL),
(19, 11, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de luces', '-Pair Rectangular Fog Lights fit 95-98\r\n84.99 + 10.00 + 10.00 = 104.99$\r\n-For Silverado Rectangular Style Replacement Fog Light\r\n32.50 + 5.00 + 10.00 = 47.50$\r\n-UNIVERSAL YELLOW LED SIDE MARKER LIGHTS \r\n16.95 + 5.00 + 10.00 = 34.95$\r\n-Universal Smoke Lens Side marker LED TUBE FENDER\r\n37.99 + 5.00 + 10.00 = 52.99$\r\n-LED Side Fender Marker Turn Light Signal blue Universal\r\n22.00 + 5.00 + 10.00 = 37.00$.                    https://es.aliexpress.com/item/4000090652315.html?spm=a2g0o.productlist.0.0.51b2658cU0tY2V&algo_pvid=9cb59864-8160-4576-a624-f4ca8df9e2dc&algo_expid=9cb59864-8160-4576-a624-f4ca8df9e2dc-1&btsid=0bb0622916004451849175932e50f2&ws_ab_test=searchweb0_0,searchweb201602_,searchweb201603_', 'PRIORITY 1', 'ACCEPTED', '2020-09-16 09:43:29', NULL, 1, 'https://www.ebay.com/itm/Pair-Rectangular-Fog-Lights-fit-95-98-Explorer-97-98-Mountaineer-Front-Lamps-Set/303401505818', 'https://www.ebay.com/itm/For-Silverado-Rectangular-Style-Replacement-Fog-Light-Smoke-Lens-Chrome-Housing/254311297361?hash=item3b36227151:g:UOQAAOSwKDZfLfzj', 'https://www.ebay.com/itm/UNIVERSAL-YELLOW-LED-SIDE-MARKER-LIGHTS-FOR-200SX-240SX-ALTIMA-FRONTIER-MAXIMA/171975224043?hash=item280a85aaeb:g:3dcAAOSwXJFathQQ', 'https://www.ebay.com/itm/Universal-Smoke-Lens-Side-marker-LED-TUBE-FENDER-VENT-TURN-SIGNAL-LIGHT-Dual/312416708309?hash=item48bd7ca6d5:g:byoAAOSwZbVcMZ4U', 'https://www.ebay.com/itm/LED-Side-Fender-Marker-Turn-Light-Signal-blue-Universal/293669883761'),
(20, 22, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de Auto Hub Lock Connector y solenoide de purga de control de emisiones evaporativas', 'Auto Hub Lock Connector \r\n37.81 + 3.50 + 2.00 = 43.31$\r\nsolenoide de purga de control de emisiones evaporativas\r\n35.27 + 3.50 + 2.00 = 39.77$', 'PRIORITY 2', 'OPEN', '2020-09-16 11:10:27', NULL, 1, 'https://www.ebay.com/itm/OEM-NEW-4x4-Auto-Hub-Lock-Connector-Vacuum-Line-Fitting-Tee-Tube-7L3Z-7A785-A/191706148652?epid=1911188288&hash=item2ca293af2c:g:iuoAAOSwfpBaY5MM', 'https://www.amazon.com/-/es/600-400-solenoide-control-emisiones-evaporativas/dp/B004SR7JVO/ref=sr_1_2?__mk_es_US=ÅMÅŽÕÑ&dchild=1&keywords=6L3Z-9H465-B&qid=1600222171&sr=8-2', NULL, NULL, NULL),
(21, 23, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de TAILGATE WINDOW TRACKS CHANNELS GUIDES BRACKETS y TAILGATE WINDOW TRACKS CHANNELS GUIDES BRACKETS', '- TAILGATE WINDOW TRACKS CHANNELS GUIDES BRACKETS\r\n 69.95 + 3.50 + 20.00 = 93.45$\r\n - TAILGATE WINDOW TRACKS CHANNELS GUIDES BRACKETS\r\n64.95 + 3.50 + 20.00 = 88.45$', 'PRIORITY 2', 'OPEN', '2020-09-16 12:37:27', NULL, 1, 'https://www.ebay.com/itm/90-95-Toyota-4Runner-Surf-TAILGATE-WINDOW-TRACKS-CHANNELS-GUIDES-BRACKETS-300/383677674921?fits=Year%3A1995%7CModel%3A4Runner&hash=item5954f8b5a9:g:DcwAAOSwzmdfNxvp', 'https://www.ebay.com/itm/90-95-Toyota-4Runner-Su-TAILGATE-WINDOW-TRACKS-CHANNELS-GUIDES-BRACKETS-650/174356295177?fits=Year%3A1995%7CModel%3A4Runner&hash=item289871ee09:g:W8AAAOSwBLNfFhDS', NULL, NULL, NULL),
(22, 25, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de silenciador de auto - mofle', '35 x 16 x 8 pulgadas\r\n\r\n15 LB\r\n\r\nAereo: 62.25\r\n\r\nTotal 262.24', 'PRIORITY 3', 'OPEN', '2020-09-16 14:57:00', NULL, 1, 'https://www.ebay.com/itm/MBRP-M1004A-Quiet-Tone-Diesel-muffler-4-Inlet-Outlet-Body-L-24-Overall-L-30/132298912075?epid=2298751471&hash=item1ecda1314b%3Ag%3AcfAAAOSwmClZlfCi&LH_BIN=1', NULL, NULL, NULL, NULL),
(23, 37, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización de Carburador  jeep Wrangler 1988', 'Carburador  jeep Wrangler 1988\r\nMarítimo:\r\n109.99 + 19.00 + 75.00 = 203.99$\r\nAéreo:\r\n109.99 +  31.00 + 75.00 = 215.99$\r\n\r\nMarítimo:\r\n 203.99$\r\nAéreo:\r\n215.99$', 'PRIORITY 3', 'OPEN', '2020-09-16 16:53:42', NULL, 1, 'https://www.ebay.com/itm/Carburetor-Fits-Jeep-CJ-Wagoneer-Grand-Wagoneer-SJ-1981Stepper-Motor-33000486/264818936183?hash=item3da8704977:g:EgoAAOSwbb5ePmFD', NULL, NULL, NULL, NULL),
(24, 38, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de ZEAK 10000 libras de potencia eléctrica avanzada, 12 V CC, resistente al agua, para Jeep Truck Off Road Auto Cable de Alambre Galvanizado', 'Cotización de ZEAK 10000 libras de potencia eléctrica avanzada, 12 V CC, resistente al agua, para Jeep Truck Off Road Auto Cable de Alambre Galvanizado\r\nAéreo: \r\n238.49 + 210.00 + 20.00 = 468.49$\r\n\r\nMarítimo:\r\n238.49 + 138.50 + 20.00 = 396.99$\r\n\r\nAéreo: \r\n468.49$\r\n\r\nMarítimo:\r\n 396.99$', 'PRIORITY 2', 'OPEN', '2020-09-16 17:10:58', NULL, 1, 'https://www.amazon.com/-/es/potencia-el%25C3%25A9ctrica-avanzada-resistente-Galvanizado/dp/B07MXDWZ51', NULL, NULL, NULL, NULL),
(25, 39, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizar computadora de Hyundai Accent', 'VIN KMHCT41CBCU041362', 'PRIORITY 2', 'OPEN', '2020-09-16 17:40:38', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(26, 40, 'INBOUND', 'WHATSAPP', NULL, 'cotización  cover Xiaomi Redmi 9', '-For Xiaomi Redmi 9A 10X Note9 Mi 10 Lite Embossed Flip Wallet Leather Case Cover\r\n$9.98+3.50+2.00=  $15.48\r\n-For Xiaomi Redmi Note 9 8 Pro 8T 9A 9C 9S Mi 10 Leather Flip Hybrid Case Cover\r\n$9.98+3.50+2.00=  $15.48\r\n-For Xiaomi Redmi 9 9A 9C Shockproof Slim Magnetic Ring Holder TPU+PC Case Cover\r\n$8.69+3.50+2.00= $14.19\r\n-For Xiaomi Redmi 9A 9C 9 Slim Hybrid Glass Lens Shockproof Leather Case Cover\r\n$8.79+3.50+2.00= $14.29', NULL, NULL, '2020-09-17 10:33:02', NULL, 2, 'https://www.ebay.com/itm/For-Xiaomi-Redmi-9A-10X-Note9-Mi-10-Lite-Embossed-Flip-Wallet-Leather-Case-Cover/363108794015?hash=item548af87e9f%3Ag%3AKogAAOSwmRZfYX0f&LH_BIN=1', 'https://www.ebay.com/itm/For-Xiaomi-Redmi-Note-9-8-Pro-8T-9A-9C-9S-Mi-10-Leather-Flip-Hybrid-Case-Cover/154076783019?hash=item23dfb121ab%3Ag%3A234AAOSwmKdfQM-C&LH_BIN=1', 'https://www.ebay.com/itm/For-Xiaomi-Redmi-9-9A-9C-Shockproof-Slim-Magnetic-Ring-Holder-TPU-PC-Case-Cover/254718835511?hash=item3b4e6cfb37%3Ag%3AOegAAOSwVOBfX5QP&LH_BIN=1', 'https://www.ebay.com/itm/For-Xiaomi-Redmi-9A-9C-9-Slim-Hybrid-Glass-Lens-Shockproof-Leather-Case-Cover/254712358082?hash=item3b4e0a24c2%3Ag%3AQj4AAOSwFzRfKNRu&LH_BIN=1', NULL),
(27, 41, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de bomba de aceite', 'Bomba de Aceite con filtro  14x6x4  4V/6R\r\n44.71 + 15.00 + 35.00 = 94.71$\r\nBomba de aceite \r\n36.15 + 10.00 + 20.00 = 66.15$\r\n\r\nBomba de Aceite con filtro  \r\n 94.71$\r\nBomba de aceite \r\n 66.15$', 'PRIORITY 2', 'OPEN', '2020-09-17 10:37:00', NULL, 1, 'https://www.rockauto.com/en/parts/ultra-power,M167HVS,oil+pump,5564', 'https://www.rockauto.com/en/parts/ultra-power,M81A,oil+pump,5564', NULL, NULL, NULL),
(28, 42, 'INBOUND', 'WHATSAPP', NULL, 'cotización adaptador cdmi audífonos', '-Adaptador Mini DP a HDMI, Gris (Space Grey) Paquete de 1\r\n8.49+2.00=. $ 10.49\r\n-Auriculares inalámbricos bluetooth BlitzWolf AIRAUX AA-NH1, banda para el cuello, Auriculares deportivos resistentes al agua, estéreo HiFi, controlador dinámico, auriculares TWS\r\n$11.47+2.00= $13.47', NULL, NULL, '2020-09-17 10:50:32', NULL, 2, 'https://www.amazon.com/-/es/gp/product/B01N6M2VN4/ref=ox_sc_act_title_1?smid=A2E1FT04RF13XV&psc=1', 'https://es.aliexpress.com/item/4000751917541.html?spm=a2g0o.productlist.0.0.23f525f5mdvTJp&algo_pvid=ac9842b8-6d59-49b0-8c92-4cc928518bbd&algo_expid=ac9842b8-6d59-49b0-8c92-4cc928518bbd-15&btsid=0bb06', NULL, NULL, NULL),
(29, 43, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de iPad Air , iPad  2019 y Apple Pencil', '-iPad Air 64GB - 2019\r\n507.50$\r\n-iPad 2019 - 32GB\r\n471.23$\r\n-iPad 2019 - 128GB\r\n494.25$\r\n-Apple Pencil \r\n121.50$', 'PRIORITY 3', 'OPEN', '2020-09-17 12:09:29', NULL, 1, 'https://www.ebay.com/itm/Apple-iPad-Air-3rd-Gen-64-GB-10-5-in-Wi-Fi-Silver-Excellent-Condition/392943353981?hash=item5b7d3fc07d%3Ag%3ADG4AAOSwWttfYX-o&LH_BIN=1', 'https://www.ebay.com/itm/81132-Apple-iPad-10-2-7th-Gen-32GB-WiFi-with-Apple-Smart-Keyboard-MINT/193660334352?epid=4034210179&hash=item2d170e3110%3Ag%3A4hgAAOSwe6dfXbga&LH_BIN=1', 'https://www.ebay.com/itm/Apple-iPad-10-2-7th-Gen-128GB-Gray-WiFi-2019-Model-Mint-Condition-Used/203108155423?epid=3034222256&hash=item2f4a30801f%3Ag%3AfQIAAOSwumNfYjya&LH_BIN=1', 'https://www.ebay.com/itm/Genuine-Apple-Pencil-MK0C2AM-A-1st-Generation-A1603-for-iPad-Pro-iPad-6th-Gen/254720919515?epid=9030514629&hash=item3b4e8cc7db%3Ag%3AnDIAAOSws%7EpfYnZi&LH_BIN=1', NULL),
(30, 53, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Vidrio de Sunroof Hollandia 700', 'Precio: 289.00\r\nShipping 30.00\r\nSablazo 150.00\r\nPeso: 22 libras\r\nLargos 31,33,35, 39\r\nMedidas 36 x 21 x 4 pulgadas.       AEREO. 319.00+71.50+150.00= $540.50          MARITIMO 319.00+44.00+150.00=$513.00', 'PRIORITY 1', 'OPEN', '2020-09-17 14:04:55', NULL, 2, 'http://www.tgautomotive.com/category_s/121.htm', NULL, NULL, NULL, NULL),
(31, 54, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización gafas', '29.98+2.00 = $31.98', NULL, NULL, '2020-09-18 12:44:03', NULL, 2, 'https://www.shein.com/Men-Acrylic-Frame-Polarized-Sunglasses-p-1449227-cat-2137.html?scici=Search~SuggestionSearch~1~gafas%20de%20sol~SPcSearchWordsSuggest~0~0', 'https://www.shein.com/Men-Top-Bar-Sunglasses-p-1161782-cat-2137.html?scici=Search~SuggestionSearch~1~gafas%20de%20sol~SPcSearchWordsSuggest~0~0', NULL, NULL, NULL),
(32, 25, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Espaciadores de toyota', '9x9x7. 5V      8R.     30.00 sabalzo \r\nindividual-1x Wheel Adapters 5x150 TO 6x5.5 - 12x1.50 Studs/ 2\" Thick /110mm CB/106mm WB\r\n     $57.99 +13.75  +. 20.00    = $91.74\r\n\r\n-2 Wheel Adapters 5x150 To 6x5.5| Fits 6 Lug Toyota Wheels on 5 Lug Tundra\r\n$116.18+.   23.75  +. 30.00    = $169.93', 'PRIORITY 2', 'OPEN', '2020-09-18 12:47:44', NULL, 2, 'https://www.ebay.com/itm/1x-Wheel-Adapters-5x150-TO-6x5-5-12x1-50-Studs-2-Thick-110mm-CB-106mm-WB/113778628632?hash=item1a7dbc1818:g:2l4AAOSwef9c~udD', 'https://www.ebay.com/itm/323414519530?ul_noapp=true', NULL, NULL, NULL),
(33, 56, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de escaner de autos', 'Escaner de autos       11x9x4  3V/3R\r\nPrecio.   Flete.   Aduana.\r\n168.88 + 7.50 + 10.00 = 186.38$', 'PRIORITY 2', 'OPEN', '2020-09-18 14:28:32', NULL, 1, 'https://www.amazon.com/-/es/transmisi%25C3%25B3n-herramienta-diagn%25C3%25B3stico-actualizaciones-actualizada/dp/B07RLF8FBC', NULL, NULL, NULL, NULL),
(34, 7, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización cable fibra óptica', 'Datos de origen			\r\nFlete	83	CBM	83\r\nAduana de exportacion	40	BL	40\r\nDocumentacion	20	BL	20\r\nGate in	64	BL	64\r\n			207\r\n\r\nDatos de destino			\r\nManejo	95	BL	95\r\nwarehouse	45	BL	45\r\nLCL de desconsolidacion	35	CBM	50\r\nAgency fee	3	BL	3\r\nRecovery fee	30	BL	30\r\nCollection fee	25	BL	25\r\n			248\r\n\r\n	           1 hebra	                                             2 hebras\r\nRegular	1002.75                                            	1038.79\r\nAlta	        1106.68	                                                1146.65', NULL, NULL, '2020-09-18 16:44:41', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(35, 7, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización cajillas  fibra', 'Precio 162.60 (20 unidades)\r\nAduana 40.19\r\npickup 15.00   \r\nmanejo   50.00\r\nTOTAL  $267.79', NULL, NULL, '2020-09-18 16:54:25', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(36, 6, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización audífonos', '-Auricular para juegos con sonido envolvente 3D, auriculares para PC PS4 con micrófono transparente, Azul Normal\r\nAZUL.      ROJO \r\n     52.98 + 18.30 = $71.28', NULL, NULL, '2020-09-21 10:07:01', NULL, 2, 'https://www.amazon.com/-/es/Auricular-envolvente-auriculares-micr%25C3%25B3fono-transparente/dp/B081DM6GQD/ref=sr_1_1?__mk_es_US=%25C3%2585M%25C3%2585%25C5%25BD%25C3%2595%25C3%2591&crid=3C3RSMHISS73V&', NULL, NULL, NULL, NULL),
(37, 43, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización bomba de agua', 'gates 44004\r\n\r\ncoto +flete. +manejo \r\n42.57+.        +.       PENDIENTE SOLO FLETE', NULL, NULL, '2020-09-21 11:04:20', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(38, 57, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de Lash Lift Kit Eyelash Perm Ki', 'Lash Lift Kit Eyelash Perm Ki \r\n21.39 + 3.50 + 5.00 = 29.89$\r\n Lash Lift Kit Eyelash Perm Ki  \r\n 29.89$\r\n ( Precio Unitario )\r\nALIEXRESS \r\nKit de elevador de pestañas profesional, envío directo, kit de pestañas elevador de pestañas, para permanente de pestañas, elevador de pestañas, suero de crecimiento de pestañas, elevador de pestañas herramienta de levantamiento\r\n                     $18.00+3.50=$ 21.50', 'PRIORITY 1', 'OPEN', '2020-09-21 11:24:48', NULL, 1, 'https://www.amazon.com/Eyelash-Extension-Suitable-Professional-eyelash/dp/B07CVCW8ZZ?language=en_US', 'https://es.aliexpress.com/item/32854113621.html?spm=a2g0o.productlist.0.0.334d5339GmTIEN&algo_pvid=d796a391-09ce-4bd8-940b-4f3581851653&algo_expid=d796a391-09ce-4bd8-940b-4f3581851653-0&btsid=0bb0623b', NULL, NULL, NULL),
(39, 58, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de DJI Osmo External Battery Extender', 'DJI Osmo External Battery Extender\r\n48.51$', 'PRIORITY 3', 'OPEN', '2020-09-21 12:00:23', NULL, 1, 'https://www.dronenerds.com/products/gimbals/osmo/parts-accessories/dji-osmo-external-battery-extender-osmoextbatt-dji.html', NULL, NULL, NULL, NULL),
(40, 33, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de fletes de piezas de auto', 'Estimado de flete Marítimo \r\nCaja A:  23V/35R   $65.90\r\n\r\nCaja B:   51V/62R   $119..26\r\n\r\nCaja C:  51V/30R    $71.26', 'PRIORITY 3', 'OPEN', '2020-09-21 15:07:57', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(41, 59, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización palanca cambio amaron', 'Palanca de cambios de Amarok\r\n\r\nPrecio 284.46\r\nFlete 91.56\r\nAduanas 46.23\r\nManejo 50.00\r\n\r\nTotal 472.25.    PEDIDA DE MEXICO', NULL, NULL, '2020-09-21 15:58:37', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(42, 21, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización partes np300 2017', '-', NULL, NULL, '2020-09-21 15:58:46', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(43, 60, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de bosina de Huawei p30 pro', 'bosina abajo de Huawei p30 pro\r\n23.49$\r\nbosina arriba  de Huawei p30 pro\r\n21.49$\r\nCOMPRAR.     Módulo receptor auricular para Huawei P30 Pro\r\n$12.68.x3= $38.04\r\ncantidad 3      $14.43', 'PRIORITY 2', 'OPEN', '2020-09-21 16:11:52', NULL, 1, 'https://www.ebay.com/itm/Replacement-Loudspeaker-Module-Flex-Fits-For-Huawei-P30-Pro/164201527596', 'https://www.ebay.com/itm/Replacement-Ear-Speaker-Flex-Module-Fits-For-Huawei-P30-Pro/164013069050', 'https://es.aliexpress.com/item/4000120315514.html?srcSns=sns_Copy&spreadType=socialShare&bizType=ProductDetail&tt=MG&aff_platform=default&sk=_mrQXj9v&mergeHashcode=69666581249&description=US+%242.85++', NULL, NULL),
(44, 47, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización amazon', NULL, NULL, NULL, '2020-09-21 17:28:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 61, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de lente de cámara y  tarjeta de video', '- Nikon AF-S NIKKOR 85mm f/1.8G Lens\r\n  Precio    Flete    Aduana\r\n  426.95 + 3.50 + 15.00 =  $445.45\r\n\r\n- HD 6970M 2GB DDR5 VGA Video Card For iMac27\r\n  219.99 + 3.50 + 5.00  = $228.49', 'PRIORITY 2', 'OPEN', '2020-09-22 11:07:30', NULL, 1, 'https://www.bhphotovideo.com/spanish/c/product/838798-REG/Nikon_2201_AF_S_NIKKOR_85mm_f_1_8G.html', 'https://www.ebay.com/itm/HD-6970M-2GB-DDR5-VGA-Video-Card-For-iMac27-A1312-mid-2011-AMD-Radeon-GPU-USA/402338157642?_trkparms=ispr%253D1&hash=item5dad39144a:g:RYsAAOSwcdtdwnv1&enc=AQAFAAACcBaobrjLl8Xo', NULL, NULL, NULL),
(46, 62, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización apremios perro', 'Cosequin® Nutramax Professional Joint Health Senior Dog Supplement - Soft Chew\r\n(x2)\r\n38.62+8.75+2.00= $49.37', NULL, NULL, '2020-09-22 11:13:09', NULL, 2, 'https://www.petsmart.com/dog/dental-care-and-wellness/vitamins-and-supplements/cosequin-nutramax-professional-joint-health-senior-dog-supplement---soft-chew-5299361.html?hideBreadCrumbs=true', NULL, NULL, NULL, NULL),
(47, 63, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Inyector remafacturado y nuevo', '- Remafacturado\r\n299.99 + 3.50 + 70.00 = $373.00\r\n- Nuevo \r\n724.72 + 3.50 + 50.00 = $778.22\r\n- set de 6 Remafacturado\r\n2654.40 + 37.16 + 120 =  2811.56$', 'PRIORITY 3', 'OPEN', '2020-09-22 11:24:53', NULL, 1, 'https://www.ebay.com/itm/2004-09-DODGE-RAM-2500-3500-5-9L-DIESEL-FUEL-INJECTOR-OEM-R5135790AF/292764900725?epid=179317333&hash=item442a25dd75%3Ag%3APugAAOSwJTNbvXOD&LH_BIN=1', 'https://www.ebay.com/itm/Genuine-Mopar-Fuel-Injector-R5135790AF/143526965799', 'https://www.ebay.com/itm/06-10-Dodge-Ram-2500-3500-New-Reman-Fuel-Injectors-5-9L-Diesel-Set-of-6-Mopar/351814933505?fits=Year%3A2008%7CModel%3ARam+2500%7CMake%3ADodge&epid=252754254&hash=item51e9cddc0', NULL, NULL),
(48, 56, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion Shankly - Juego de 18 poleas de alternativa, herramienta de polea', 'Shankly - Juego de 18 poleas de alternativa, herramienta de polea\r\n29.91 + 2.00 + 10.81 = $42.72', 'PRIORITY 3', 'OPEN', '2020-09-22 14:54:32', NULL, 1, 'https://www.amazon.com/-/es/Shankly-Juego-poleas-alternativa-herramienta/dp/B0714KCJH6', NULL, NULL, NULL, NULL),
(49, 64, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización partes w250 dodge', '-PARKLIGHT-LEFT HAND CLEAR 55-2616\r\n PARKLIGHT-RIGHT HAND CLEAR 55-2617\r\n$57.90+.  12.50     +20.00=$90.40\r\n-CAB ROOF 5 LIGHT KIT AMBER CHROME.  38-1075\r\n$85.70+.  3.50    +20.00=$69.20\r\n-MARKER LIGHT AMBER 56-6896\r\nMOUNTING PLATE-CHROME 56-6909\r\n$30.90+. 5.00      +20.00=$55.90\r\n-GRILLE SHELL-REPRO CHROME.  55-2539\r\n$173.70+.   122    +75.00=$370.70\r\nINSERT (x4)\r\n$143.55+.   +=$\r\n-TAIL LIGHT-LEFT HAND 55-2644.      TAIL LIGHT-RIGHT HAND. 55-2645\r\n$95.65+.     +20.00= \r\nAMAZON  lamparas \r\nhttps://www.amazon.com/-/es/traseros-conductor-pasajero-Ramcharger-55054795/dp/B008G3CKTW/ref=sr_1_7?__mk_es_US=ÅMÅŽÕÑ&dchild=1&keywords=1992+dodge+w250+tail+lamp&qid=1600814551&replacementKeywords=tail+lamp&s=automotive&sr=1-7&vehicle=1992-40-2766------------&vehicleName=1992+Dodge+W250\r\n$ 59.49 +. 35.68    +20.00= $ 115.17', NULL, NULL, '2020-09-22 15:27:12', NULL, 2, 'https://www.lmctruck.com/1972-93-dodge/parklight/dc-1991-93-parklight', 'https://www.lmctruck.com/1972-93-dodge/cab-roof/dc-cab-roof-light-kits', 'https://www.lmctruck.com/1972-93-dodge/fender-marker/dc-1989-93-dually-fender-marker-lights', 'https://www.lmctruck.com/1972-93-dodge/stock/dc-1991-93-repro-grilles', 'https://www.lmctruck.com/1972-93-dodge/tail-light/dc-1988-93-tail-light'),
(50, 7, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de luces White 6000K High Power H1 388W 38800LM CREE LED Headlight Kit Hi/Low Beam Bulbs', 'White 6000K High Power H1 388W 38800LM CREE LED Headlight Kit Hi/Low Beam Bulbs\r\n19.79 + 3.50 + 5.00 = 28.29$', 'PRIORITY 3', 'OPEN', '2020-09-23 10:29:31', NULL, 1, 'https://www.ebay.com/itm/White-6000K-High-Power-H1-388W-38800LM-CREE-LED-Headlight-Kit-Hi-Low-Beam-Bulbs/142772334855?_trkparms=ispr%253D1&hash=item213de4f107:g:YBwAAOSwVWpa2Wad&amdata=enc%253AAQAFAAA', NULL, NULL, NULL, NULL),
(51, 48, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Yakima bike rack for car hitch heavy duty with Locks - 2 Bikes', 'Yakima bike rack for car hitch heavy duty with Locks - 2 Bikes', NULL, NULL, '2020-09-23 10:40:00', NULL, 2, 'https://www.ebay.com/itm/274504583705', NULL, NULL, NULL, NULL),
(52, 71, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de disco de frenos y visores', '- Disco de Frenos Frontales Brembo\r\n Aéreo: 119.38 + 92.33 + 5.00 = 216.71$\r\nMarítimo: 119.38 + 56.55 + 5.00 = 180.93$\r\n- Visores \r\n Aéreo: 59.69 + 32.33 + 5.00 = 97.02$\r\n\r\n- Disco de Frenos Frontales Brembo\r\n Aéreo:  216.71$\r\nMarítimo: 180.93$\r\n- Visores \r\n Aéreo: 97.02$', 'PRIORITY 2', 'OPEN', '2020-09-23 12:02:52', NULL, 1, 'https://www.rockauto.com/en/parts/brembo,09722611,rotor,1896', 'https://www.rockauto.com/en/parts/avs,194751,side+window+vent,1124', NULL, NULL, NULL),
(53, 72, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de SL Turbo Sound Exhaust', 'SL Turbo Sound Exhaust\r\n13.45$', 'PRIORITY 2', 'OPEN', '2020-09-23 16:55:00', NULL, 1, 'https://www.ebay.com/itm/264709961459', NULL, NULL, NULL, NULL),
(54, 73, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de cable Mini DisplayPort Thunderbolt Male To DVI-D HDMI VGA Adapter Converter 4K 1080P', 'Mini DisplayPort Thunderbolt Male To DVI-D HDMI VGA Adapter Converter 4K 1080P\r\n17.09$', 'PRIORITY 2', 'OPEN', '2020-09-23 17:02:24', NULL, 1, 'https://www.ebay.com/itm/Mini-DisplayPort-Thunderbolt-Male-To-DVI-D-HDMI-VGA-Adapter-Converter-4K-1080P/203077333358?_trkparms=ispr%3D1&hash=item2f485a316e:g:4TgAAOSwE9xfNwKB&amdata=enc%3AAQAFAAACcBao', NULL, NULL, NULL, NULL),
(55, 39, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Bujes traseros de la barra estabilizadora', 'VIN HZJ80L-GNPNSW\r\nhttps://partsouq.com/en/catalog/genuine/vehicle?c=Toyota&ssd=%24%2AKwHP--rljrOPyZK-varTkpeDo6S6y8TJyNrE9obej9jH3qHbiIjV38bJh4OKkp3k0ZSen9nA3d7MwJWfgs3e19rflY_bnoqUrb2pu7De19mGx9XfxtvYtaaxwZTmm7qyq7Suq9nVhIjAnt7B2pOJl5WIipSblZ_Yx9zJytkAAAAAaz512g%24&vid=0&cid=2&q=', 'PRIORITY 2', 'OPEN', '2020-09-24 17:29:13', NULL, 1, 'https://partsouq.com/en/catalog/genuine/vehicle?c=Toyota&ssd=%24%2AKwHP--rljrOPyZK-varTkpeDo6S6y8TJyNrE9obej9jH3qHbiIjV38bJh4OKkp3k0ZSen9nA3d7MwJWfgs3e19rflY_bnoqUrb2pu7De19mGx9XfxtvYtaaxwZTmm7qyq7Suq', NULL, NULL, NULL, NULL),
(56, 77, 'INBOUND', 'WHATSAPP', 'OTHER', 'Cotizacion de case de Huawei mate 20 pro', 'Huawei mate 20 pro\r\n11.42$\r\n12.07$', 'PRIORITY 2', 'OPEN', '2020-09-24 17:55:20', NULL, 1, 'https://es.aliexpress.com/item/4000852189337.html?spm=a2g0o.cart.0.0.9c553c006VDp6b&mp=1', 'https://es.aliexpress.com/item/4000157176442.html?spm=a2g0o.cart.0.0.9c553c006VDp6b&mp=1', NULL, NULL, NULL),
(57, 39, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de bujes', 'Front or Rear Sway Bar Link Bush + Pin Kit suits Landcruiser\r\n25.96 + 10.00 + 20.00 = $55.96\r\nFor Landcruiser HZJ80 HDJ80 Series Suspension \r\n28.11 + 5.00 + 15.00 = $48.11', 'PRIORITY 2', 'OPEN', '2020-09-24 18:00:53', NULL, 1, 'https://www.ebay.com/itm/Front-or-Rear-Sway-Bar-Link-Bush-Pin-Kit-suits-Landcruiser-HDJ80-HZJ80-FJ80/401364942825?_trkparms=ispr%3D1&hash=item5d7336ffe9:g:evUAAOSwxuBfFXD2&enc=AQAFAAACcBaobrjLl8XobRIi', NULL, NULL, NULL, NULL),
(58, 78, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de 2020 Pro team Jumbo visma cycling jersey set mens bicycle', '2020 Pro team Jumbo visma cycling jersey set mens bicycle\r\n19.79 + 5.00 + 2.00 = $26.79', 'PRIORITY 2', 'OPEN', '2020-09-25 10:06:29', NULL, 1, 'https://es.aliexpress.com/item/32986000569.html?spm=a2g0o.cart.0.0.5c863c003FOIME&mp=1', NULL, NULL, NULL, NULL),
(59, 62, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización teclado aliexpress', '-Teclado inalámbrico Bluetooth, juego de ratón, teclado silencioso, Mini iPad, teclado mágico para teléfono, portátil, tableta, PC, Gamer, teclado.      ROSA.  TECLADO Y MOUSE\r\n$53.16+. 5.00   +2.00=. $60.16', NULL, NULL, '2020-09-25 13:59:40', NULL, 2, 'https://es.aliexpress.com/item/4000862869578.html?spm=a219c.12057483.0.0.9d97622fAD4eRp', NULL, NULL, NULL, NULL),
(60, 80, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización cover', '-Funda abatible con espejo inteligente para Huawei Y9 Prime 2019, Fundas para Huawei Y5 Y6 Y7 Y9 2018 Y 5 6 7 9 Pro 2019 P, Fundas inteligentes, Fundas\r\n\r\n$8.79+3.50 =$13.00', NULL, NULL, '2020-09-25 14:34:01', NULL, 2, 'https://es.aliexpress.com/item/4000842883578.html?spm=a2g0o.productlist.0.0.72814db9hN8TZc&algo_pvid=2624fb75-cea8-4d11-8ec3-f462df99b81c&algo_expid=2624fb75-cea8-4d11-8ec3-f462df99b81c-8&btsid=0bb062', NULL, NULL, NULL, NULL),
(61, 25, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion MBRP Universal Mufflers', 'MBRP Universal Mufflers\r\n278.79 + 46.50 + 5.00 = $330.29', 'PRIORITY 2', 'OPEN', '2020-09-25 16:47:10', NULL, 1, 'https://realtruck.com/p/mbrp-universal-mufflers/v/dodge/ram-2500/2003/', NULL, NULL, NULL, NULL),
(62, 25, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de turbina de auto', 'Flete: 97.06 aéreo\r\n- For Dodge Ram 2500 03 Recon Certified Automatic Transmission Torque Converter\r\n228.61 + 97.06 + 50.00 = 375.67$\r\n- 545RFE - 45RFE MEDIUM STALL- Dodge Jeep Torque Converter 2.8L 3.7L 4.7L 5.7L 5.9\r\n127.99 +  97.06 + 50.00 = 275.05$\r\n- For Ram 2500 2011-2014 Dacco R36BB Automatic Transmission Torque Converter\r\n311.79 +  97.06 + 50.00 = 458.85$', 'PRIORITY 3', 'OPEN', '2020-09-25 17:37:43', NULL, 1, 'https://www.ebay.com/itm/For-Dodge-Ram-2500-03-Recon-Certified-Automatic-Transmission-Torque-Converter/283744664605?fits=Year%3A2003%7CModel%3ARam+2500%7CEngine+-+Liter_Display%3A5.7L%7CMake%3ADodge&h', 'https://www.ebay.com/itm/545RFE-45RFE-MEDIUM-STALL-Dodge-Jeep-Torque-Converter-2-8L-3-7L-4-7L-5-7L-5-9/254727042527?hash=item3b4eea35df:g:y04AAOSweW5VAdgZ', 'https://www.ebay.com/itm/For-Ram-2500-2011-2014-Dacco-R36BB-Automatic-Transmission-Torque-Converter/283592587866?fits=Year%3A2003%7CModel%3ARam+2500%7CEngine+-+Liter_Display%3A5.7L%7CMake%3ADodge&hash', NULL, NULL),
(63, 56, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de consola de video juegos', 'Retro Game Console\r\n20.09 + 5.00 + 2.00 = $27.09', 'PRIORITY 3', 'OPEN', '2020-09-25 17:46:54', NULL, 1, 'https://hummery.com/products/rtc', NULL, NULL, NULL, NULL),
(64, 47, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización amazon papel', 'RAW, ES Distributions 300 papel de liar orgánico de 1,25 1/4, paquete de 5 = 1500 hojas, color marrón\r\n$ 13.85+  3.50      +1.00= $18.35', NULL, NULL, '2020-09-28 10:14:02', NULL, 2, 'https://www.amazon.com/dp/B0050ECQMQ/ref=cm_sw_r_u_apa_fab_wgmCFbGXN7RNB', NULL, NULL, NULL, NULL),
(65, 3, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Sensor de temperatura', 'Sensor de temperatura\r\nOriginal Toyota \r\n54.00 + 3.50 + 20.00 = $77.50\r\nAcdelco \r\n31.87 + 3.50 + 20.00 = $55.37 \r\nOriginal Toyota \r\n $77.50\r\nAcdelco \r\n $55.37', 'PRIORITY 3', 'OPEN', '2020-09-28 10:19:09', NULL, 1, 'https://www.ebay.com/itm/Genuine-OEM-Toyota-Lexus-coolant-temperature-temp-sensor-sender-89422-35010/263994470180?epid=8017022628&hash=item3d774bef24%3Ag%3ATNQAAOSwvFhbxzQ0&LH_BIN=1&LH_ItemCondition=3', 'https://www.rockauto.com/en/parts/acdelco,D583,temperature+sender+/+sensor,4748', NULL, NULL, NULL),
(66, 7, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotización de Auriculares con cable Greyghost, anti radiación FBI Agent', 'Auriculares con cable Greyghost, anti radiación FBI Agent\r\n11.99 + 3.50 + 2.00 = $17.49', 'PRIORITY 3', 'OPEN', '2020-09-28 10:50:32', NULL, 1, 'https://www.amazon.com/Greyghost-Anti-Radiation-Earphone-Acoustic-Hands-Free/dp/B07F7SW7ZZ/ref=sr_1_1?dchild=1&keywords=B07F7SW7ZZ&qid=1601306377&sr=8-1', NULL, NULL, NULL, NULL),
(67, 67, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización articulo', '-Nuevo reposapiés de baño de aleación de aluminio, reposapiés de ducha montado en la pared, reposapiés, estantería de escalera, reposapiés, herramienta antideslizante para Baño\r\n$19.66+3.50+2.00= $25.16\r\n\r\n-PELAMATIC Orange Peel Pro Black (OPP-001B).     /Negro\r\n  $ 182.42  + 22.00+5.00=. $219.96\r\n\r\n-Pelamatic Orange Peel Professional/ BLANCO\r\n 230.45  + 22.54+5.00=. $257.99', NULL, NULL, '2020-09-28 12:12:05', NULL, 2, 'https://es.aliexpress.com/item/4000945884038.html?spm=a2g0o.productlist.0.0.ddf317ddcPIxxm&algo_pvid=28de3bcc-bec6-4684-9158-ba02cdab0460&algo_expid=28de3bcc-bec6-4684-9158-ba02cdab0460-0&btsid=0bb062', 'https://www.amazon.com/-/es/gp/product/B077B8X7GP/ref=ox_sc_act_image_1?smid=A86M66Z7Z0Z95&psc=1', NULL, NULL, NULL),
(68, 64, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'Cotizacion de Pressure Switch', 'Pressure Switch\r\nOriginal Ford\r\n27.59 + 3.50 + 20 + 20 = $71.09\r\nAftermaket\r\n19.02 + 3.50 + 10 + 20  = $52.52\r\n\r\nOriginal Ford\r\n $71.09\r\nAftermaket\r\n $52.52', 'PRIORITY 1', 'OPEN', '2020-09-28 12:54:47', NULL, 1, 'https://www.ebay.com/itm/FORD-OEM-2018-F-150-A-C-Condenser-Compressor-Lines-Switch-HG1Z19D594A/313207454460?hash=item48ec9e7afc%3Ag%3ANPcAAOSwt0Fd73Lz&LH_ItemCondition=3&LH_BIN=1', 'https://www.rockauto.com/en/parts/uac,SW10101C,refrigerant+pressure+switch,4656', NULL, NULL, NULL),
(69, 43, 'INBOUND', 'WHATSAPP', 'QUOTATION', 'cotización piezas taladro', '-DeWalt FlexTorq DWA2NGFT40IR - Juego de brocas de impacto (40 piezas)\r\n$ 26.74. +.       = $38.74', NULL, NULL, '2020-09-28 14:06:52', NULL, 2, 'https://www.amazon.com/dp/B07CT6NCZM/ref=cm_sw_r_wa_api_fab_ffJCFb358RP99', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customerauto`
--

CREATE TABLE `customerauto` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `VehicleType` varchar(40) DEFAULT NULL,
  `VIN` text DEFAULT NULL,
  `Brand` int(10) UNSIGNED DEFAULT NULL,
  `Model` int(10) UNSIGNED DEFAULT NULL,
  `Year` int(10) UNSIGNED DEFAULT NULL,
  `EngineNo` text DEFAULT NULL,
  `Cylinder` varchar(40) DEFAULT NULL,
  `Liters` text DEFAULT NULL,
  `Transmission` varchar(40) DEFAULT NULL,
  `GEAR` varchar(40) DEFAULT NULL,
  `URL` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customerauto`
--

INSERT INTO `customerauto` (`id`, `Customer`, `VehicleType`, `VIN`, `Brand`, `Model`, `Year`, `EngineNo`, `Cylinder`, `Liters`, `Transmission`, `GEAR`, `URL`) VALUES
(1, 39, 'SEDAN', 'KMHCT41CBCU041362', 2, 2, 2011, 'G4FA', '4 Cylinder', '1.4', 'AUTOMATIC', '4X2', 'https://partsouq.com/en/catalog/genuine/vehicle?c=Hyundai&ssd=%24%2AKwHv28rwvLGJ4pmIlJbcx7ejg4Sa6-Tp6Pr8ybC1v5rl7eqn8tXgtLib6-7r7OG2s68AAAAAKwTTIA%24&vid=811&q=KMHCT41CBCU041362');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customerclass`
--

CREATE TABLE `customerclass` (
  `id` int(10) UNSIGNED NOT NULL,
  `Type` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customerclass`
--

INSERT INTO `customerclass` (`id`, `Type`) VALUES
(1, 'LOYALTY / LEAL'),
(2, 'VIP'),
(3, 'REGULAR'),
(4, 'PROSPECTIVE / POSIBLE'),
(5, 'DEFAULTER / MOROSO'),
(6, 'BLACK LIST / LISTA NEGRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `Title` varchar(40) DEFAULT NULL,
  `Customer` varchar(40) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Type` int(10) UNSIGNED DEFAULT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` int(10) UNSIGNED DEFAULT NULL,
  `Province` int(10) UNSIGNED DEFAULT NULL,
  `Country` int(10) UNSIGNED DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `Title`, `Customer`, `Birthdate`, `Type`, `Phone`, `Email`, `Address`, `City`, `Province`, `Country`, `Status`) VALUES
(1, 'MR.', 'Osam Buchain', NULL, 3, '+50768283645', NULL, 'Bajo Boquete', NULL, NULL, NULL, 'ACTIVE'),
(2, 'SR.', 'Franklin Miranda', NULL, 0, '65428898', NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(3, 'SR.', 'Wilfredo Castillo', NULL, 3, '+50768057363', NULL, 'Boquete', NULL, NULL, NULL, 'ACTIVE'),
(4, 'SR.', 'Juan Landau', NULL, 3, '63835588', NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(5, 'SR.', 'Hansen Guerra', NULL, NULL, '62480852', NULL, 'Boquete', NULL, NULL, NULL, 'ACTIVE'),
(6, 'SR.', 'Angel Arauz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(7, 'SR.', 'Arturo Pinzón', NULL, NULL, '69533676', NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(8, 'SR.', 'Peter Pettersen', NULL, 2, '+50769812849', NULL, 'Boquete', NULL, NULL, 1, 'ACTIVE'),
(9, 'SR.', 'Christopher Fuemtes', NULL, NULL, '63107299', NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(10, 'SR.', 'Chistian Gebara', NULL, 3, '69382782', NULL, 'Boquete', NULL, NULL, 1, 'ACTIVE'),
(11, 'SR.', 'Yonny Zapata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(12, 'MR.', 'Josue Morales', NULL, 3, '66416292', NULL, 'El Flor', 1, 1, 1, 'ACTIVE'),
(13, 'MR.', 'Octavio Herrera', NULL, 5, '65263154', NULL, 'Alto Boquete', NULL, 1, 1, 'ACTIVE'),
(14, 'SR.', 'Erasmo Atencio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(15, 'MR.', 'Gerald Landau', NULL, 3, '+50768030830', NULL, 'Boquete', NULL, 1, 1, 'ACTIVE'),
(16, 'MR.', 'Alexis Acosta', NULL, 3, '+50762048644', NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(17, 'MR.', 'Octavio Herrera', NULL, 3, NULL, NULL, 'Boquete', 1, 1, 1, 'ACTIVE'),
(18, 'SR.', 'Richard Hicksted', NULL, 3, NULL, NULL, 'Bajo Boquete', NULL, 1, 1, 'ACTIVE'),
(19, 'SR.', 'Nestor Caballero', NULL, 3, NULL, NULL, 'Boquete', NULL, 1, 1, 'ACTIVE'),
(20, 'SR.', 'Noble Whitley', NULL, 1, NULL, NULL, 'Boquete', NULL, 1, 1, 'ACTIVE'),
(21, 'MR.', 'Erick Quiel', NULL, 3, NULL, NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(22, 'MR.', 'Jacques Slippers', NULL, 3, '+447901391618', NULL, NULL, NULL, NULL, 1, 'ACTIVE'),
(23, 'SR.', 'Craig Hebert', NULL, 3, '+50768691819', NULL, 'Boquete, Bajo Boquete', NULL, 1, 1, 'ACTIVE'),
(24, 'MR.', 'Jake Harris', '1992-03-03', 1, '67388785', NULL, 'Alto Boquete, Boquete', 2, 1, 1, 'ACTIVE'),
(25, 'SR.', 'Froilán Miranda', NULL, 2, NULL, NULL, 'Boquete', NULL, 1, 1, 'ACTIVE'),
(26, 'MR.', 'Yussef Aisprua', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(27, 'MR.', 'Romeido Gonzalez', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(28, 'MR.', 'Cristino Espinosa', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(29, 'MR.', 'Antonio Carracedo', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(30, 'SRA.', 'Katherine Santamaria', NULL, 3, NULL, NULL, 'Boquete', 2, 1, NULL, 'ACTIVE'),
(31, 'SRA.', 'Zahi Rosas', NULL, 3, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(32, 'SRA.', 'Yazu Amendola', NULL, 3, NULL, NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(33, 'SRA.', 'Susam Floeck', NULL, 2, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(34, 'SR.', 'Pedro Garcia', NULL, 3, NULL, NULL, 'Panama', NULL, NULL, 1, 'ACTIVE'),
(35, 'SRA.', 'Lilia Rodriguez', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(36, 'SR.', 'Julian Pitti', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(37, 'MR.', 'Michael Pimentel', NULL, 3, NULL, NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(38, 'SR.', 'Angel Aparicio', NULL, 3, NULL, NULL, NULL, NULL, 1, 1, 'ACTIVE'),
(39, 'MR.', 'Julio Elizondro', NULL, 2, '60336095', NULL, 'ALGARROBOS', 1, 1, 1, 'ACTIVE'),
(40, 'SRA.', 'Carmen Alvarado', NULL, NULL, NULL, NULL, 'Boquete', NULL, NULL, NULL, 'ACTIVE'),
(41, 'SR.', 'Miguel Gonzalez', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(42, 'SR.', 'Alfredo Paulett', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(43, 'MR.', 'Mike Morales', NULL, 3, NULL, NULL, 'Boquete, Los Naranjos', 2, 1, 1, 'ACTIVE'),
(44, 'MR.', 'Marvin Gonzalezz', NULL, 3, NULL, NULL, 'Bajo Boquete', 2, 1, 1, 'ACTIVE'),
(45, 'MR.', 'Kevin Guerra', NULL, 3, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(46, 'MR.', 'Ariel Miranda', NULL, 3, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(47, 'MR.', 'Kenny Guerra', NULL, 3, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(48, 'MR.', 'Eibar Jimenez', NULL, 3, NULL, NULL, 'Palmira', 2, 1, 1, 'ACTIVE'),
(49, 'MR.', 'Kevin Joel Caballero', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(50, 'SR.', 'Arthur Geer', NULL, 3, NULL, NULL, NULL, 2, 1, 1, 'ACTIVE'),
(51, 'MR.', 'Stephano Pitty', NULL, 3, NULL, NULL, NULL, 2, 1, 1, 'ACTIVE'),
(52, 'SR.', 'Barbara Higgins', NULL, 3, NULL, NULL, NULL, 2, 1, 1, 'ACTIVE'),
(53, 'MR.', 'Jose Sabin', NULL, 3, '64900662', NULL, 'Bajo Boquete', 2, 1, 1, 'ACTIVE'),
(54, 'SR.', 'John Paulett', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(55, 'SR.', 'Guillermo Marin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(56, 'MR.', 'Jose Lasso', NULL, 3, NULL, NULL, 'Bajo Boquete', 2, 1, 1, 'ACTIVE'),
(57, 'SRA.', 'Reyna Chaves', NULL, 3, NULL, NULL, 'Volcan', NULL, 1, 1, 'ACTIVE'),
(58, 'MR.', 'Steven Guerra', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(59, 'SR.', 'Modesto Rodriguez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(60, 'MR.', 'Jonathan buga', NULL, 3, NULL, NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(61, 'MR.', 'Breth Basques', NULL, 3, NULL, NULL, 'Bajo Boquete', 2, 1, 1, 'ACTIVE'),
(62, 'SRA.', 'Nicol Urriola', NULL, NULL, NULL, NULL, 'Boquete', NULL, NULL, NULL, 'ACTIVE'),
(63, 'SR.', 'Roberto Gonzalez', NULL, 3, NULL, NULL, 'David', NULL, 1, 1, 'ACTIVE'),
(64, 'SR.', 'Naren Buchain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(65, 'SR.', 'Freddy Gonzalez', NULL, 2, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(66, 'MR.', 'Ezequiel Colón', NULL, 3, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(67, 'SRA.', 'Joleyceen Atencio', NULL, 3, NULL, NULL, 'Panama', NULL, NULL, 1, 'ACTIVE'),
(68, 'MR.', 'Maureens. Gonzalez', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(69, 'SRA.', 'Tabata Landaeta', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(70, 'MR.', 'Nestor Saul Gonzalez', NULL, 3, NULL, NULL, 'Panama', 2, 1, 1, 'ACTIVE'),
(71, 'SR.', 'Rolando Quiroz', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(72, 'MR.', 'Kevin Quiroz', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(73, 'MR.', 'Isaias Sasso', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(74, 'SR.', 'Nigel Batista', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(75, 'SR.', 'Peter Pettersonn', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(76, 'SRA.', 'Cindy Pitti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ACTIVE'),
(77, 'MR.', 'Vlad Olmos', NULL, 3, NULL, NULL, 'Sambony', 2, 1, 1, 'ACTIVE'),
(78, 'MR.', 'Edwin Rosas', NULL, 3, '+50763938769', NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE'),
(79, 'SR.', 'Oscar Guevara', NULL, 3, NULL, NULL, 'Boquete', 2, 1, 1, 'ACTIVE'),
(80, 'SR.', 'Luis Vejerano', NULL, NULL, NULL, NULL, 'Alto Boquete', 2, 1, 1, 'ACTIVE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `databaseauto`
--

CREATE TABLE `databaseauto` (
  `id` int(10) UNSIGNED NOT NULL,
  `Type` varchar(40) DEFAULT NULL,
  `Brand` int(10) UNSIGNED DEFAULT NULL,
  `Model` int(10) UNSIGNED DEFAULT NULL,
  `Year` varchar(40) DEFAULT NULL,
  `System` int(10) UNSIGNED DEFAULT NULL,
  `Part` int(10) UNSIGNED DEFAULT NULL,
  `PartNO` text DEFAULT NULL,
  `Dimensions` varchar(40) DEFAULT NULL,
  `Volume` decimal(10,2) DEFAULT NULL,
  `Weight` decimal(10,2) DEFAULT NULL,
  `AirFreight` decimal(10,2) DEFAULT NULL,
  `OceanFreight` decimal(10,2) DEFAULT NULL,
  `Picture` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `databaseauto`
--

INSERT INTO `databaseauto` (`id`, `Type`, `Brand`, `Model`, `Year`, `System`, `Part`, `PartNO`, `Dimensions`, `Volume`, `Weight`, `AirFreight`, `OceanFreight`, `Picture`) VALUES
(1, 'SEDAN', 1, 1, '2003', 1, 1, NULL, '46.88 x 11.88 x 1.88', '9.00', '3.00', '14.25', '9.00', '1bd341e00e17db1a6.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `Department` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generaldb`
--

CREATE TABLE `generaldb` (
  `id` int(10) UNSIGNED NOT NULL,
  `Description` text DEFAULT NULL,
  `Dimensions` varchar(40) DEFAULT NULL,
  `Vweight` decimal(10,2) DEFAULT NULL,
  `Rweight` decimal(10,2) DEFAULT NULL,
  `Ofreight` decimal(10,2) DEFAULT NULL,
  `Afreight` decimal(10,2) DEFAULT NULL,
  `photo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `generaldb`
--

INSERT INTO `generaldb` (`id`, `Description`, `Dimensions`, `Vweight`, `Rweight`, `Ofreight`, `Afreight`, `photo`) VALUES
(1, 'Winche', '24 x 13.58 x 10', '25.00', '83.60', '138.50', '210.00', '8844586b5cb8e9248.jpeg'),
(2, 'Carburador', '13x12x7', '8.00', '10.00', '19.00', '31.00', '8179af233ab2e5001.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Title` int(10) UNSIGNED DEFAULT NULL,
  `Customer` int(10) UNSIGNED NOT NULL,
  `Phone` int(10) UNSIGNED DEFAULT NULL,
  `Email` int(10) UNSIGNED DEFAULT NULL,
  `Address` int(10) UNSIGNED DEFAULT NULL,
  `City` int(10) UNSIGNED DEFAULT NULL,
  `Country` int(10) UNSIGNED DEFAULT NULL,
  `PaymentStatus` varchar(40) DEFAULT 'UNPAID',
  `AmountDUE` decimal(10,2) DEFAULT NULL,
  `AmountPAID` decimal(10,2) DEFAULT NULL,
  `Balance` decimal(10,2) DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'OPEN',
  `tax` varchar(40) DEFAULT NULL,
  `Total` varchar(40) DEFAULT NULL,
  `usrAdd` varchar(40) DEFAULT NULL,
  `whenAdd` varchar(40) DEFAULT NULL,
  `usrUpdated` varchar(40) DEFAULT NULL,
  `whenUpdated` varchar(40) DEFAULT NULL,
  `type` varchar(40) DEFAULT 'Quote',
  `number` int(11) NOT NULL,
  `related` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`id`, `Date`, `Title`, `Customer`, `Phone`, `Email`, `Address`, `City`, `Country`, `PaymentStatus`, `AmountDUE`, `AmountPAID`, `Balance`, `Status`, `tax`, `Total`, `usrAdd`, `whenAdd`, `usrUpdated`, `whenUpdated`, `type`, `number`, `related`) VALUES
(1, '2020-09-29', 38, 38, 38, 38, 38, 38, 38, 'PAID', '-12.50', '12.50', '0.00', 'CLOSED', NULL, '12.5', 'admin', '9/29/2020 02:40:14 pm', 'admin', '9/29/2020 03:14:19 pm', 'Invoice', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `product` int(10) UNSIGNED DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL,
  `itemSale` int(10) UNSIGNED DEFAULT NULL,
  `SubTotal` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `invoicedetails`
--

INSERT INTO `invoicedetails` (`id`, `invoice`, `order`, `product`, `qty`, `itemSale`, `SubTotal`) VALUES
(1, 1, NULL, 1, '5.00', 1, '12.5000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `losses`
--

CREATE TABLE `losses` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Saleprice` decimal(10,2) DEFAULT NULL,
  `OperationCost` decimal(10,2) DEFAULT NULL,
  `Lost` decimal(10,2) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Recovered` decimal(10,2) DEFAULT NULL,
  `Balance` decimal(10,2) DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `manager`
--

CREATE TABLE `manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `Manager` varchar(40) DEFAULT NULL,
  `Department` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `masteraccount`
--

CREATE TABLE `masteraccount` (
  `id` int(10) UNSIGNED NOT NULL,
  `masterAccount` varchar(40) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `masteraccount`
--

INSERT INTO `masteraccount` (`id`, `masterAccount`, `code`) VALUES
(1, 'Salida por venta', 'VENTA'),
(2, 'Ingreso por cobro de venta', 'COBRO'),
(3, 'Salida por compra', 'PAGO'),
(4, 'Ingreso por compra', 'COMPRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_grouppermissions`
--

CREATE TABLE `membership_grouppermissions` (
  `permissionID` int(10) UNSIGNED NOT NULL,
  `groupID` int(10) UNSIGNED DEFAULT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint(4) NOT NULL DEFAULT 0,
  `allowView` tinyint(4) NOT NULL DEFAULT 0,
  `allowEdit` tinyint(4) NOT NULL DEFAULT 0,
  `allowDelete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membership_grouppermissions`
--

INSERT INTO `membership_grouppermissions` (`permissionID`, `groupID`, `tableName`, `allowInsert`, `allowView`, `allowEdit`, `allowDelete`) VALUES
(1, 2, 'Customers', 1, 3, 3, 3),
(2, 2, 'Retention', 1, 3, 3, 3),
(3, 2, 'Alert', 1, 3, 3, 3),
(4, 2, 'CustomerClass', 1, 3, 3, 3),
(5, 2, 'Staff', 1, 3, 3, 3),
(6, 2, 'Country', 1, 3, 3, 3),
(7, 2, 'Province', 1, 3, 3, 3),
(8, 2, 'City', 1, 3, 3, 3),
(9, 2, 'Warehouse', 1, 3, 3, 3),
(10, 2, 'Tracking', 1, 3, 3, 3),
(11, 2, 'Status', 1, 3, 3, 3),
(12, 2, 'Invoice', 1, 3, 3, 3),
(13, 2, 'InvoiceDetails', 1, 3, 3, 3),
(14, 2, 'Products', 1, 3, 3, 3),
(15, 2, 'WHJournal', 1, 3, 3, 3),
(16, 2, 'CRM', 1, 3, 3, 3),
(17, 2, 'Payroll', 1, 3, 3, 3),
(18, 2, 'Brand', 1, 3, 3, 3),
(19, 2, 'Model', 1, 3, 3, 3),
(20, 2, 'System', 1, 3, 3, 3),
(21, 2, 'Part', 1, 3, 3, 3),
(22, 2, 'DatabaseAUTO', 1, 3, 3, 3),
(23, 2, 'GeneralDB', 1, 3, 3, 3),
(24, 2, 'CustomerAuto', 1, 3, 3, 3),
(25, 2, 'Compras', 1, 3, 3, 3),
(26, 2, 'TrackingCenter', 1, 3, 3, 3),
(27, 2, 'Claim', 1, 3, 3, 3),
(28, 2, 'Activities', 1, 3, 3, 3),
(29, 2, 'Return', 1, 3, 3, 3),
(30, 2, 'Department', 1, 3, 3, 3),
(31, 2, 'Position', 1, 3, 3, 3),
(32, 2, 'CEO', 1, 3, 3, 3),
(33, 2, 'Manager', 1, 3, 3, 3),
(34, 2, 'Supervisor', 1, 3, 3, 3),
(35, 2, 'Losses', 1, 3, 3, 3),
(36, 2, 'Subscriptions', 1, 3, 3, 3),
(37, 2, 'Accounting', 1, 3, 3, 3),
(38, 2, 'MasterAccount', 1, 3, 3, 3),
(39, 2, 'Account', 1, 3, 3, 3),
(40, 2, 'SubAccount', 1, 3, 3, 3),
(41, 2, 'Type', 1, 3, 3, 3),
(42, 2, 'CCJournal', 1, 3, 3, 3),
(43, 2, 'CC', 1, 3, 3, 3),
(44, 2, 'Receivable', 1, 3, 3, 3),
(2370, 2, 'AccountPlan', 1, 3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_groups`
--

CREATE TABLE `membership_groups` (
  `groupID` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `allowSignup` tinyint(4) DEFAULT NULL,
  `needsApproval` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membership_groups`
--

INSERT INTO `membership_groups` (`groupID`, `name`, `description`, `allowSignup`, `needsApproval`) VALUES
(1, 'anonymous', 'Anonymous group created automatically on 2020-09-14', 0, 0),
(2, 'Admins', 'Admin group created automatically on 2020-09-14', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_userpermissions`
--

CREATE TABLE `membership_userpermissions` (
  `permissionID` int(10) UNSIGNED NOT NULL,
  `memberID` varchar(100) NOT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint(4) NOT NULL DEFAULT 0,
  `allowView` tinyint(4) NOT NULL DEFAULT 0,
  `allowEdit` tinyint(4) NOT NULL DEFAULT 0,
  `allowDelete` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_userrecords`
--

CREATE TABLE `membership_userrecords` (
  `recID` bigint(20) UNSIGNED NOT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `pkValue` varchar(255) DEFAULT NULL,
  `memberID` varchar(100) DEFAULT NULL,
  `dateAdded` bigint(20) UNSIGNED DEFAULT NULL,
  `dateUpdated` bigint(20) UNSIGNED DEFAULT NULL,
  `groupID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membership_userrecords`
--

INSERT INTO `membership_userrecords` (`recID`, `tableName`, `pkValue`, `memberID`, `dateAdded`, `dateUpdated`, `groupID`) VALUES
(1, 'Customers', '1', 'jean.colon', 1600097827, 1600100013, 2),
(2, 'Customers', '2', 'alfredo.paulett', 1600098041, 1600100023, 2),
(3, 'CRM', '1', 'jean.colon', 1600098152, 1600100325, 2),
(4, 'CRM', '2', 'alfredo.paulett', 1600099329, 1600109216, 2),
(5, 'CustomerClass', '1', 'admin', 1600099387, 1600100453, 2),
(6, 'CustomerClass', '2', 'admin', 1600099719, 1600099719, 2),
(7, 'CustomerClass', '3', 'admin', 1600099728, 1600099728, 2),
(8, 'CustomerClass', '4', 'admin', 1600099744, 1600100476, 2),
(9, 'CustomerClass', '5', 'admin', 1600099852, 1600100490, 2),
(10, 'CustomerClass', '6', 'admin', 1600100189, 1600100503, 2),
(11, 'Customers', '3', 'jean.colon', 1600100489, 1600100489, 2),
(12, 'Country', '1', 'admin', 1600100552, 1600100552, 2),
(13, 'CRM', '3', 'jean.colon', 1600100971, 1600104611, 2),
(14, 'Customers', '4', 'alfredo.paulett', 1600101061, 1600101061, 2),
(15, 'CRM', '4', 'alfredo.paulett', 1600102323, 1600102323, 2),
(16, 'Customers', '5', 'alfredo.paulett', 1600109265, 1600109265, 2),
(17, 'CRM', '5', 'alfredo.paulett', 1600110219, 1600110495, 2),
(18, 'Customers', '6', 'alfredo.paulett', 1600111523, 1600111523, 2),
(19, 'CRM', '6', 'alfredo.paulett', 1600114015, 1600114048, 2),
(20, 'CRM', '7', 'alfredo.paulett', 1600120334, 1600120334, 2),
(23, 'Customers', '7', 'alfredo.paulett', 1600181814, 1600181814, 2),
(24, 'Staff', '1', 'jean.colon', 1600181835, 1600181835, 2),
(25, 'CRM', '8', 'alfredo.paulett', 1600181943, 1600185575, 2),
(26, 'Customers', '8', 'jean.colon', 1600182707, 1600182707, 2),
(27, 'CRM', '9', 'jean.colon', 1600183267, 1600185878, 2),
(28, 'Customers', '9', 'alfredo.paulett', 1600185776, 1600185798, 2),
(29, 'Customers', '10', 'jean.colon', 1600187201, 1600187466, 2),
(30, 'CRM', '10', 'jean.colon', 1600187411, 1600188436, 2),
(31, 'CRM', '11', 'alfredo.paulett', 1600187838, 1600188728, 2),
(32, 'Customers', '11', 'alfredo.paulett', 1600191083, 1600191083, 2),
(33, 'Customers', '12', 'admin', 1600192216, 1600192280, 2),
(34, 'Province', '1', 'admin', 1600192241, 1600192241, 2),
(35, 'City', '1', 'admin', 1600192270, 1600192270, 2),
(36, 'Staff', '2', 'admin', 1600192384, 1600192384, 2),
(37, 'CRM', '12', 'admin', 1600192512, 1600205439, 2),
(38, 'CRM', '13', 'alfredo.paulett', 1600193037, 1600195043, 2),
(39, 'Customers', '13', 'admin', 1600194033, 1600194033, 2),
(40, 'CRM', '14', 'admin', 1600194071, 1600194071, 2),
(41, 'Customers', '14', 'alfredo.paulett', 1600195468, 1600195468, 2),
(42, 'CRM', '15', 'alfredo.paulett', 1600200562, 1600200562, 2),
(43, 'Customers', '15', 'jean.colon', 1600203449, 1600203449, 2),
(44, 'CRM', '16', 'jean.colon', 1600203614, 1600203776, 2),
(45, 'Customers', '16', 'jean.colon', 1600203832, 1600203832, 2),
(46, 'CRM', '17', 'jean.colon', 1600203939, 1600207763, 2),
(47, 'Brand', '1', 'admin', 1600204713, 1600204713, 2),
(48, 'Model', '1', 'admin', 1600204733, 1600204733, 2),
(49, 'System', '1', 'admin', 1600204751, 1600204751, 2),
(50, 'Part', '1', 'admin', 1600204789, 1600204789, 2),
(51, 'DatabaseAUTO', '1', 'admin', 1600204971, 1600205035, 2),
(52, 'Customers', '17', 'jean.colon', 1600207867, 1600207867, 2),
(53, 'CRM', '18', 'jean.colon', 1600208140, 1600285001, 2),
(54, 'CRM', '19', 'jean.colon', 1600267409, 1600447102, 2),
(55, 'WHJournal', '1', 'jean.colon', 1600268919, 1600268923, 2),
(56, 'Warehouse', '2', 'jean.colon', 1600268998, 1600268998, 2),
(58, 'Customers', '18', 'jean.colon', 1600269125, 1600269749, 2),
(59, 'Tracking', '3', 'jean.colon', 1600269199, 1600269204, 2),
(60, 'Warehouse', '3', 'jean.colon', 1600269246, 1600269246, 2),
(61, 'Customers', '19', 'jean.colon', 1600269297, 1600269297, 2),
(62, 'Tracking', '4', 'jean.colon', 1600269343, 1600269343, 2),
(63, 'Warehouse', '4', 'jean.colon', 1600269397, 1600269397, 2),
(64, 'Customers', '20', 'jean.colon', 1600269468, 1600269468, 2),
(65, 'Tracking', '5', 'jean.colon', 1600269511, 1600269540, 2),
(66, 'Warehouse', '5', 'jean.colon', 1600269560, 1600269560, 2),
(67, 'Tracking', '6', 'jean.colon', 1600269611, 1600269611, 2),
(68, 'Warehouse', '6', 'jean.colon', 1600269639, 1600269639, 2),
(69, 'Customers', '21', 'jean.colon', 1600269686, 1600897636, 2),
(70, 'Tracking', '7', 'jean.colon', 1600269726, 1600269726, 2),
(71, 'Customers', '22', 'alfredo.paulett', 1600272025, 1600272025, 2),
(72, 'CRM', '20', 'alfredo.paulett', 1600272627, 1600277612, 2),
(73, 'Customers', '23', 'alfredo.paulett', 1600274511, 1600274511, 2),
(74, 'CRM', '21', 'alfredo.paulett', 1600277847, 1600277860, 2),
(75, 'WHJournal', '2', 'admin', 1600278696, 1600286897, 2),
(76, 'City', '2', 'admin', 1600282201, 1600282201, 2),
(77, 'Customers', '24', 'admin', 1600282212, 1600282212, 2),
(78, 'Warehouse', '7', 'admin', 1600282272, 1600282272, 2),
(79, 'Tracking', '8', 'admin', 1600282456, 1600282456, 2),
(80, 'Customers', '25', 'alfredo.paulett', 1600286115, 1601075352, 2),
(81, 'CRM', '22', 'alfredo.paulett', 1600286220, 1600442483, 2),
(82, 'Warehouse', '8', 'jean.colon', 1600287154, 1600287154, 2),
(83, 'GeneralDB', '1', 'admin', 1600288112, 1600288429, 2),
(84, 'Customers', '26', 'jean.colon', 1600289171, 1600289171, 2),
(85, 'Tracking', '9', 'jean.colon', 1600289280, 1600289283, 2),
(86, 'Customers', '27', 'jean.colon', 1600289350, 1600289350, 2),
(87, 'Tracking', '10', 'jean.colon', 1600289390, 1600289403, 2),
(88, 'Customers', '28', 'jean.colon', 1600289464, 1600289464, 2),
(89, 'Tracking', '11', 'jean.colon', 1600289507, 1600289516, 2),
(90, 'Customers', '29', 'jean.colon', 1600289602, 1600289602, 2),
(91, 'Tracking', '12', 'jean.colon', 1600289632, 1600289708, 2),
(92, 'Customers', '30', 'jean.colon', 1600289782, 1600375947, 2),
(93, 'Tracking', '13', 'jean.colon', 1600289832, 1600289842, 2),
(94, 'Customers', '31', 'jean.colon', 1600289888, 1600289888, 2),
(95, 'Tracking', '14', 'jean.colon', 1600289927, 1600289927, 2),
(96, 'Customers', '32', 'jean.colon', 1600290006, 1600290006, 2),
(97, 'Tracking', '15', 'jean.colon', 1600290037, 1600290037, 2),
(98, 'Tracking', '16', 'jean.colon', 1600290172, 1600290172, 2),
(99, 'Customers', '33', 'jean.colon', 1600290309, 1600290315, 2),
(100, 'Tracking', '17', 'jean.colon', 1600290359, 1600290404, 2),
(101, 'Customers', '34', 'jean.colon', 1600290505, 1600290505, 2),
(102, 'Tracking', '18', 'jean.colon', 1600290526, 1600290669, 2),
(103, 'Customers', '35', 'jean.colon', 1600290737, 1600290737, 2),
(104, 'Tracking', '19', 'jean.colon', 1600290785, 1600290785, 2),
(105, 'Customers', '36', 'jean.colon', 1600290853, 1600290853, 2),
(106, 'Tracking', '20', 'jean.colon', 1600290888, 1600290888, 2),
(107, 'Tracking', '21', 'jean.colon', 1600290952, 1600290952, 2),
(108, 'Customers', '37', 'alfredo.paulett', 1600292838, 1600292838, 2),
(109, 'CRM', '23', 'alfredo.paulett', 1600293222, 1600295768, 2),
(110, 'Customers', '38', 'alfredo.paulett', 1600293584, 1600293584, 2),
(111, 'CRM', '24', 'alfredo.paulett', 1600294258, 1600294928, 2),
(112, 'GeneralDB', '2', 'admin', 1600294909, 1600294998, 2),
(113, 'Customers', '39', 'admin', 1600295950, 1600352368, 2),
(114, 'CRM', '25', 'admin', 1600296038, 1600296060, 2),
(115, 'CustomerAuto', '1', 'admin', 1600296139, 1600296233, 2),
(116, 'Brand', '2', 'admin', 1600296157, 1600296157, 2),
(117, 'Model', '2', 'admin', 1600296172, 1600296172, 2),
(118, 'Customers', '40', 'alfredo.paulett', 1600354207, 1600354207, 2),
(119, 'Customers', '41', 'admin', 1600356439, 1600356439, 2),
(120, 'CRM', '26', 'alfredo.paulett', 1600356782, 1600356782, 2),
(121, 'CRM', '27', 'admin', 1600357020, 1600359020, 2),
(122, 'Customers', '42', 'alfredo.paulett', 1600357664, 1600357664, 2),
(123, 'CRM', '28', 'alfredo.paulett', 1600357832, 1600369814, 2),
(124, 'Customers', '43', 'admin', 1600361137, 1600361137, 2),
(125, 'CRM', '29', 'admin', 1600362569, 1600362569, 2),
(126, 'WHJournal', '3', 'admin', 1600362843, 1600370787, 2),
(127, 'Warehouse', '9', 'admin', 1600364265, 1600364274, 2),
(128, 'Tracking', '22', 'admin', 1600364315, 1600364346, 2),
(129, 'Warehouse', '10', 'admin', 1600364356, 1600364356, 2),
(130, 'Tracking', '23', 'admin', 1600364396, 1600364396, 2),
(131, 'Customers', '44', 'admin', 1600364457, 1600364457, 2),
(132, 'Tracking', '24', 'admin', 1600364481, 1600364497, 2),
(133, 'Customers', '45', 'admin', 1600364539, 1600364539, 2),
(134, 'Tracking', '25', 'admin', 1600364577, 1600364577, 2),
(135, 'Customers', '46', 'admin', 1600364609, 1600364609, 2),
(136, 'Tracking', '26', 'admin', 1600364642, 1600364810, 2),
(137, 'Customers', '47', 'admin', 1600364850, 1600364850, 2),
(138, 'Tracking', '27', 'admin', 1600364884, 1600364884, 2),
(139, 'Tracking', '28', 'admin', 1600364956, 1600365056, 2),
(140, 'Tracking', '29', 'admin', 1600365088, 1600365174, 2),
(141, 'Tracking', '30', 'admin', 1600365224, 1600365249, 2),
(142, 'Customers', '48', 'admin', 1600365299, 1600874686, 2),
(143, 'Tracking', '31', 'admin', 1600365358, 1600365358, 2),
(144, 'Customers', '49', 'admin', 1600365486, 1600365486, 2),
(145, 'Tracking', '32', 'admin', 1600365541, 1600365552, 2),
(146, 'Tracking', '33', 'admin', 1600365787, 1600365894, 2),
(147, 'Customers', '50', 'admin', 1600365935, 1600372437, 2),
(148, 'Tracking', '34', 'admin', 1600365984, 1600365983, 2),
(149, 'Customers', '51', 'admin', 1600366029, 1600372362, 2),
(150, 'Tracking', '35', 'admin', 1600366068, 1600366068, 2),
(151, 'Tracking', '36', 'admin', 1600366141, 1600366185, 2),
(152, 'Customers', '52', 'admin', 1600366586, 1600366586, 2),
(153, 'Tracking', '37', 'admin', 1600366785, 1600366789, 2),
(154, 'Return', '1', 'admin', 1600366791, 1600370716, 2),
(155, 'Claim', '1', 'admin', 1600366828, 1600368751, 2),
(156, 'Tracking', '38', 'admin', 1600366915, 1600366915, 2),
(157, 'Tracking', '39', 'admin', 1600366960, 1600366960, 2),
(158, 'Customers', '53', 'admin', 1600369403, 1600369403, 2),
(159, 'CRM', '30', 'admin', 1600369495, 1600438828, 2),
(160, 'Return', '2', 'admin', 1600370711, 1600370711, 2),
(161, 'Customers', '54', 'alfredo.paulett', 1600447406, 1600447406, 2),
(162, 'WHJournal', '4', 'admin', 1600449340, 1600452115, 2),
(163, 'Warehouse', '11', 'admin', 1600449373, 1600449373, 2),
(164, 'Tracking', '40', 'admin', 1600449532, 1600454445, 2),
(165, 'Tracking', '41', 'admin', 1600449615, 1600449615, 2),
(166, 'Tracking', '42', 'admin', 1600449747, 1600449747, 2),
(167, 'Customers', '55', 'admin', 1600449802, 1600449802, 2),
(168, 'Tracking', '43', 'admin', 1600449920, 1600468082, 2),
(169, 'Tracking', '44', 'admin', 1600450023, 1600454900, 2),
(170, 'CRM', '31', 'alfredo.paulett', 1600451043, 1600451043, 2),
(171, 'CRM', '32', 'admin', 1600451264, 1600876810, 2),
(172, 'Customers', '56', 'admin', 1600456822, 1600456822, 2),
(173, 'CRM', '33', 'admin', 1600457312, 1600457417, 2),
(174, 'CRM', '34', 'alfredo.paulett', 1600465481, 1600465481, 2),
(175, 'CRM', '35', 'alfredo.paulett', 1600466065, 1600466456, 2),
(176, 'CRM', '36', 'alfredo.paulett', 1600700821, 1600701575, 2),
(177, 'Customers', '57', 'jean.colon', 1600701731, 1600701731, 2),
(178, 'CRM', '37', 'alfredo.paulett', 1600704260, 1600704260, 2),
(179, 'CRM', '38', 'jean.colon', 1600705488, 1600718144, 2),
(180, 'Customers', '58', 'jean.colon', 1600707515, 1600707515, 2),
(181, 'CRM', '39', 'jean.colon', 1600707623, 1600707633, 2),
(182, 'CRM', '40', 'jean.colon', 1600718877, 1600722017, 2),
(183, 'Customers', '59', 'alfredo.paulett', 1600721700, 1600721700, 2),
(184, 'CRM', '41', 'alfredo.paulett', 1600721917, 1600723592, 2),
(185, 'CRM', '42', 'alfredo.paulett', 1600721926, 1600721926, 2),
(186, 'Customers', '60', 'jean.colon', 1600722634, 1600722634, 2),
(187, 'CRM', '43', 'jean.colon', 1600722712, 1600873831, 2),
(188, 'CRM', '44', 'alfredo.paulett', 1600727306, 1600727306, 2),
(189, 'Customers', '61', 'jean.colon', 1600789439, 1600789631, 2),
(190, 'Customers', '62', 'alfredo.paulett', 1600789618, 1600789644, 2),
(191, 'CRM', '45', 'jean.colon', 1600790850, 1600794078, 2),
(192, 'Customers', '63', 'jean.colon', 1600791122, 1600791122, 2),
(193, 'CRM', '46', 'alfredo.paulett', 1600791189, 1600792238, 2),
(194, 'CRM', '47', 'jean.colon', 1600791893, 1600892627, 2),
(195, 'Customers', '64', 'alfredo.paulett', 1600794191, 1600794191, 2),
(196, 'WHJournal', '5', 'jean.colon', 1600796076, 1600965620, 2),
(197, 'Warehouse', '12', 'jean.colon', 1600796421, 1600796421, 2),
(198, 'Tracking', '45', 'jean.colon', 1600796489, 1600796644, 2),
(199, 'Warehouse', '13', 'jean.colon', 1600796665, 1600796665, 2),
(200, 'Tracking', '46', 'jean.colon', 1600796702, 1600796708, 2),
(201, 'Tracking', '47', 'jean.colon', 1600796825, 1600796825, 2),
(202, 'Tracking', '48', 'jean.colon', 1600796865, 1600796865, 2),
(203, 'Tracking', '49', 'jean.colon', 1600796957, 1600796957, 2),
(204, 'Tracking', '50', 'jean.colon', 1600796999, 1600797029, 2),
(205, 'Customers', '65', 'jean.colon', 1600797083, 1600797083, 2),
(206, 'Tracking', '51', 'jean.colon', 1600797105, 1600797105, 2),
(207, 'Warehouse', '14', 'jean.colon', 1600797121, 1600797121, 2),
(208, 'Tracking', '52', 'jean.colon', 1600797152, 1600797181, 2),
(209, 'Tracking', '53', 'jean.colon', 1600797238, 1600797238, 2),
(210, 'Tracking', '54', 'jean.colon', 1600797346, 1600797370, 2),
(211, 'Tracking', '55', 'jean.colon', 1600797405, 1600797405, 2),
(212, 'Warehouse', '15', 'jean.colon', 1600797423, 1600797423, 2),
(213, 'Tracking', '56', 'jean.colon', 1600797448, 1600797455, 2),
(214, 'Tracking', '57', 'jean.colon', 1600797503, 1600797503, 2),
(215, 'Tracking', '58', 'jean.colon', 1600797581, 1600797601, 2),
(216, 'Customers', '66', 'jean.colon', 1600797647, 1600797647, 2),
(217, 'Tracking', '59', 'jean.colon', 1600797665, 1600797665, 2),
(218, 'Customers', '67', 'jean.colon', 1600797742, 1600797742, 2),
(219, 'Tracking', '60', 'jean.colon', 1600797768, 1600797768, 2),
(220, 'Warehouse', '16', 'jean.colon', 1600797784, 1600797784, 2),
(221, 'Tracking', '61', 'jean.colon', 1600797829, 1600797829, 2),
(222, 'Tracking', '62', 'jean.colon', 1600797878, 1600797897, 2),
(223, 'Tracking', '63', 'jean.colon', 1600797938, 1600797951, 2),
(224, 'Warehouse', '17', 'jean.colon', 1600798058, 1600798058, 2),
(225, 'Tracking', '64', 'jean.colon', 1600798109, 1600798109, 2),
(226, 'Tracking', '65', 'jean.colon', 1600798173, 1600798180, 2),
(227, 'Warehouse', '18', 'jean.colon', 1600798197, 1600798197, 2),
(228, 'Tracking', '66', 'jean.colon', 1600798220, 1600798220, 2),
(229, 'Warehouse', '19', 'jean.colon', 1600798236, 1600798236, 2),
(230, 'Tracking', '67', 'jean.colon', 1600798281, 1600798281, 2),
(231, 'Tracking', '68', 'jean.colon', 1600798403, 1600798414, 2),
(232, 'Customers', '68', 'jean.colon', 1600798496, 1600798496, 2),
(233, 'Tracking', '69', 'jean.colon', 1600798520, 1600798547, 2),
(234, 'Tracking', '70', 'jean.colon', 1600798653, 1600798653, 2),
(235, 'Customers', '69', 'jean.colon', 1600798729, 1600798729, 2),
(236, 'Tracking', '71', 'jean.colon', 1600798752, 1600798752, 2),
(237, 'Customers', '70', 'jean.colon', 1600798795, 1600798795, 2),
(238, 'Tracking', '72', 'jean.colon', 1600798835, 1600803894, 2),
(239, 'CRM', '48', 'jean.colon', 1600804472, 1600807022, 2),
(240, 'CRM', '49', 'alfredo.paulett', 1600806432, 1600890534, 2),
(241, 'CRM', '50', 'jean.colon', 1600874971, 1600879288, 2),
(242, 'CRM', '51', 'alfredo.paulett', 1600875600, 1600875600, 2),
(243, 'CRM', '52', 'jean.colon', 1600880572, 1600979573, 2),
(244, 'Customers', '71', 'jean.colon', 1600881244, 1600881244, 2),
(245, 'Customers', '72', 'jean.colon', 1600897716, 1600897716, 2),
(246, 'CRM', '53', 'jean.colon', 1600898100, 1600898100, 2),
(247, 'Customers', '73', 'jean.colon', 1600898475, 1600898475, 2),
(248, 'CRM', '54', 'jean.colon', 1600898544, 1600898726, 2),
(249, 'WHJournal', '6', 'jean.colon', 1600967199, 1600990958, 2),
(250, 'Warehouse', '20', 'jean.colon', 1600967301, 1600967301, 2),
(251, 'Tracking', '73', 'jean.colon', 1600967429, 1600967429, 2),
(252, 'Customers', '74', 'jean.colon', 1600967476, 1600967476, 2),
(253, 'Tracking', '74', 'jean.colon', 1600967500, 1600967500, 2),
(254, 'Tracking', '75', 'jean.colon', 1600967542, 1600967542, 2),
(255, 'Tracking', '76', 'jean.colon', 1600967705, 1600967705, 2),
(256, 'Customers', '75', 'jean.colon', 1600967742, 1600967938, 2),
(257, 'Tracking', '77', 'jean.colon', 1600967777, 1600967777, 2),
(258, 'Tracking', '78', 'jean.colon', 1600968033, 1600968033, 2),
(259, 'Warehouse', '21', 'jean.colon', 1600968181, 1600968181, 2),
(260, 'Tracking', '79', 'jean.colon', 1600968210, 1600968210, 2),
(261, 'Warehouse', '22', 'jean.colon', 1600968220, 1600968220, 2),
(262, 'Tracking', '80', 'jean.colon', 1600968252, 1600968252, 2),
(263, 'Warehouse', '23', 'jean.colon', 1600968266, 1600968266, 2),
(264, 'Tracking', '81', 'jean.colon', 1600968302, 1600968302, 2),
(265, 'Warehouse', '24', 'jean.colon', 1600968405, 1600968405, 2),
(266, 'Tracking', '82', 'jean.colon', 1600968429, 1600968429, 2),
(267, 'Warehouse', '25', 'jean.colon', 1600968551, 1600968557, 2),
(268, 'Tracking', '83', 'jean.colon', 1600968584, 1600968584, 2),
(269, 'Warehouse', '26', 'jean.colon', 1600968599, 1600968599, 2),
(270, 'Tracking', '84', 'jean.colon', 1600968631, 1600968631, 2),
(271, 'Warehouse', '27', 'jean.colon', 1600968644, 1600968644, 2),
(272, 'Tracking', '85', 'jean.colon', 1600968683, 1600968683, 2),
(273, 'Warehouse', '28', 'jean.colon', 1600968794, 1600968794, 2),
(274, 'Tracking', '86', 'jean.colon', 1600968823, 1600968823, 2),
(275, 'Warehouse', '29', 'jean.colon', 1600968832, 1600968832, 2),
(276, 'Tracking', '87', 'jean.colon', 1600968859, 1600968859, 2),
(277, 'Warehouse', '30', 'jean.colon', 1600968868, 1600968868, 2),
(278, 'Tracking', '88', 'jean.colon', 1600968893, 1600968893, 2),
(279, 'Warehouse', '31', 'jean.colon', 1600968902, 1600968902, 2),
(280, 'Tracking', '89', 'jean.colon', 1600968928, 1600968928, 2),
(281, 'Warehouse', '32', 'jean.colon', 1600968949, 1600968949, 2),
(282, 'Tracking', '90', 'jean.colon', 1600968982, 1600968982, 2),
(283, 'Warehouse', '33', 'jean.colon', 1600968993, 1600968993, 2),
(284, 'Tracking', '91', 'jean.colon', 1600969032, 1600969032, 2),
(285, 'Warehouse', '34', 'jean.colon', 1600969085, 1600969085, 2),
(286, 'Tracking', '92', 'jean.colon', 1600969127, 1600969127, 2),
(287, 'Warehouse', '35', 'jean.colon', 1600969155, 1600969155, 2),
(288, 'Tracking', '93', 'jean.colon', 1600969190, 1600969320, 2),
(289, 'Warehouse', '36', 'jean.colon', 1600969330, 1600969330, 2),
(290, 'Tracking', '94', 'jean.colon', 1600969356, 1600969404, 2),
(291, 'Warehouse', '37', 'jean.colon', 1600969451, 1600969451, 2),
(292, 'Tracking', '95', 'jean.colon', 1600969485, 1600969485, 2),
(293, 'Warehouse', '38', 'jean.colon', 1600969496, 1600969496, 2),
(294, 'Tracking', '96', 'jean.colon', 1600969535, 1600969547, 2),
(295, 'Warehouse', '39', 'jean.colon', 1600969601, 1600969601, 2),
(296, 'Tracking', '97', 'jean.colon', 1600969636, 1600969636, 2),
(297, 'Warehouse', '40', 'jean.colon', 1600969688, 1600969688, 2),
(298, 'Tracking', '98', 'jean.colon', 1600969720, 1600969720, 2),
(299, 'Warehouse', '41', 'jean.colon', 1600969757, 1600969757, 2),
(300, 'Customers', '76', 'jean.colon', 1600969798, 1600969798, 2),
(301, 'Tracking', '99', 'jean.colon', 1600969829, 1600969829, 2),
(302, 'Warehouse', '42', 'jean.colon', 1600969857, 1600969857, 2),
(303, 'Tracking', '100', 'jean.colon', 1600969896, 1600969896, 2),
(304, 'Warehouse', '43', 'jean.colon', 1600969935, 1600969935, 2),
(305, 'Tracking', '101', 'jean.colon', 1600969963, 1600969968, 2),
(306, 'Warehouse', '44', 'jean.colon', 1600969990, 1600969990, 2),
(307, 'Tracking', '102', 'jean.colon', 1600970014, 1600970014, 2),
(308, 'Warehouse', '45', 'jean.colon', 1600970026, 1600970026, 2),
(309, 'Tracking', '103', 'jean.colon', 1600970052, 1600970052, 2),
(310, 'Warehouse', '46', 'jean.colon', 1600970069, 1600970069, 2),
(311, 'Tracking', '104', 'jean.colon', 1600970131, 1600970133, 2),
(312, 'Warehouse', '47', 'jean.colon', 1600970157, 1600970157, 2),
(313, 'Tracking', '105', 'jean.colon', 1600970266, 1600970282, 2),
(314, 'Warehouse', '48', 'jean.colon', 1600970295, 1600970295, 2),
(315, 'Tracking', '106', 'jean.colon', 1600970320, 1600971632, 2),
(316, 'Warehouse', '49', 'alfredo.paulett', 1600977224, 1600977235, 2),
(317, 'Tracking', '107', 'alfredo.paulett', 1600977282, 1600977282, 2),
(318, 'CRM', '55', 'admin', 1600986553, 1600988692, 2),
(319, 'Customers', '77', 'jean.colon', 1600987582, 1600987582, 2),
(320, 'CRM', '56', 'jean.colon', 1600988120, 1600988128, 2),
(321, 'CRM', '57', 'jean.colon', 1600988453, 1601047875, 2),
(322, 'Customers', '78', 'jean.colon', 1601046059, 1601046059, 2),
(323, 'CRM', '58', 'jean.colon', 1601046389, 1601047299, 2),
(324, 'WHJournal', '7', 'jean.colon', 1601053924, 1601053924, 2),
(325, 'Customers', '79', 'jean.colon', 1601053974, 1601063969, 2),
(326, 'Warehouse', '50', 'jean.colon', 1601054006, 1601054006, 2),
(327, 'Tracking', '108', 'jean.colon', 1601054058, 1601054189, 2),
(328, 'Tracking', '109', 'jean.colon', 1601054675, 1601054675, 2),
(329, 'Tracking', '110', 'jean.colon', 1601054709, 1601054709, 2),
(330, 'Tracking', '111', 'jean.colon', 1601055516, 1601056001, 2),
(331, 'CRM', '59', 'alfredo.paulett', 1601060380, 1601061721, 2),
(332, 'Customers', '80', 'alfredo.paulett', 1601061814, 1601061814, 2),
(333, 'CRM', '60', 'alfredo.paulett', 1601062441, 1601065185, 2),
(334, 'CRM', '61', 'jean.colon', 1601070430, 1601070649, 2),
(335, 'CRM', '62', 'jean.colon', 1601073463, 1601074732, 2),
(336, 'CRM', '63', 'jean.colon', 1601074014, 1601074014, 2),
(337, 'CRM', '64', 'alfredo.paulett', 1601306042, 1601310742, 2),
(338, 'CRM', '65', 'jean.colon', 1601306349, 1601306353, 2),
(339, 'CRM', '66', 'jean.colon', 1601308232, 1601308232, 2),
(340, 'CRM', '67', 'alfredo.paulett', 1601313125, 1601319454, 2),
(341, 'CRM', '68', 'jean.colon', 1601315687, 1601322270, 2),
(342, 'CRM', '69', 'alfredo.paulett', 1601320012, 1601322133, 2),
(343, 'MasterAccount', '1', 'admin', 1601405096, 1601405096, 2),
(344, 'Account', '1', 'admin', 1601405135, 1601405135, 2),
(345, 'SubAccount', '1', 'admin', 1601405160, 1601405160, 2),
(346, 'Type', '1', 'admin', 1601405195, 1601405195, 2),
(347, 'AccountPlan', '1', 'admin', 1601405207, 1601405207, 2),
(348, 'MasterAccount', '2', 'admin', 1601405343, 1601405343, 2),
(349, 'Account', '2', 'admin', 1601405375, 1601405375, 2),
(350, 'SubAccount', '2', 'admin', 1601405417, 1601405417, 2),
(351, 'Type', '2', 'admin', 1601405433, 1601405433, 2),
(352, 'AccountPlan', '2', 'admin', 1601405595, 1601405595, 2),
(353, 'SubAccount', '3', 'admin', 1601405708, 1601405708, 2),
(354, 'AccountPlan', '3', 'admin', 1601405722, 1601405722, 2),
(355, 'Account', '3', 'admin', 1601405823, 1601405823, 2),
(356, 'SubAccount', '4', 'admin', 1601405914, 1601405914, 2),
(357, 'AccountPlan', '4', 'admin', 1601405925, 1601405925, 2),
(358, 'MasterAccount', '3', 'admin', 1601408012, 1601408012, 2),
(359, 'AccountPlan', '5', 'admin', 1601408043, 1601408043, 2),
(360, 'MasterAccount', '4', 'admin', 1601408181, 1601408181, 2),
(361, 'Account', '4', 'admin', 1601408221, 1601408221, 2),
(362, 'SubAccount', '5', 'admin', 1601408251, 1601408251, 2),
(363, 'AccountPlan', '6', 'admin', 1601408280, 1601408280, 2),
(364, 'Invoice', '1', 'admin', 1601408414, 1601410460, 2),
(365, 'Products', '1', 'admin', 1601410358, 1601410358, 2),
(366, 'InvoiceDetails', '1', 'admin', 1601410439, 1601410439, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_users`
--

CREATE TABLE `membership_users` (
  `memberID` varchar(100) NOT NULL,
  `passMD5` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `signupDate` date DEFAULT NULL,
  `groupID` int(10) UNSIGNED DEFAULT NULL,
  `isBanned` tinyint(4) DEFAULT NULL,
  `isApproved` tinyint(4) DEFAULT NULL,
  `custom1` text DEFAULT NULL,
  `custom2` text DEFAULT NULL,
  `custom3` text DEFAULT NULL,
  `custom4` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `pass_reset_key` varchar(100) DEFAULT NULL,
  `pass_reset_expiry` int(10) UNSIGNED DEFAULT NULL,
  `flags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membership_users`
--

INSERT INTO `membership_users` (`memberID`, `passMD5`, `email`, `signupDate`, `groupID`, `isBanned`, `isApproved`, `custom1`, `custom2`, `custom3`, `custom4`, `comments`, `pass_reset_key`, `pass_reset_expiry`, `flags`) VALUES
('admin', '$2y$10$..Xo2zIeOrjdCAmLJRHx7uz8OU4nTNAhYmxWdoLUTi3JobqbntTci', 'jakeharriss@tradexx.net', '2020-09-14', 2, 0, 1, NULL, NULL, NULL, NULL, 'Admin member created automatically on 2020-09-14', NULL, NULL, NULL),
('alfredo.paulett', '$2y$10$gLWF3/alPWUR7.1.PPYZw.TYbAHvGPvD/HL6oiPzOzW6mlOzdIgoe', 'alfredo.paulett@tradexx.net', '2020-09-14', 2, 0, 1, 'Alfredo Paulett', 'Alto Boquete', '', '', '', NULL, NULL, NULL),
('guest', NULL, NULL, '2020-09-14', 1, 0, 1, NULL, NULL, NULL, NULL, 'Anonymous member created automatically on 2020-09-14', NULL, NULL, NULL),
('jean.colon', '$2y$10$ADJTOgCDJXHssWxEBMenye92YqlN0vzLuzHnEn9bnvR3mvdDcilxm', 'jean.colon@tradexx.net', '2020-09-14', 2, 0, 1, 'Jean Colon', 'Alto Boquete', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membership_usersessions`
--

CREATE TABLE `membership_usersessions` (
  `memberID` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `expiry_ts` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `membership_usersessions`
--

INSERT INTO `membership_usersessions` (`memberID`, `token`, `agent`, `expiry_ts`) VALUES
('admin', 'mN8HfGpcjSfhcT1SrTEX26pcuR4rWd', 'ymoahnzaZUw763cN1iDJ15tnd6CTIb', 1602679434),
('admin', 'FYSLqcU7od6oS5hgL9jLoCw3P4D8ST', 'hs6AAwNLPykBMl8NwFykSTkozCt5mA', 1602685702),
('alfredo.paulett', 'oIbhka5t6DPB66iqqfW277oxEXpoP7', 'yHFMwswGxC8vdm5FCeAQhJ6LfEi00h', 1602686130),
('admin', 'uAABkRjvW0KYWZGPrtQY5QikSbsl3E', 'mcPskpSQAaL4eyBsWK1mthYQJQ1Vh1', 1602689817),
('alfredo.paulett', 'o43wqWUWTrjKyYFYAgI3mBphRuzJ8s', 'AfaF1vDLv5Jj6nmD2Mf5G6ZWInJFlO', 1602697760),
('admin', 'IMwFRHxIVq5vGEDuhFet8Yiq0eYbc5', 'l9CmyoY9yYNsfjUzApqBBvpEiJzYPq', 1602880311),
('admin', 'Dbg80WSptNc8FLNDUpaKAPNfLxKjYj', 'D3OXGEvqFHlycLdCYp47sDoPh6edqS', 1602911851),
('alfredo.paulett', '0sk1U2VLcjSxCQBoIjkaeW22XdScF1', 'PnJ095onV9CtLDFSmL31zlzOZDvESG', 1603057329),
('alfredo.paulett', 'XUTZ321hcnojxTiz8GE94ZN4OrqIxz', 'NGzYBmvXurudNebwJHrPW85LPS8BwZ', 1603652101),
('alfredo.paulett', 'rtiy1XYXL0UtQ1QHnSUL8siNqGwS8D', 'Ti86DR6VdYMe3bcE4m076YtEftIrIY', 1603897089);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `Model` varchar(40) DEFAULT NULL,
  `Brand` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `model`
--

INSERT INTO `model` (`id`, `Model`, `Brand`) VALUES
(1, 'OPTIMA', 1),
(2, 'ACCENT', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `part`
--

CREATE TABLE `part` (
  `id` int(10) UNSIGNED NOT NULL,
  `Part` varchar(40) DEFAULT NULL,
  `System` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `part`
--

INSERT INTO `part` (`id`, `Part`, `System`) VALUES
(1, 'WINDOW VISOR / BOTAS DE AGUA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payroll`
--

CREATE TABLE `payroll` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start` varchar(40) DEFAULT NULL,
  `stop` varchar(40) DEFAULT NULL,
  `horas` decimal(10,2) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `value` varchar(40) DEFAULT NULL,
  `status` varchar(40) DEFAULT 'UNPAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `position`
--

CREATE TABLE `position` (
  `id` int(10) UNSIGNED NOT NULL,
  `Position` varchar(40) DEFAULT NULL,
  `Department` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(40) DEFAULT NULL,
  `item` varchar(40) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `profit` decimal(10,2) DEFAULT NULL,
  `itemSale` decimal(10,2) DEFAULT NULL,
  `uploads` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `item`, `cost`, `profit`, `itemSale`, `uploads`) VALUES
(1, '0111001', 'Mouse logitech', '2.00', '0.80', '2.50', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `province`
--

CREATE TABLE `province` (
  `id` int(10) UNSIGNED NOT NULL,
  `Province` varchar(40) DEFAULT NULL,
  `Country` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `province`
--

INSERT INTO `province` (`id`, `Province`, `Country`) VALUES
(1, 'CHIRIQUI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receivable`
--

CREATE TABLE `receivable` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Phone` int(10) UNSIGNED DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Interaction` text DEFAULT NULL,
  `ExpectedDate` date DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'OPEN',
  `Assigned` int(10) UNSIGNED DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retention`
--

CREATE TABLE `retention` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Phone` int(10) UNSIGNED DEFAULT NULL,
  `Email` int(10) UNSIGNED DEFAULT NULL,
  `Zone` int(10) UNSIGNED DEFAULT NULL,
  `Interaction` text DEFAULT NULL,
  `GIFTPACKAGE` text DEFAULT NULL,
  `Assigned` int(10) UNSIGNED DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'OPEN',
  `CreateDate` datetime DEFAULT NULL,
  `ResolutionDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `return`
--

CREATE TABLE `return` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Invoice` text DEFAULT NULL,
  `Warehouse` int(10) UNSIGNED DEFAULT NULL,
  `Tracking` int(10) UNSIGNED DEFAULT NULL,
  `Shippingt` varchar(40) DEFAULT NULL,
  `Status` varchar(40) NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Refund` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `return`
--

INSERT INTO `return` (`id`, `Date`, `Invoice`, `Warehouse`, `Tracking`, `Shippingt`, `Status`, `Amount`, `Refund`) VALUES
(1, '2020-09-17', '151706C', 9, 4294967295, 'AIR FREIGHT', 'OPEN', NULL, NULL),
(2, '2020-09-17', '151706C', 10, 4294967295, 'AIR FREIGHT', 'OPEN', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `sql_view_sales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `sql_view_sales` (
`id` int(10) unsigned
,`item` varchar(40)
,`PaymentStatus` varchar(40)
,`usrAdd` varchar(40)
,`Status` varchar(40)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `Photo` varchar(40) DEFAULT NULL,
  `Employee` varchar(40) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Phone` varchar(40) DEFAULT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` int(10) UNSIGNED DEFAULT NULL,
  `Province` int(10) UNSIGNED DEFAULT NULL,
  `Country` int(10) UNSIGNED DEFAULT NULL,
  `hireDate` date DEFAULT NULL,
  `Department` int(10) UNSIGNED DEFAULT NULL,
  `Position` int(10) UNSIGNED DEFAULT NULL,
  `Supervisor` int(10) UNSIGNED DEFAULT NULL,
  `Manager` int(10) UNSIGNED DEFAULT NULL,
  `Director` int(10) UNSIGNED DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `EmergencyContact` text DEFAULT NULL,
  `EmergencyPhone` text DEFAULT NULL,
  `userName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `staff`
--

INSERT INTO `staff` (`id`, `Photo`, `Employee`, `Birthdate`, `Phone`, `Email`, `Address`, `City`, `Province`, `Country`, `hireDate`, `Department`, `Position`, `Supervisor`, `Manager`, `Director`, `Status`, `EmergencyContact`, `EmergencyPhone`, `userName`) VALUES
(1, NULL, 'Jean Carlos Colón', '1995-04-26', '68079562', NULL, 'Alto boquete, Samboni', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(2, NULL, 'Alfredo Paulett', '1994-11-22', '65860791', NULL, 'Alto Boquete', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `TrackID` int(10) UNSIGNED DEFAULT NULL,
  `Invoice` int(10) UNSIGNED DEFAULT NULL,
  `Tracking` int(10) UNSIGNED DEFAULT NULL,
  `Dimensions` int(10) UNSIGNED DEFAULT NULL,
  `RWeight` int(10) UNSIGNED DEFAULT NULL,
  `VWeight` int(10) UNSIGNED DEFAULT NULL,
  `Total` int(10) UNSIGNED DEFAULT NULL,
  `FreightType` varchar(40) NOT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `Delivered` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subaccount`
--

CREATE TABLE `subaccount` (
  `id` int(10) UNSIGNED NOT NULL,
  `account` int(10) UNSIGNED DEFAULT NULL,
  `subAccount` varchar(40) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subaccount`
--

INSERT INTO `subaccount` (`id`, `account`, `subAccount`, `code`) VALUES
(1, NULL, 'Venta', 'VENTA'),
(2, NULL, 'Visa - tarjeta de crédito', 'VISA'),
(3, NULL, 'America Express', 'AMEX'),
(4, NULL, 'Wallet', 'WALLET'),
(5, NULL, 'Compra', 'COMPRA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Vendor` varchar(40) DEFAULT NULL,
  `AccountID` text DEFAULT NULL,
  `LastPayment` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Status` varchar(40) DEFAULT NULL,
  `Rate` decimal(10,2) DEFAULT NULL,
  `AmountDue` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor`
--

CREATE TABLE `supervisor` (
  `id` int(10) UNSIGNED NOT NULL,
  `Supervisor` varchar(40) DEFAULT NULL,
  `Department` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system`
--

CREATE TABLE `system` (
  `id` int(10) UNSIGNED NOT NULL,
  `System` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `system`
--

INSERT INTO `system` (`id`, `System`) VALUES
(1, 'BODY / CARROCERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking`
--

CREATE TABLE `tracking` (
  `id` int(10) UNSIGNED NOT NULL,
  `WhID` int(10) UNSIGNED DEFAULT NULL,
  `Date` int(10) UNSIGNED DEFAULT 1,
  `Warehouse` int(10) UNSIGNED DEFAULT NULL,
  `Tracking` varchar(40) DEFAULT NULL,
  `Customer` int(10) UNSIGNED DEFAULT NULL,
  `Dimensions` varchar(40) DEFAULT NULL,
  `Weight` decimal(10,2) DEFAULT NULL,
  `Volume` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Employee` int(10) UNSIGNED DEFAULT NULL,
  `Freight` int(10) UNSIGNED DEFAULT NULL,
  `Status` varchar(40) DEFAULT 'READY FOR PICK UP',
  `Zone` int(10) UNSIGNED DEFAULT NULL,
  `DeliveredDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tracking`
--

INSERT INTO `tracking` (`id`, `WhID`, `Date`, `Warehouse`, `Tracking`, `Customer`, `Dimensions`, `Weight`, `Volume`, `Total`, `Employee`, `Freight`, `Status`, `Zone`, `DeliveredDate`) VALUES
(3, 2, 2, 2, 'TBAMIA517463218', 18, '14x11x6', '4.00', '7.00', '15.25', 1, 2, 'READY FOR PICKUP', 18, NULL),
(4, 3, 3, 3, '4203312695055145224302405254', 19, '15x12x4', '6.00', '2.00', '9.50', 1, 3, 'READY FOR PICKUP', 19, NULL),
(5, 4, 4, 4, 'TBAMIA517457538', 20, '12x9x1', '1.00', '1.00', '3.50', 1, 4, 'READY FOR PICKUP', 20, NULL),
(6, 5, 5, 5, 'NCCC438008-495328', 20, '10x5x1', '1.00', '1.00', '3.50', 1, 5, 'READY FOR PICKUP', 20, NULL),
(7, 6, 6, 6, 'TBAMIA517472211', 21, '12x9x1', '1.00', '1.00', '3.50', 1, 6, 'READY FOR PICKUP', 21, NULL),
(8, 7, 7, 7, '9261290988245142113942', 24, '21X11X2', '4.00', '4.00', '10.00', 2, 7, 'DELIVERED', 24, '2020-09-16 13:54:12'),
(9, 8, 8, 8, NULL, 26, '11x9x8', '17.00', '6.00', '47.00', 1, 8, 'READY FOR PICKUP', 26, NULL),
(10, 7, 7, 7, '42033126299200190269849039683897', 27, '9x5x2', '1.00', '1.00', '3.00', 1, 7, 'READY FOR PICKUP', 27, NULL),
(11, 7, 7, 7, '42033126299261299992450421483715', 28, '8x7x6', '1.00', '3.00', '3.50', 1, 7, 'READY FOR PICKUP', 28, NULL),
(12, 7, 7, 7, '42033126299400111898658822907992', 29, '7x7x6', '1.00', '1.00', '3.50', 1, 7, 'READY FOR PICKUP', 29, NULL),
(13, 7, 7, 7, '1LS731603279945', 30, '15x12x5', '3.00', '6.00', '12.00', 1, 7, 'READY FOR PICKUP', 30, NULL),
(14, 7, 7, 7, '42033126299400110205958278275645', 31, '12x12x2', '1.00', '3.00', '3.50', 1, 7, 'READY FOR PICKUP', 31, NULL),
(15, 7, 7, 7, 'LY417188924CN', 32, '12x12x3', '2.00', '4.00', '5.00', 1, 7, 'READY FOR PICKUP', 32, NULL),
(16, 7, 7, 7, 'TBAMIA517491098', 15, '9x8x2', '1.00', '2.00', '3.50', 1, 7, 'READY FOR PICKUP', 15, NULL),
(17, 7, 7, 7, 'AS461740602CN', 33, '9x7x1', '1.00', '1.00', '3.50', 1, 7, 'READY FOR PICKUP', 33, NULL),
(18, 7, 7, 7, '14353001829260113-1308862-3292231', 34, '12x9x1', '1.00', '1.00', '3.50', 1, 7, 'READY FOR PICKUP', 34, NULL),
(19, 7, 7, 7, '42033126299261290217524106852103', 35, '9x8x6', '2.00', '4.00', '5.00', 1, 7, 'READY FOR PICKUP', 35, NULL),
(20, 7, 7, 7, 'TBAMIA517446671', 36, '10x7x6', '3.00', '4.00', '7.50', 1, 7, 'READY FOR PICKUP', 36, NULL),
(21, 7, 7, 7, '1001908741370003312600396642557478', 15, '15x10x2', '2.00', '3.00', '5.00', 1, 7, 'READY FOR PICKUP', 15, NULL),
(22, 9, 9, 9, '1Z8F0F910329377987', 21, '16X15X7', '3.00', '13.00', '17.25', 1, 9, 'READY FOR PICKUP', 21, NULL),
(23, 10, 10, 10, 'TBAMIA517494272', 39, '19x14x7', '2.00', '14.00', '15.50', 1, 10, 'READY FOR PICKUP', 39, NULL),
(24, 10, 10, 10, 'TBAMIA517501413', 44, '16x13x4', '2.00', '6.00', '9.50', 1, 10, 'READY FOR PICKUP', 44, NULL),
(25, 10, 10, 10, '1Z131Y530355297038', 45, '20x11x14', '22.00', '23.00', '72.25', 1, 10, 'READY FOR PICKUP', 45, NULL),
(26, 10, 10, 10, '420331262992748927005455000034587264', 46, '8x5x2', '1.00', '1.00', '3.50', 1, 10, 'READY FOR PICKUP', 46, NULL),
(27, 10, 10, 10, 'LB163326315SG', 47, '9x6x2', '2.00', '2.00', '5.00', 1, 10, 'READY FOR PICKUP', 47, NULL),
(28, 10, 10, 10, 'TBA143304397301', 33, '14x10x4', '3.00', '5.00', '11.25', 1, 10, 'READY FOR PICKUP', 33, NULL),
(29, 10, 10, 10, 'TBAMIA517442560', 20, '15x13x4', '3.00', '6.00', '12.00', 1, 10, 'READY FOR PICKUP', 20, NULL),
(30, 10, 10, 10, 'TBAMIA517432183', 44, '14x11x3', '1.00', '4.00', '3.50', 1, 10, 'READY FOR PICKUP', 44, NULL),
(31, 10, 10, 10, 'TBA144562047601', 48, '18x13x2', '1.00', '4.00', '3.50', 1, 10, 'READY FOR PICKUP', 48, NULL),
(32, 10, 10, 10, '9622001900008240201500396685263397', 49, '12x9x6', '7.00', '5.00', '21.25', 1, 10, 'READY FOR PICKUP', 49, NULL),
(33, 10, 10, 10, 'TBAMIA517505968', 21, '13x11x9', '2.00', '10.00', '12.50', 1, 10, 'READY FOR PICKUP', 21, NULL),
(34, 10, 10, 10, 'TBAMIA517480920', 50, '21x17x5', '4.00', '13.00', '19.75', 1, 10, 'READY FOR PICKUP', 50, NULL),
(35, 10, 10, 10, '42033126299361289677090489051835', 51, '18x9x9', '11.00', '5.00', '20.75', 1, 10, 'READY FOR PICKUP', 51, NULL),
(36, 10, 10, 10, 'TBAMIA517490778', 39, '33x18x3', '8.00', '13.00', '29.75', 1, 10, 'READY FOR PICKUP', 39, NULL),
(37, 10, 10, 10, '1ZRX95040395077188', 52, '14X8X5', '1.00', '5.00', '4.00', 1, 10, 'READY FOR PICKUP', 52, NULL),
(38, NULL, 1, NULL, '1ZRX9504039077188', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'READY FOR PICK UP', NULL, NULL),
(39, 10, 10, 10, '1ZRX9504039077188', NULL, NULL, NULL, NULL, NULL, NULL, 10, 'READY FOR PICK UP', NULL, NULL),
(40, 11, 11, 11, '1ZA015T20329362205', 33, '17x14x12', '31.00', '21.00', '93.25', 2, 11, 'READY FOR PICKUP', 33, NULL),
(41, 10, 10, 10, '1ZA015T20329359577', 33, '18x18x17', '54.00', '40.00', '165.00', 2, 10, 'READY FOR PICKUP', 33, NULL),
(42, 10, 10, 10, '1ZA602A80314274910', 15, '30x21x11', '14.00', '50.00', '72.50', 2, 10, 'READY FOR PICKUP', 15, NULL),
(43, 10, 10, 10, '42033126299261299998724340593775', 55, '20x12x6', '2.00', '11.00', '12.25', 2, 10, 'READY FOR PICKUP', 55, NULL),
(44, 10, 10, 10, 'TBAMIA517512576', 44, '12x9x7', '3.00', '6.00', '12.00', 2, 10, 'READY FOR PICKUP', 44, NULL),
(45, 12, 12, 12, 'TBAMIA517531813', 21, '18x14x9', '5.00', '17.00', '25.25', 1, 12, 'READY FOR PICKUP', 21, NULL),
(46, 13, 13, 13, '42033126299361289677090492561567', 21, '18x14x9', '4.00', '17.00', '22.75', 1, 13, 'READY FOR PICKUP', 21, NULL),
(47, 13, 13, 13, '42033126299405511899220208057120', 21, '12x12x9', '5.00', '10.00', '20.00', 1, 13, 'READY FOR PICKUP', 21, NULL),
(48, 13, 13, 13, '1Z8F0F910330194716', 21, '15x16x6', '4.00', '11.00', '18.25', 1, 13, 'READY FOR PICK UP', 21, NULL),
(49, 13, 13, 13, 'TBAMIA517542357', 21, '32x21x4', '2.00', '20.00', '20.00', 1, 13, 'READY FOR PICKUP', 21, NULL),
(50, 13, 13, 13, 'TBAMIA517546240', 51, '16x13x4', '2.00', '6.00', '9.50', 1, 13, 'READY FOR PICKUP', 51, NULL),
(51, 13, 13, 13, '42033126299400108205497285630209', 65, '4x3x2', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 65, NULL),
(52, 14, 14, 14, 'TBA143612332101', 44, '9x7x6', '1.00', '3.00', '3.50', 1, 14, 'READY FOR PICKUP', 44, NULL),
(53, 13, 13, 13, '42033126299505512940460254183841', 50, '14x13x4', '4.00', '6.00', '14.50', 1, 13, 'READY FOR PICKUP', 50, NULL),
(54, 13, 13, 13, 'TBAMIA517558151', 40, '16x14x1', '1.00', '2.00', '3.50', 1, 13, 'READY FOR PICKUP', 40, NULL),
(55, 13, 13, 13, 'TBAMIA517557553', 40, '18x13x1', '1.00', '2.00', '3.50', 1, 13, 'READY FOR PICKUP', 40, NULL),
(56, 15, 15, 15, 'UT665931951TH', 27, '4x5x1', '1.00', '1.00', '3.50', 1, 15, 'READY FOR PICKUP', 27, NULL),
(57, 13, 13, 13, 'TBAMIA517545138', 51, '14x9x1', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 51, NULL),
(58, 13, 13, 13, 'LY417189346CN', 32, '10x8x3', '1.00', '2.00', '3.50', 1, 13, 'READY FOR PICKUP', 32, NULL),
(59, 13, 13, 13, 'UT670566213TH', 66, '7x6x1', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 66, NULL),
(60, 13, 13, 13, '42033126299400136206394093116906', 67, '8x5x1', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 67, NULL),
(61, 16, 16, 16, 'NCC440407-498211', 24, '10X8X1', '1.00', '1.00', '3.50', 1, 16, 'READY FOR PICKUP', 24, NULL),
(62, 13, 13, 13, 'UA032263105BG', 32, '8X6X2', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 32, NULL),
(63, 13, 13, 13, 'EPPUS0012402691YQ', 42, '9x8x2', '1.00', '2.00', '3.50', 1, 13, 'READY FOR PICKUP', 42, NULL),
(64, 17, 17, 17, '420331269449008205497252211464', 24, '8x5x2', '1.00', '1.00', '3.50', 1, 17, 'READY FOR PICKUP', 24, NULL),
(65, 13, 13, 13, '42033126299400111899564857452484', 67, '7x6x1', '1.00', '1.00', '3.50', 1, 13, 'READY FOR PICKUP', 67, NULL),
(66, 18, 18, 18, '420331269449008205497252211464', 16, '7x7x1', '1.00', '1.00', '3.50', 1, 18, 'READY FOR PICKUP', 16, NULL),
(67, 19, 19, 19, '1LSCYJR0001U30F', 21, '13x10x3', '2.00', '3.00', '5.00', 1, 19, 'READY FOR PICKUP', 21, NULL),
(68, 13, 13, 13, 'TBAMIA517555721', 9, '14x8x2', '1.00', '2.00', '3.50', 1, 13, 'READY FOR PICKUP', 9, NULL),
(69, 13, 13, 13, '42033126299405511202555917979044', 68, '10x8x3', '2.00', '2.00', '5.00', 1, 13, 'READY FOR PICKUP', 68, NULL),
(70, 13, 13, 13, 'UT675835915TH', 42, '9x6x2', '1.00', '1.00', '2.00', 1, 13, 'READY FOR PICKUP', 42, NULL),
(71, 13, 13, 13, '42033126299361269903505464630478', 69, '14x13x4', '1.00', '6.00', '7.00', 1, 13, 'READY FOR PICKUP', 69, NULL),
(72, 13, 13, 13, '42033126299205590273562651185773', 70, '16x14x3', '2.00', '5.00', '7.75', 1, 13, 'READY FOR PICKUP', 70, NULL),
(73, 20, 20, 20, 'TBA149010242401', 45, '15x11x1', '1.00', '2.00', '3.50', 2, 20, 'READY FOR PICKUP', 45, NULL),
(74, 20, 20, 20, 'TBAMIA517578090', 74, '14x10x3', '1.00', '4.00', '3.50', 2, 20, 'READY FOR PICKUP', 74, NULL),
(75, 20, 20, 20, 'TBAMIA517578044', 74, '15x9x4', '1.00', '4.00', '3.50', 2, 20, 'READY FOR PICKUP', 74, NULL),
(76, 20, 20, 20, 'TBA149036467901', 45, '16x12x6', '6.00', '9.00', '21.75', 2, 20, 'READY FOR PICKUP', 45, NULL),
(77, 20, 20, 20, 'TBAMIA517590645', 75, '18x14x9', '6.00', '17.00', '27.75', 2, 20, 'READY FOR PICKUP', 75, NULL),
(78, 20, 20, 20, 'TBA148954721501', 75, '21x17x5', '11.00', '13.00', '37.25', 2, 20, 'READY FOR PICKUP', 75, NULL),
(79, 21, 21, 21, 'TBAMIA517512180', 44, '12x11x3', '1.00', '3.00', '3.50', 2, 21, 'READY FOR PICKUP', 44, NULL),
(80, 22, 22, 22, 'TBAMIA517505640', 44, '15x10x2', '1.00', '3.00', '3.50', 2, 22, 'READY FOR PICKUP', 44, NULL),
(81, 23, 23, 23, '420331269200190265114642825106', 44, '9x8x2', '1.00', '2.00', '3.50', 2, 23, 'READY FOR PICKUP', 44, NULL),
(82, 24, 24, 24, 'TBAMIA517516406', 44, '15x12x2', '1.00', '3.00', '3.50', 2, 24, 'READY FOR PICKUP', 44, NULL),
(83, 25, 25, 25, '420331269274892700976646313685', 21, '10x6x5', '1.00', '3.00', '3.50', 2, 25, 'READY FOR PICKUP', 21, NULL),
(84, 26, 26, 26, '420331269300120111405247688590', 21, '16x14x2', '1.00', '4.00', '3.50', 2, 26, 'READY FOR PICKUP', 21, NULL),
(85, 27, 27, 27, 'TBA147989224901', 21, '15x8x8', '4.00', '7.00', '15.25', 2, 27, 'READY FOR PICKUP', 21, NULL),
(86, 28, 28, 28, 'UY200630002058JL', 46, '6x4x1', '1.00', '1.00', '3.50', 2, 28, 'READY FOR PICKUP', 46, NULL),
(87, 29, 29, 29, 'UA319924720SB', 46, '6x6x1', '1.00', '1.00', '3.50', 2, 29, 'READY FOR PICKUP', 46, NULL),
(88, 30, 30, 30, 'LB174177317SG', 46, '7x5x1', '1.00', '1.00', '3.50', 2, 30, 'READY FOR PICKUP', 46, NULL),
(89, 31, 31, 31, '4203312692748927005455000039812910', 46, '10x7x4', '1.00', '2.00', '3.50', 2, 31, 'READY FOR PICKUP', 46, NULL),
(90, 32, 32, 32, 'TBAMIA517565554', 15, '13x10x5', '1.00', '5.00', '6.25', 2, 32, 'READY FOR PICKUP', 15, NULL),
(91, 33, 33, 33, 'TBAMIA517567554', 15, '15x11x1', '1.00', '2.00', '3.50', 2, 33, 'READY FOR PICKUP', 15, NULL),
(92, 34, 34, 34, '420331269400108205497264848984', 42, '8x7x1', '1.00', '1.00', '3.50', 2, 34, 'READY FOR PICKUP', 42, NULL),
(93, 35, 35, 35, 'TBAMIA517572604', 42, '15x12x1', '1.00', '2.00', '3.50', 2, 35, 'READY FOR PICKUP', 42, NULL),
(94, 36, 36, 36, '420331269374869903505447740435', 42, '9x7x1', '1.00', '1.00', '3.50', 2, 36, 'READY FOR PICKUP', 42, NULL),
(95, 37, 37, 37, 'NO TRAKING', 67, '10x7x3', '2.00', '2.00', '5.00', 2, 37, 'READY FOR PICKUP', 67, NULL),
(96, 38, 38, 38, '420331269205590273562652397168', 67, '12x11x3', '2.00', '3.00', '5.00', 2, 38, 'READY FOR PICKUP', 67, NULL),
(97, 39, 39, 39, '420331269200190221582757243362', 24, '18x3x3', '2.00', '2.00', '5.00', 2, 39, 'READY FOR PICKUP', 24, NULL),
(98, 40, 40, 40, '420331269200190265114643268469', 7, '9x8x5', '1.00', '3.00', '3.50', 2, 40, 'READY FOR PICKUP', 7, NULL),
(99, 41, 41, 41, '420331261049299200190137127250405163', 76, '7x6x4', '1.00', '2.00', '3.50', 2, 41, 'READY FOR PICKUP', 76, NULL),
(100, 42, 42, 42, '420331269400136206394083868983', 27, '5x5x3', '1.00', '2.00', '3.50', 2, 42, 'READY FOR PICKUP', 27, NULL),
(101, 43, 43, 43, '420331269400110205461035812903', 20, '9x6x1', '1.00', '2.00', '3.50', 2, 43, 'READY FOR PICKUP', 20, NULL),
(102, 44, 44, 44, 'UA317012436SB', 47, '6x5x1', '1.00', '1.00', '3.50', 2, 44, 'READY FOR PICKUP', 47, NULL),
(103, 45, 45, 45, 'TBA148633252001', 51, '9x8x1', '1.00', '2.00', '3.50', 2, 45, 'READY FOR PICKUP', 51, NULL),
(104, 46, 46, 46, '9622080430008290073700918061382474', 52, '12x8x8', '3.00', '9.00', '14.25', 2, 46, 'READY FOR PICKUP', 52, NULL),
(105, 47, 47, 47, '420331269400108205497286134218', 14, '14x10x5', '1.00', '6.00', '6.50', 2, 47, 'READY FOR PICKUP', 14, NULL),
(106, 48, 48, 48, '420331269400136206394084079784', 64, '11x12x3', '1.00', '2.00', '3.50', 2, 48, 'READY FOR PICKUP', 64, NULL),
(107, 49, 49, 49, 'RU799385590NL', 33, '9x8x2', '1.00', '2.00', '2.50', 2, 49, 'READY FOR PICKUP', 33, NULL),
(108, 50, 50, 50, '1Z455ER44234015533', 79, '22x17x9', '39.00', '25.00', '116.25', 1, 50, 'READY FOR PICKUP', 79, NULL),
(109, 50, 50, 50, '1Z045WV803580099', 25, '32x7x7', '15.00', '12.00', '46.50', 1, 50, 'READY FOR PICKUP', 25, NULL),
(110, 50, 50, 50, '1Z69664F0343950818', 15, '14x11x3', '2.00', '4.00', '5.00', 1, 50, 'READY FOR PICKUP', 15, NULL),
(111, 50, 50, 50, 'TBAMIA517602777', 44, '9x7x4', '2.00', '2.00', '5.00', 1, 50, 'READY FOR PICKUP', 44, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trackingcenter`
--

CREATE TABLE `trackingcenter` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Name` int(10) UNSIGNED NOT NULL,
  `Zone` int(10) UNSIGNED DEFAULT NULL,
  `Tracking` int(10) UNSIGNED NOT NULL,
  `Carrier` varchar(40) DEFAULT NULL,
  `Trackingurl` text DEFAULT NULL,
  `CustStatus` varchar(40) DEFAULT 'OPEN',
  `TRADEXXstatus` varchar(40) DEFAULT 'OPEN',
  `Freight` varchar(40) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type`
--

CREATE TABLE `type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'Negativo'),
(2, 'Postivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(10) UNSIGNED NOT NULL,
  `Warehouse` varchar(40) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Freight` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `warehouse`
--

INSERT INTO `warehouse` (`id`, `Warehouse`, `Date`, `Freight`) VALUES
(2, 'C438008/4', '2020-09-16', 'AIR FREIGHT'),
(3, 'C437966/1', '2020-09-16', 'AIR FREIGHT'),
(4, 'C438008/1', '2020-09-16', 'AIR FREIGHT'),
(5, 'C438008/3', '2020-09-16', 'AIR FREIGHT'),
(6, 'C438008/2', '2020-09-16', 'AIR FREIGHT'),
(7, 'C438467/1', '2020-09-16', 'AIR FREIGHT'),
(8, 'C438467/1', '2020-09-16', 'AIR FREIGHT'),
(9, 'C438578/1', '2020-09-17', 'AIR FREIGHT'),
(10, 'C439033/1', '2020-09-17', 'AIR FREIGHT'),
(11, 'C439674/1', '2020-09-18', NULL),
(12, 'C440743/1', '2020-09-22', 'AIR FREIGHT'),
(13, 'C440636/1', '2020-09-22', 'AIR FREIGHT'),
(14, 'C440162/1', '2020-09-22', 'AIR FREIGHT'),
(15, 'C440555/1', '2020-09-22', 'AIR FREIGHT'),
(16, 'C440407/1', '2020-09-22', 'AIR FREIGHT'),
(17, 'C440542/1', '2020-09-22', 'AIR FREIGHT'),
(18, 'C440223/1', '2020-09-22', 'AIR FREIGHT'),
(19, 'C441176/1', '2020-09-22', 'AIR FREIGHT'),
(20, 'C442417/1', '2020-09-24', 'AIR FREIGHT'),
(21, 'C441894/6', '2020-09-24', NULL),
(22, 'C441895/2', '2020-09-24', NULL),
(23, 'C441893/9', '2020-09-24', 'AIR FREIGHT'),
(24, 'C441894/4', '2020-09-24', NULL),
(25, 'C441895/7', '2020-09-24', 'AIR FREIGHT'),
(26, 'C441577/1', '2020-09-24', 'AIR FREIGHT'),
(27, 'C441895/8', '2020-09-24', 'AIR FREIGHT'),
(28, 'C441893/2', '2020-09-24', 'AIR FREIGHT'),
(29, 'C441893/4', '2020-09-24', 'AIR FREIGHT'),
(30, 'C441893/1', '2020-09-24', 'AIR FREIGHT'),
(31, 'C441895/1', '2020-09-24', 'AIR FREIGHT'),
(32, 'C441893/8', '2020-09-24', 'AIR FREIGHT'),
(33, 'C441894/5', '2020-09-24', 'AIR FREIGHT'),
(34, 'C441893/5', '2020-09-24', 'AIR FREIGHT'),
(35, 'C441893/7', '2020-09-24', 'AIR FREIGHT'),
(36, 'C441893/6', '2020-09-24', 'AIR FREIGHT'),
(37, 'C441895/3', '2020-09-24', 'AIR FREIGHT'),
(38, 'C441894/7', '2020-09-24', 'AIR FREIGHT'),
(39, 'C441895/4', '2020-09-24', 'AIR FREIGHT'),
(40, 'C441894/8', '2020-09-24', 'AIR FREIGHT'),
(41, 'C441895/5', '2020-09-24', 'AIR FREIGHT'),
(42, 'C441115/1', '2020-09-24', 'AIR FREIGHT'),
(43, 'C441893/10', '2020-09-24', 'AIR FREIGHT'),
(44, 'C441893/3', '2020-09-24', 'AIR FREIGHT'),
(45, 'C441893/11', '2020-09-24', 'AIR FREIGHT'),
(46, 'C441895/6', '2020-09-24', 'AIR FREIGHT'),
(47, 'C441894/3', '2020-09-24', 'AIR FREIGHT'),
(48, 'C441894/1', '2020-09-24', 'AIR FREIGHT'),
(49, 'C441894', '2020-09-24', 'AIR FREIGHT'),
(50, 'C442839/1', '2020-09-25', 'AIR FREIGHT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `whjournal`
--

CREATE TABLE `whjournal` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` date DEFAULT NULL,
  `Freightype` varchar(40) DEFAULT 'AIR FREIGHT',
  `Invoices` varchar(40) DEFAULT NULL,
  `Warehouse` varchar(40) DEFAULT NULL,
  `Tracking` varchar(40) DEFAULT NULL,
  `GroundFreight` text DEFAULT NULL,
  `Boxes` varchar(40) DEFAULT NULL,
  `Dimensions` varchar(40) DEFAULT NULL,
  `Volume` decimal(10,2) DEFAULT NULL,
  `Weight` decimal(10,2) DEFAULT NULL,
  `InternationalFreight` decimal(10,2) DEFAULT NULL,
  `LocalFreight` decimal(10,2) DEFAULT NULL,
  `Tip` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `whjournal`
--

INSERT INTO `whjournal` (`id`, `Date`, `Freightype`, `Invoices`, `Warehouse`, `Tracking`, `GroundFreight`, `Boxes`, `Dimensions`, `Volume`, `Weight`, `InternationalFreight`, `LocalFreight`, `Tip`, `Total`) VALUES
(1, '2020-09-16', 'AIR FREIGHT', NULL, 'C438008/3\r\nC438008/2\r\nC438008/1\r\nC437966', 'NCCC438008-495328\r\nTBAMIA517472211\r\nTBAM', NULL, '1', 'Caja 1  14x12x11 13.29V/7R', '13.29', '7.00', NULL, '8.00', '1.00', '0.00'),
(2, '2020-09-16', 'AIR FREIGHT', NULL, 'C438467/1', '420331269261290988245142113942\r\n42033126', '45666941153.Z344811Mw217526', '1 caja', 'Caja 1:  22x12x18  34.18/48R', '34.18', '48.00', NULL, '11.00', '1.00', '0.00'),
(3, '2020-09-17', 'AIR FREIGHT', NULL, 'C438578/1\r\nC439033/1', '1Z8F0F910329377987\r\nTBAMIA517480920\r\nTBA', NULL, '2 Cajas', '1 caja  16x15x7  12.08V/3R\r\n2 caja 41x29', '208.82', '82.50', NULL, '27.00', '1.00', '0.00'),
(4, '2020-09-18', 'AIR FREIGHT', NULL, 'C439674/1', 'TBAMIA517512576\r\n1ZA015T20329359577\r\n1ZA', NULL, '1', '39x31x27', '234.84', '114.00', NULL, '25.00', '1.00', '0.00'),
(5, '2020-09-22', 'AIR FREIGHT', NULL, 'Consolidado: C440636/1\r\nC440555/1\r\nC4405', 'Consolidado:\r\n42033126299405511202555917', NULL, '2 cajas', 'caja 1 : 40x29x14     117.00V/35R\r\ncaja', '2.00', NULL, NULL, '12.00', '1.00', '0.00'),
(6, '2020-09-24', 'AIR FREIGHT', NULL, 'TRADEXX, [24.09.20 12:03]\r\nConsolidado: ', 'Consolidado\r\nTBAMIA517590645\r\nTBA1489547', NULL, '2 cajas', 'Caja 1 : 21x16x19    V45.92/21R\r\nCaja 2', '98.40', '41.00', NULL, '13.00', '1.00', '0.00'),
(7, '2020-09-25', 'AIR FREIGHT', NULL, 'C442839/1', '1Z455ER44234015533\r\n1Z045WV80358009933\r\n', NULL, '1 caja', '41x29x11 94.09V/74.5R', '94.09', '74.50', NULL, '15.00', '1.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura para la vista `sql_view_sales`
--
DROP TABLE IF EXISTS `sql_view_sales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sql_view_sales`  AS  select `invoice`.`id` AS `id`,`products`.`item` AS `item`,`invoice`.`PaymentStatus` AS `PaymentStatus`,`invoice`.`usrAdd` AS `usrAdd`,`invoice`.`Status` AS `Status` from ((`invoice` left join `invoicedetails` on(`invoicedetails`.`invoice` = `invoice`.`id`)) left join `products` on(`products`.`id` = `invoicedetails`.`product`)) where `invoice`.`type` = 'Invoice' order by `invoice`.`id` desc limit 10 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterAccount` (`masterAccount`);

--
-- Indices de la tabla `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_acount` (`master_acount`),
  ADD KEY `account` (`account`),
  ADD KEY `sub_account` (`sub_account`),
  ADD KEY `type` (`type`),
  ADD KEY `invoice` (`invoice`),
  ADD KEY `account_plan` (`account_plan`);

--
-- Indices de la tabla `accountplan`
--
ALTER TABLE `accountplan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_account` (`master_account`),
  ADD KEY `account` (`account`),
  ADD KEY `sub_account` (`sub_account`),
  ADD KEY `type` (`type`);

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Assigned` (`Assigned`);

--
-- Indices de la tabla `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`);

--
-- Indices de la tabla `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cc`
--
ALTER TABLE `cc`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ccjournal`
--
ALTER TABLE `ccjournal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Card` (`Card`),
  ADD KEY `Logged` (`Logged`);

--
-- Indices de la tabla `ceo`
--
ALTER TABLE `ceo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Department` (`Department`);

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Province` (`Province`);

--
-- Indices de la tabla `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Warehouse` (`Warehouse`),
  ADD KEY `Tracking` (`Tracking`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Employee` (`Employee`),
  ADD KEY `Description` (`Description`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `crm`
--
ALTER TABLE `crm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Assigned` (`Assigned`);

--
-- Indices de la tabla `customerauto`
--
ALTER TABLE `customerauto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Brand` (`Brand`),
  ADD KEY `Model` (`Model`);

--
-- Indices de la tabla `customerclass`
--
ALTER TABLE `customerclass`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Type` (`Type`),
  ADD KEY `City` (`City`),
  ADD KEY `Province` (`Province`),
  ADD KEY `Country` (`Country`);

--
-- Indices de la tabla `databaseauto`
--
ALTER TABLE `databaseauto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Brand` (`Brand`),
  ADD KEY `Model` (`Model`),
  ADD KEY `System` (`System`),
  ADD KEY `Part` (`Part`);

--
-- Indices de la tabla `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `generaldb`
--
ALTER TABLE `generaldb`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `related` (`related`);

--
-- Indices de la tabla `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`invoice`),
  ADD KEY `product` (`product`);

--
-- Indices de la tabla `losses`
--
ALTER TABLE `losses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`);

--
-- Indices de la tabla `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Department` (`Department`);

--
-- Indices de la tabla `masteraccount`
--
ALTER TABLE `masteraccount`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `membership_grouppermissions`
--
ALTER TABLE `membership_grouppermissions`
  ADD PRIMARY KEY (`permissionID`),
  ADD UNIQUE KEY `groupID_tableName` (`groupID`,`tableName`);

--
-- Indices de la tabla `membership_groups`
--
ALTER TABLE `membership_groups`
  ADD PRIMARY KEY (`groupID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `membership_userpermissions`
--
ALTER TABLE `membership_userpermissions`
  ADD PRIMARY KEY (`permissionID`),
  ADD UNIQUE KEY `memberID_tableName` (`memberID`,`tableName`);

--
-- Indices de la tabla `membership_userrecords`
--
ALTER TABLE `membership_userrecords`
  ADD PRIMARY KEY (`recID`),
  ADD UNIQUE KEY `tableName_pkValue` (`tableName`,`pkValue`(150)),
  ADD KEY `pkValue` (`pkValue`),
  ADD KEY `tableName` (`tableName`),
  ADD KEY `memberID` (`memberID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indices de la tabla `membership_users`
--
ALTER TABLE `membership_users`
  ADD PRIMARY KEY (`memberID`),
  ADD KEY `groupID` (`groupID`);

--
-- Indices de la tabla `membership_usersessions`
--
ALTER TABLE `membership_usersessions`
  ADD UNIQUE KEY `memberID_token_agent` (`memberID`,`token`,`agent`),
  ADD KEY `memberID` (`memberID`),
  ADD KEY `expiry_ts` (`expiry_ts`);

--
-- Indices de la tabla `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Brand` (`Brand`);

--
-- Indices de la tabla `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `System` (`System`);

--
-- Indices de la tabla `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee` (`employee`);

--
-- Indices de la tabla `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Department` (`Department`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Country` (`Country`);

--
-- Indices de la tabla `receivable`
--
ALTER TABLE `receivable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Assigned` (`Assigned`);

--
-- Indices de la tabla `retention`
--
ALTER TABLE `retention`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Assigned` (`Assigned`);

--
-- Indices de la tabla `return`
--
ALTER TABLE `return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Warehouse` (`Warehouse`),
  ADD KEY `Tracking` (`Tracking`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `City` (`City`),
  ADD KEY `Province` (`Province`),
  ADD KEY `Country` (`Country`),
  ADD KEY `Department` (`Department`),
  ADD KEY `Position` (`Position`),
  ADD KEY `Supervisor` (`Supervisor`),
  ADD KEY `Manager` (`Manager`),
  ADD KEY `Director` (`Director`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Invoice` (`Invoice`),
  ADD KEY `Tracking` (`Tracking`);

--
-- Indices de la tabla `subaccount`
--
ALTER TABLE `subaccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account` (`account`);

--
-- Indices de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Customer` (`Customer`);

--
-- Indices de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Department` (`Department`);

--
-- Indices de la tabla `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Warehouse` (`Warehouse`),
  ADD KEY `Customer` (`Customer`),
  ADD KEY `Employee` (`Employee`);

--
-- Indices de la tabla `trackingcenter`
--
ALTER TABLE `trackingcenter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Name` (`Name`),
  ADD KEY `Tracking` (`Tracking`);

--
-- Indices de la tabla `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `whjournal`
--
ALTER TABLE `whjournal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `accountplan`
--
ALTER TABLE `accountplan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `alert`
--
ALTER TABLE `alert`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cc`
--
ALTER TABLE `cc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ccjournal`
--
ALTER TABLE `ccjournal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ceo`
--
ALTER TABLE `ceo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `claim`
--
ALTER TABLE `claim`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `crm`
--
ALTER TABLE `crm`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `customerauto`
--
ALTER TABLE `customerauto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `customerclass`
--
ALTER TABLE `customerclass`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `databaseauto`
--
ALTER TABLE `databaseauto`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `generaldb`
--
ALTER TABLE `generaldb`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `losses`
--
ALTER TABLE `losses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `masteraccount`
--
ALTER TABLE `masteraccount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `membership_grouppermissions`
--
ALTER TABLE `membership_grouppermissions`
  MODIFY `permissionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2378;

--
-- AUTO_INCREMENT de la tabla `membership_groups`
--
ALTER TABLE `membership_groups`
  MODIFY `groupID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `membership_userpermissions`
--
ALTER TABLE `membership_userpermissions`
  MODIFY `permissionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `membership_userrecords`
--
ALTER TABLE `membership_userrecords`
  MODIFY `recID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;

--
-- AUTO_INCREMENT de la tabla `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `part`
--
ALTER TABLE `part`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `position`
--
ALTER TABLE `position`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `province`
--
ALTER TABLE `province`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `receivable`
--
ALTER TABLE `receivable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retention`
--
ALTER TABLE `retention`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `return`
--
ALTER TABLE `return`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subaccount`
--
ALTER TABLE `subaccount`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `system`
--
ALTER TABLE `system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `trackingcenter`
--
ALTER TABLE `trackingcenter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `whjournal`
--
ALTER TABLE `whjournal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
