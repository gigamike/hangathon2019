-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2019 at 11:05 PM
-- Server version: 5.7.26
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hangathon2019`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Parañaque City'),
(2, 'Pasay City'),
(3, 'Navotas City'),
(4, 'Muntinlupa City');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` char(2) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_code`, `country_name`) VALUES
(1, 'A1', 'Anonymous Proxy'),
(2, 'A2', 'Satellite Provider'),
(3, 'O1', 'Other Country'),
(4, 'AD', 'Andorra'),
(5, 'AE', 'United Arab Emirates'),
(6, 'AF', 'Afghanistan'),
(7, 'AG', 'Antigua and Barbuda'),
(8, 'AI', 'Anguilla'),
(9, 'AL', 'Albania'),
(10, 'AM', 'Armenia'),
(11, 'AO', 'Angola'),
(12, 'AP', 'Asia/Pacific Region'),
(13, 'AQ', 'Antarctica'),
(14, 'AR', 'Argentina'),
(15, 'AS', 'American Samoa'),
(16, 'AT', 'Austria'),
(17, 'AU', 'Australia'),
(18, 'AW', 'Aruba'),
(19, 'AX', 'Aland Islands'),
(20, 'AZ', 'Azerbaijan'),
(21, 'BA', 'Bosnia and Herzegovina'),
(22, 'BB', 'Barbados'),
(23, 'BD', 'Bangladesh'),
(24, 'BE', 'Belgium'),
(25, 'BF', 'Burkina Faso'),
(26, 'BG', 'Bulgaria'),
(27, 'BH', 'Bahrain'),
(28, 'BI', 'Burundi'),
(29, 'BJ', 'Benin'),
(30, 'BL', 'Saint Bartelemey'),
(31, 'BM', 'Bermuda'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BO', 'Bolivia'),
(34, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(35, 'BR', 'Brazil'),
(36, 'BS', 'Bahamas'),
(37, 'BT', 'Bhutan'),
(38, 'BV', 'Bouvet Island'),
(39, 'BW', 'Botswana'),
(40, 'BY', 'Belarus'),
(41, 'BZ', 'Belize'),
(42, 'CA', 'Canada'),
(43, 'CC', 'Cocos (Keeling) Islands'),
(44, 'CD', 'Congo, The Democratic Republic of the'),
(45, 'CF', 'Central African Republic'),
(46, 'CG', 'Congo'),
(47, 'CH', 'Switzerland'),
(48, 'CI', 'Cote d\'Ivoire'),
(49, 'CK', 'Cook Islands'),
(50, 'CL', 'Chile'),
(51, 'CM', 'Cameroon'),
(52, 'CN', 'China'),
(53, 'CO', 'Colombia'),
(54, 'CR', 'Costa Rica'),
(55, 'CU', 'Cuba'),
(56, 'CV', 'Cape Verde'),
(57, 'CW', 'Curacao'),
(58, 'CX', 'Christmas Island'),
(59, 'CY', 'Cyprus'),
(60, 'CZ', 'Czech Republic'),
(61, 'DE', 'Germany'),
(62, 'DJ', 'Djibouti'),
(63, 'DK', 'Denmark'),
(64, 'DM', 'Dominica'),
(65, 'DO', 'Dominican Republic'),
(66, 'DZ', 'Algeria'),
(67, 'EC', 'Ecuador'),
(68, 'EE', 'Estonia'),
(69, 'EG', 'Egypt'),
(70, 'EH', 'Western Sahara'),
(71, 'ER', 'Eritrea'),
(72, 'ES', 'Spain'),
(73, 'ET', 'Ethiopia'),
(74, 'EU', 'Europe'),
(75, 'FI', 'Finland'),
(76, 'FJ', 'Fiji'),
(77, 'FK', 'Falkland Islands (Malvinas)'),
(78, 'FM', 'Micronesia, Federated States of'),
(79, 'FO', 'Faroe Islands'),
(80, 'FR', 'France'),
(81, 'GA', 'Gabon'),
(82, 'GB', 'United Kingdom'),
(83, 'GD', 'Grenada'),
(84, 'GE', 'Georgia'),
(85, 'GF', 'French Guiana'),
(86, 'GG', 'Guernsey'),
(87, 'GH', 'Ghana'),
(88, 'GI', 'Gibraltar'),
(89, 'GL', 'Greenland'),
(90, 'GM', 'Gambia'),
(91, 'GN', 'Guinea'),
(92, 'GP', 'Guadeloupe'),
(93, 'GQ', 'Equatorial Guinea'),
(94, 'GR', 'Greece'),
(95, 'GS', 'South Georgia and the South Sandwich Islands'),
(96, 'GT', 'Guatemala'),
(97, 'GU', 'Guam'),
(98, 'GW', 'Guinea-Bissau'),
(99, 'GY', 'Guyana'),
(100, 'HK', 'Hong Kong'),
(101, 'HM', 'Heard Island and McDonald Islands'),
(102, 'HN', 'Honduras'),
(103, 'HR', 'Croatia'),
(104, 'HT', 'Haiti'),
(105, 'HU', 'Hungary'),
(106, 'ID', 'Indonesia'),
(107, 'IE', 'Ireland'),
(108, 'IL', 'Israel'),
(109, 'IM', 'Isle of Man'),
(110, 'IN', 'India'),
(111, 'IO', 'British Indian Ocean Territory'),
(112, 'IQ', 'Iraq'),
(113, 'IR', 'Iran, Islamic Republic of'),
(114, 'IS', 'Iceland'),
(115, 'IT', 'Italy'),
(116, 'JE', 'Jersey'),
(117, 'JM', 'Jamaica'),
(118, 'JO', 'Jordan'),
(119, 'JP', 'Japan'),
(120, 'KE', 'Kenya'),
(121, 'KG', 'Kyrgyzstan'),
(122, 'KH', 'Cambodia'),
(123, 'KI', 'Kiribati'),
(124, 'KM', 'Comoros'),
(125, 'KN', 'Saint Kitts and Nevis'),
(126, 'KP', 'Korea, Democratic People\'s Republic of'),
(127, 'KR', 'Korea, Republic of'),
(128, 'KW', 'Kuwait'),
(129, 'KY', 'Cayman Islands'),
(130, 'KZ', 'Kazakhstan'),
(131, 'LA', 'Lao People\'s Democratic Republic'),
(132, 'LB', 'Lebanon'),
(133, 'LC', 'Saint Lucia'),
(134, 'LI', 'Liechtenstein'),
(135, 'LK', 'Sri Lanka'),
(136, 'LR', 'Liberia'),
(137, 'LS', 'Lesotho'),
(138, 'LT', 'Lithuania'),
(139, 'LU', 'Luxembourg'),
(140, 'LV', 'Latvia'),
(141, 'LY', 'Libyan Arab Jamahiriya'),
(142, 'MA', 'Morocco'),
(143, 'MC', 'Monaco'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'ME', 'Montenegro'),
(146, 'MF', 'Saint Martin'),
(147, 'MG', 'Madagascar'),
(148, 'MH', 'Marshall Islands'),
(149, 'MK', 'Macedonia'),
(150, 'ML', 'Mali'),
(151, 'MM', 'Myanmar'),
(152, 'MN', 'Mongolia'),
(153, 'MO', 'Macao'),
(154, 'MP', 'Northern Mariana Islands'),
(155, 'MQ', 'Martinique'),
(156, 'MR', 'Mauritania'),
(157, 'MS', 'Montserrat'),
(158, 'MT', 'Malta'),
(159, 'MU', 'Mauritius'),
(160, 'MV', 'Maldives'),
(161, 'MW', 'Malawi'),
(162, 'MX', 'Mexico'),
(163, 'MY', 'Malaysia'),
(164, 'MZ', 'Mozambique'),
(165, 'NA', 'Namibia'),
(166, 'NC', 'New Caledonia'),
(167, 'NE', 'Niger'),
(168, 'NF', 'Norfolk Island'),
(169, 'NG', 'Nigeria'),
(170, 'NI', 'Nicaragua'),
(171, 'NL', 'Netherlands'),
(172, 'NO', 'Norway'),
(173, 'NP', 'Nepal'),
(174, 'NR', 'Nauru'),
(175, 'NU', 'Niue'),
(176, 'NZ', 'New Zealand'),
(177, 'OM', 'Oman'),
(178, 'PA', 'Panama'),
(179, 'PE', 'Peru'),
(180, 'PF', 'French Polynesia'),
(181, 'PG', 'Papua New Guinea'),
(182, 'PH', 'Philippines'),
(183, 'PK', 'Pakistan'),
(184, 'PL', 'Poland'),
(185, 'PM', 'Saint Pierre and Miquelon'),
(186, 'PN', 'Pitcairn'),
(187, 'PR', 'Puerto Rico'),
(188, 'PS', 'Palestinian Territory'),
(189, 'PT', 'Portugal'),
(190, 'PW', 'Palau'),
(191, 'PY', 'Paraguay'),
(192, 'QA', 'Qatar'),
(193, 'RE', 'Reunion'),
(194, 'RO', 'Romania'),
(195, 'RS', 'Serbia'),
(196, 'RU', 'Russian Federation'),
(197, 'RW', 'Rwanda'),
(198, 'SA', 'Saudi Arabia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SC', 'Seychelles'),
(201, 'SD', 'Sudan'),
(202, 'SE', 'Sweden'),
(203, 'SG', 'Singapore'),
(204, 'SH', 'Saint Helena'),
(205, 'SI', 'Slovenia'),
(206, 'SJ', 'Svalbard and Jan Mayen'),
(207, 'SK', 'Slovakia'),
(208, 'SL', 'Sierra Leone'),
(209, 'SM', 'San Marino'),
(210, 'SN', 'Senegal'),
(211, 'SO', 'Somalia'),
(212, 'SR', 'Suriname'),
(213, 'SS', 'South Sudan'),
(214, 'ST', 'Sao Tome and Principe'),
(215, 'SV', 'El Salvador'),
(216, 'SX', 'Sint Maarten'),
(217, 'SY', 'Syrian Arab Republic'),
(218, 'SZ', 'Swaziland'),
(219, 'TC', 'Turks and Caicos Islands'),
(220, 'TD', 'Chad'),
(221, 'TF', 'French Southern Territories'),
(222, 'TG', 'Togo'),
(223, 'TH', 'Thailand'),
(224, 'TJ', 'Tajikistan'),
(225, 'TK', 'Tokelau'),
(226, 'TL', 'Timor-Leste'),
(227, 'TM', 'Turkmenistan'),
(228, 'TN', 'Tunisia'),
(229, 'TO', 'Tonga'),
(230, 'TR', 'Turkey'),
(231, 'TT', 'Trinidad and Tobago'),
(232, 'TV', 'Tuvalu'),
(233, 'TW', 'Taiwan'),
(234, 'TZ', 'Tanzania, United Republic of'),
(235, 'UA', 'Ukraine'),
(236, 'UG', 'Uganda'),
(237, 'UM', 'United States Minor Outlying Islands'),
(238, 'US', 'United States'),
(239, 'UY', 'Uruguay'),
(240, 'UZ', 'Uzbekistan'),
(241, 'VA', 'Holy See (Vatican City State)'),
(242, 'VC', 'Saint Vincent and the Grenadines'),
(243, 'VE', 'Venezuela'),
(244, 'VG', 'Virgin Islands, British'),
(245, 'VI', 'Virgin Islands, U.S.'),
(246, 'VN', 'Vietnam'),
(247, 'VU', 'Vanuatu'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'WS', 'Samoa'),
(250, 'YE', 'Yemen'),
(251, 'YT', 'Mayotte'),
(252, 'ZA', 'South Africa'),
(253, 'ZM', 'Zambia'),
(254, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `city_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `address`, `city_id`) VALUES
(1, 'Medical Center Paranaque', 'Dr. A. Santos Avenue, Sucat Road', 1),
(2, 'Olivarez General Hospital', 'Dr. A. Santos Avenue, Sucat Road', 1),
(3, 'Ospital ng Parañaque', 'Quirino Avenue, La Huerta', 1),
(4, 'Our Lady of Peace Hospital', 'Coastal Road, San Dionisio', 1),
(5, 'Protacio Medical Services', 'Quirino Avenue, Tambo', 1),
(6, 'South Superhighway Medical Center', 'West Service Road, South Superhighway', 1),
(7, 'Sta. Rita de Baclaran Hospital', 'G. Cruz Street, Baclaran', 1),
(8, 'Sto. Niño de Cebu Maternity Hospital', 'Sucat Road', 1),
(9, 'UHBI - Parañaque Doctors\' Hospital', 'Doña Soledad Avenue, Better Living Subdivision', 1),
(10, 'Unihealth Paranaque Hospital and Medical Center', 'Dr. A. Santos Avenue, Sucat Road (front of San Antonio Valley 1 Village)', 1),
(11, 'Adventist Medical Center Manila', 'Donada Street', 2),
(12, 'Pasay City General Hospital', 'P. Burgos Street', 2),
(13, 'Philippine Air Force General Hospital', 'Villamor Airbase', 2),
(14, 'San Juan De Dios Hospital', 'Roxas Boulevard', 2),
(15, 'Cabo-Calbadores Medical Center', 'Malibay Street', 2),
(16, 'Bagong Lipunan Health Center', 'Los Martires Street, San Jose', 3),
(17, 'Bagumbayan North Health Center', 'Bagumbayan North', 3),
(18, 'Bangkulasi Health Center', 'Alpha Street, Bangkulasi', 3),
(19, 'Kaunlaran Village Health Center', 'Bagus, North Bay Boulevard', 3),
(20, 'Linchangco/North Bay Health Center', 'North Bay Boulevard', 3),
(21, 'Navotas Emergency and Lying-in Clinic', 'M. Naval Street, San Jose', 3),
(22, 'Saint Joseph Maternity and Medical Clinic', 'M. Naval Street, San Jose', 3),
(23, 'San Roque Health Center', 'Gov. Pascual Street', 3),
(24, 'Tangos Health Center', 'Tangos', 3),
(25, 'Tanza Health Center', 'Rodriguez Street, Tanza', 3),
(26, 'Navotas City Hospital', 'M. Naval St, Navotas', 3),
(27, 'Alabang Medical Center', 'Alabang–Zapote Road', 4),
(28, 'Alabang Medical Clinic-Muntinlupa Branch', 'National Highway, Putatan', 4),
(29, 'Asian Hospital and Medical Center', 'Civic Drive, Filinvest City, Alabang', 4),
(30, 'Babaran-Echavez Medical and Psychiatric Clinic', 'Amparo Street, Poblacion', 4),
(31, 'Beato Cauilan Hospital', 'Villa Carolina, National Highway', 4),
(32, 'Clinic Systems, Inc.', 'Montillano Street, Alabang', 4),
(33, 'League of Government Information Practitioners of the Philippines, Inc.', 'Alabang', 4),
(34, 'Medical Center Muntinlupa', 'National Road, Putatan', 4),
(35, 'New Bilibid Prisons Hospital', 'Bureau of Corrections', 4),
(36, 'Ospital ng Muntinlupa', 'Filinvest Civic Drive, Filinvest City, Alabang', 4),
(37, 'Research Institute for Tropical Medicine', 'Filinvest City, Alabang', 4),
(38, 'San Roque Medical Clinic', 'Montillano Street, Alabang', 4);

-- --------------------------------------------------------

--
-- Table structure for table `incentive`
--

CREATE TABLE `incentive` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `height_centimeters` decimal(10,2) NOT NULL,
  `weight_kilograms` decimal(10,2) NOT NULL,
  `bmi` decimal(10,2) NOT NULL,
  `bmi_category` varchar(255) NOT NULL,
  `incentive` decimal(10,2) DEFAULT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user_id` bigint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `incentive`
--

INSERT INTO `incentive` (`id`, `height_centimeters`, `weight_kilograms`, `bmi`, `bmi_category`, `incentive`, `created_datetime`, `created_user_id`) VALUES
(2, '142.00', '58.00', '28.76', 'overweight', '0.00', '2019-08-30 22:13:54', 4),
(6, '142.00', '58.00', '28.76', 'overweight', '10.00', '2019-10-30 23:54:09', 4),
(7, '142.00', '50.00', '24.80', 'normal weight', '10.00', '2019-11-12 09:45:25', 4);

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `public_address` varchar(255) NOT NULL,
  `smart_contract_key` bigint(20) UNSIGNED NOT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medical_record`
--

INSERT INTO `medical_record` (`id`, `public_address`, `smart_contract_key`, `created_datetime`) VALUES
(1, '', 0, '0000-00-00 00:00:00'),
(2, '', 0, '0000-00-00 00:00:00'),
(3, '', 0, '0000-00-00 00:00:00'),
(4, '', 0, '0000-00-00 00:00:00'),
(5, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext,
  `price` decimal(10,2) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user_id` bigint(10) UNSIGNED NOT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `modified_user_id` bigint(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `created_datetime`, `created_user_id`, `modified_datetime`, `modified_user_id`) VALUES
(1, 'Zykast', 'ZYKAST /10/5MG /TAB / 30 / 30', '300.00', '0000-00-00 00:00:00', 0, NULL, NULL),
(2, 'Esomeprazole Magnesium', '10/5MG /TAB / 30 / 30', '500.00', '0000-00-00 00:00:00', 0, NULL, NULL),
(3, 'Mometamax', 'Mometamax Otic Suspension is available in 7.5 g, 15 g, 30 g and 215 g plastic bottles.', '1000.00', '0000-00-00 00:00:00', 0, NULL, NULL),
(4, 'Zegen', 'Cefuroxime (as axetil) 250 mg or 500 mg', '550.00', '0000-00-00 00:00:00', 0, NULL, NULL),
(5, 'Acyclovir ', 'Ointment', '1150.00', '0000-00-00 00:00:00', 0, NULL, NULL),
(6, 'Paracetamol & Caffeine 500/65', '10 Tablets', '150.00', '0000-00-00 00:00:00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','doctor','patient') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('m','f') NOT NULL,
  `city` varchar(255) NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `birth_date` date NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `public_address` varchar(255) DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` enum('N','Y') NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user_id` bigint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `city`, `country_id`, `birth_date`, `title`, `public_address`, `salt`, `active`, `created_datetime`, `created_user_id`) VALUES
(2, 'doctor', 'doctor2@gigamike.net', '90010c4b1a1e564db3f6c2227444f613', 'Joel', 'Solante', 'Solante', 'm', 'Quezon City', 182, '2004-10-20', 'General Doctor', '0x1786fc9201aaa0f5a58e3b1299db3df4577fe7f9', 'os)X%.*zo_v!g!W<QUSL=uI=4YYu%\\kWI;!Tbao.S)j~`L3{_i', 'Y', '2019-10-27 09:14:48', 0),
(3, 'doctor', 'doctor1@gigamike.net', '57508be5bf047462633fc22637ce3e85', 'Amah', 'Santiago', 'Buenaventura', 'f', 'Rizal', 182, '1986-10-08', 'General Internist', '0xd21361f7EeA74e7a8b7EC9eFCC9d78fD7157E453', '{^Z?H(/4KE+`tDLpC}~wBIvP6uFGtF,XRA2%PT+s\\N{Pm,@=tD', 'Y', '2019-10-27 09:16:59', 0),
(4, 'patient', 'patient@gigamike.net', '57508be5bf047462633fc22637ce3e85', 'Mik', 'Tupas', 'Galon', 'm', 'Paranaque City', 182, '1981-07-29', 'Programmer', '0xfdE49d3002F2BBA94182Ad274C7cA58C518AF1ca', '{^Z?H(/4KE+`tDLpC}~wBIvP6uFGtF,XRA2%PT+s\\N{Pm,@=tD', 'Y', '2019-10-27 09:18:07', 0),
(5, 'doctor', 'doctor3@gigamike.net', '14a1c250769fb1cb4ffa194aad287d62', 'Tom', 'Chua', 'Chua', 'm', 'Angono', 182, '1987-10-06', 'General Physician', '0xa1ed5b440b9d583406cbdcdc18d16666d34fdd47', ':N8{Q0P6#C\'F`lOaVK&X<AoPaT9[5YP,``[5lN>nwnKM%OTonJ', 'Y', '2019-10-27 23:43:57', 0),
(6, 'doctor', 'doctor4@gigamike.net', '091a6292a517bd0b007ba4d161567c19', 'Ace Mark', 'Llentada', 'Llentada', 'm', 'Bulacan', 182, '1983-10-03', 'General Pediatrics', '0xd42d8866324121df1b35132112484ab33302a7b6', '~+CU-t<!}na*RW]+*a.m.U&!P[G2>wP8p:EL=fQ\\ajWJL3(dnF', 'Y', '2019-10-27 23:45:34', 0),
(7, 'patient', 'patient2@gigamike.net', 'd4b15d22a59e3d948abb13d1bfe9101d', 'Justin', 'Ryo', 'Jaudines', 'm', 'Quezon City', 182, '1986-06-17', 'Frontend Dev', '0xee44806368cea5d3fe82604092beef96b871fc37', 'Xn%>;Km*>usy%.bIO|s>gP`Z5JNv3-s#iZ:n2p+ped|<V;#ES{', 'Y', '2019-10-30 12:31:37', 0),
(8, 'doctor', 'doctor5@gigamike.net', 'f14eb3fe8a7a525bfa6ed44c0dc19757', 'Von', 'Payumo', 'Payumo', 'm', 'Laguna', 182, '1973-06-19', 'General Pediatrics', '0x9885Bc63e79A66c104dc115DBB345164a54CB708', '=Rw>JzQS-Hs5RC\"_UUoc%et.j9)*lhCcb6WtWvt.8h\"CTd6X7m', 'Y', '2019-10-30 12:42:02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `incentive`
--
ALTER TABLE `incentive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_datetime` (`created_datetime`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `smart_contract_id` (`smart_contract_key`),
  ADD KEY `public_address` (`public_address`),
  ADD KEY `created_datetime` (`created_datetime`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_user_id` (`created_user_id`),
  ADD KEY `price` (`price`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `role` (`role`),
  ADD KEY `public_address` (`public_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `incentive`
--
ALTER TABLE `incentive`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
