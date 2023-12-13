-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 13 dec 2023 om 14:55
-- Serverversie: 5.7.40
-- PHP-versie: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_sharing_platform`
--
CREATE DATABASE IF NOT EXISTS `recipe_sharing_platform` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `recipe_sharing_platform`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Voorgerechten'),
(2, 'Soepen'),
(3, 'Salades'),
(4, 'Hoofdgerechten'),
(5, 'Bijgerechten'),
(6, 'Ontbijt'),
(7, 'Brunch'),
(8, 'Lunch'),
(9, 'Diner'),
(10, 'Snacks'),
(11, 'Desserts'),
(12, 'Bakken'),
(13, 'Grillen'),
(14, 'Roosteren'),
(15, 'Slowcooker'),
(16, 'Eénpansgerechten'),
(17, 'Roerbakgerechten'),
(18, 'Pastagerechten'),
(19, 'Rijstgerechten'),
(20, 'Ovenschotels'),
(21, 'Vegetarisch'),
(22, 'Veganistisch'),
(23, 'Glutenvrij'),
(24, 'Lactosevrij'),
(25, 'Keto'),
(26, 'Paleo'),
(27, 'Mediterraans'),
(28, 'Aziatisch'),
(29, 'Mexicaans'),
(30, 'Italiaans'),
(31, 'Amerikaans'),
(32, 'Indiaas'),
(33, 'Midden-Oosters'),
(34, 'Barbecue'),
(35, 'Visgerechten'),
(36, 'Kip'),
(37, 'Rundvlees'),
(38, 'Varkensvlees'),
(39, 'Lamsvlees'),
(40, 'Kalkoen'),
(41, 'Soep en Stoofpot'),
(42, 'Broodjes en Wraps'),
(43, 'Pizza'),
(44, 'Fingerfood'),
(45, 'Feestsnacks'),
(46, 'Feestrecepten'),
(47, 'Comfortfood'),
(48, 'Gezonde Recepten'),
(49, 'Snel en Makkelijk');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` int(1) NOT NULL,
  `users_id` int(11) NOT NULL,
  `recipes_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`users_id`),
  KEY `fk_comments_recipes1_idx` (`recipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `timestamp`, `rating`, `users_id`, `recipes_id`) VALUES
(5, 'test', '2023-11-28 09:27:35', 4, 2, 8),
(6, 'tset', '2023-11-28 10:51:37', 1, 2, 10),
(8, 'Goed recept', '2023-11-28 12:02:35', 5, 2, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(253, 'Afghanistan'),
(254, 'Aland Islands'),
(255, 'Albania'),
(256, 'Algeria'),
(257, 'American Samoa'),
(258, 'Andorra'),
(259, 'Angola'),
(260, 'Anguilla'),
(261, 'Antarctica'),
(262, 'Antigua and Barbuda'),
(263, 'Argentina'),
(264, 'Armenia'),
(265, 'Aruba'),
(266, 'Australia'),
(267, 'Austria'),
(268, 'Azerbaijan'),
(269, 'Bahamas'),
(270, 'Bahrain'),
(271, 'Bangladesh'),
(272, 'Barbados'),
(273, 'Belarus'),
(274, 'Belgium'),
(275, 'Belize'),
(276, 'Benin'),
(277, 'Bermuda'),
(278, 'Bhutan'),
(279, 'Bolivia'),
(280, 'Bonaire, Sint Eustatius and Saba'),
(281, 'Bosnia and Herzegovina'),
(282, 'Botswana'),
(283, 'Bouvet Island'),
(284, 'Brazil'),
(285, 'British Indian Ocean Territory'),
(286, 'Brunei Darussalam'),
(287, 'Bulgaria'),
(288, 'Burkina Faso'),
(289, 'Burundi'),
(290, 'Cambodia'),
(291, 'Cameroon'),
(292, 'Canada'),
(293, 'Cape Verde'),
(294, 'Cayman Islands'),
(295, 'Central African Republic'),
(296, 'Chad'),
(297, 'Chile'),
(298, 'China'),
(299, 'Christmas Island'),
(300, 'Cocos (Keeling) Islands'),
(301, 'Colombia'),
(302, 'Comoros'),
(303, 'Congo'),
(304, 'Congo, Democratic Republic of the Congo'),
(305, 'Cook Islands'),
(306, 'Costa Rica'),
(307, 'Cote D\'Ivoire'),
(308, 'Croatia'),
(309, 'Cuba'),
(310, 'Curacao'),
(311, 'Cyprus'),
(312, 'Czech Republic'),
(313, 'Denmark'),
(314, 'Djibouti'),
(315, 'Dominica'),
(316, 'Dominican Republic'),
(317, 'Ecuador'),
(318, 'Egypt'),
(319, 'El Salvador'),
(320, 'Equatorial Guinea'),
(321, 'Eritrea'),
(322, 'Estonia'),
(323, 'Ethiopia'),
(324, 'Falkland Islands (Malvinas)'),
(325, 'Faroe Islands'),
(326, 'Fiji'),
(327, 'Finland'),
(328, 'France'),
(329, 'French Guiana'),
(330, 'French Polynesia'),
(331, 'French Southern Territories'),
(332, 'Gabon'),
(333, 'Gambia'),
(334, 'Georgia'),
(335, 'Germany'),
(336, 'Ghana'),
(337, 'Gibraltar'),
(338, 'Greece'),
(339, 'Greenland'),
(340, 'Grenada'),
(341, 'Guadeloupe'),
(342, 'Guam'),
(343, 'Guatemala'),
(344, 'Guernsey'),
(345, 'Guinea'),
(346, 'Guinea-Bissau'),
(347, 'Guyana'),
(348, 'Haiti'),
(349, 'Heard Island and Mcdonald Islands'),
(350, 'Holy See (Vatican City State)'),
(351, 'Honduras'),
(352, 'Hong Kong'),
(353, 'Hungary'),
(354, 'Iceland'),
(355, 'India'),
(356, 'Indonesia'),
(357, 'Iran, Islamic Republic of'),
(358, 'Iraq'),
(359, 'Ireland'),
(360, 'Isle of Man'),
(361, 'Israel'),
(362, 'Italy'),
(363, 'Jamaica'),
(364, 'Japan'),
(365, 'Jersey'),
(366, 'Jordan'),
(367, 'Kazakhstan'),
(368, 'Kenya'),
(369, 'Kiribati'),
(370, 'Korea, Democratic People\'s Republic of'),
(371, 'Korea, Republic of'),
(372, 'Kosovo'),
(373, 'Kuwait'),
(374, 'Kyrgyzstan'),
(375, 'Lao People\'s Democratic Republic'),
(376, 'Latvia'),
(377, 'Lebanon'),
(378, 'Lesotho'),
(379, 'Liberia'),
(380, 'Libyan Arab Jamahiriya'),
(381, 'Liechtenstein'),
(382, 'Lithuania'),
(383, 'Luxembourg'),
(384, 'Macao'),
(385, 'Macedonia, the Former Yugoslav Republic of'),
(386, 'Madagascar'),
(387, 'Malawi'),
(388, 'Malaysia'),
(389, 'Maldives'),
(390, 'Mali'),
(391, 'Malta'),
(392, 'Marshall Islands'),
(393, 'Martinique'),
(394, 'Mauritania'),
(395, 'Mauritius'),
(396, 'Mayotte'),
(397, 'Mexico'),
(398, 'Micronesia, Federated States of'),
(399, 'Moldova, Republic of'),
(400, 'Monaco'),
(401, 'Mongolia'),
(402, 'Montenegro'),
(403, 'Montserrat'),
(404, 'Morocco'),
(405, 'Mozambique'),
(406, 'Myanmar'),
(407, 'Namibia'),
(408, 'Nauru'),
(409, 'Nepal'),
(410, 'Netherlands'),
(411, 'Netherlands Antilles'),
(412, 'New Caledonia'),
(413, 'New Zealand'),
(414, 'Nicaragua'),
(415, 'Niger'),
(416, 'Nigeria'),
(417, 'Niue'),
(418, 'Norfolk Island'),
(419, 'Northern Mariana Islands'),
(420, 'Norway'),
(421, 'Oman'),
(422, 'Pakistan'),
(423, 'Palau'),
(424, 'Palestinian Territory, Occupied'),
(425, 'Panama'),
(426, 'Papua New Guinea'),
(427, 'Paraguay'),
(428, 'Peru'),
(429, 'Philippines'),
(430, 'Pitcairn'),
(431, 'Poland'),
(432, 'Portugal'),
(433, 'Puerto Rico'),
(434, 'Qatar'),
(435, 'Reunion'),
(436, 'Romania'),
(437, 'Russian Federation'),
(438, 'Rwanda'),
(439, 'Saint Barthelemy'),
(440, 'Saint Helena'),
(441, 'Saint Kitts and Nevis'),
(442, 'Saint Lucia'),
(443, 'Saint Martin'),
(444, 'Saint Pierre and Miquelon'),
(445, 'Saint Vincent and the Grenadines'),
(446, 'Samoa'),
(447, 'San Marino'),
(448, 'Sao Tome and Principe'),
(449, 'Saudi Arabia'),
(450, 'Senegal'),
(451, 'Serbia'),
(452, 'Serbia and Montenegro'),
(453, 'Seychelles'),
(454, 'Sierra Leone'),
(455, 'Singapore'),
(456, 'Sint Maarten'),
(457, 'Slovakia'),
(458, 'Slovenia'),
(459, 'Solomon Islands'),
(460, 'Somalia'),
(461, 'South Africa'),
(462, 'South Georgia and the South Sandwich Islands'),
(463, 'South Sudan'),
(464, 'Spain'),
(465, 'Sri Lanka'),
(466, 'Sudan'),
(467, 'Suriname'),
(468, 'Svalbard and Jan Mayen'),
(469, 'Swaziland'),
(470, 'Sweden'),
(471, 'Switzerland'),
(472, 'Syrian Arab Republic'),
(473, 'Taiwan, Province of China'),
(474, 'Tajikistan'),
(475, 'Tanzania, United Republic of'),
(476, 'Thailand'),
(477, 'Timor-Leste'),
(478, 'Togo'),
(479, 'Tokelau'),
(480, 'Tonga'),
(481, 'Trinidad and Tobago'),
(482, 'Tunisia'),
(483, 'Turkey'),
(484, 'Turkmenistan'),
(485, 'Turks and Caicos Islands'),
(486, 'Tuvalu'),
(487, 'Uganda'),
(488, 'Ukraine'),
(489, 'United Arab Emirates'),
(490, 'United Kingdom'),
(491, 'United States'),
(492, 'United States Minor Outlying Islands'),
(493, 'Uruguay'),
(494, 'Uzbekistan'),
(495, 'Vanuatu'),
(496, 'Venezuela'),
(497, 'Viet Nam'),
(498, 'Virgin Islands, British'),
(499, 'Virgin Islands, U.s.'),
(500, 'Wallis and Futuna'),
(501, 'Western Sahara'),
(502, 'Yemen'),
(503, 'Zambia'),
(504, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(54, 'Bloem (tarwebloem)'),
(55, 'Suiker (witte suiker)'),
(56, 'Honing'),
(57, 'Ahornsiroop'),
(58, 'Agavesiroop'),
(59, 'Boter'),
(60, 'Olijfolie'),
(61, 'Plantaardige olie'),
(62, 'Kokosolie'),
(63, 'Melk'),
(64, 'Room'),
(65, 'Yoghurt'),
(66, 'Kaas'),
(67, 'Eieren'),
(68, 'Bakpoeder'),
(69, 'Baksoda'),
(70, 'Gist'),
(71, 'Zout'),
(72, 'Peper'),
(73, 'Basilicum'),
(74, 'Tijm'),
(75, 'Rozemarijn'),
(76, 'Kaneel'),
(77, 'Komijn'),
(78, 'Paprika'),
(79, 'Vanille-extract'),
(80, 'Amandelen'),
(81, 'Walnoten'),
(82, 'Zonnebloempitten'),
(83, 'Chiazaad'),
(84, 'Appels'),
(85, 'Bananen'),
(86, 'Bessen'),
(87, 'Citroenen'),
(88, 'Sinaasappels'),
(89, 'Uien'),
(90, 'Knoflook'),
(91, 'Tomaten'),
(92, 'Spinazie'),
(93, 'Boerenkool'),
(94, 'Kip'),
(95, 'Rundvlees'),
(96, 'Vis'),
(97, 'Tofu'),
(98, 'Linzen'),
(99, 'Bonen'),
(100, 'Koffie'),
(101, 'Thee'),
(102, 'Ketchup'),
(103, 'Mosterd'),
(104, 'Sojasaus'),
(105, 'Tomatensaus'),
(106, 'Mayonaise');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recepies_ingredients`
--

DROP TABLE IF EXISTS `recepies_ingredients`;
CREATE TABLE IF NOT EXISTS `recepies_ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `quantity` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recepies_ingredients_ingredients1_idx` (`ingredients_id`),
  KEY `fk_recepies_ingredients_recipes1_idx` (`recipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recepies_ingredients`
--

INSERT INTO `recepies_ingredients` (`id`, `recipes_id`, `ingredients_id`, `quantity`) VALUES
(26, 9, 69, '200g'),
(27, 9, 71, '500g'),
(29, 8, 86, '40g'),
(31, 8, 80, '400g');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `instructions` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `likes` int(5) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `img_url` varchar(100) NOT NULL DEFAULT 'img/defaultImg.jpg',
  PRIMARY KEY (`id`),
  KEY `fk_recipes_users1_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `instructions`, `created_at`, `likes`, `user_id`, `img_url`) VALUES
(7, 'test 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi, dignissim id faucibus at, rutrum eget odio.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi, dignissim id faucibus at, rutrum eget odio. Integer tempor ultrices diam eget malesuada', '2023-11-29 10:24:32', 0, 2, 'img/2/6565cba18728ctest.jpeg'),
(8, 'test 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi, dignissim id faucibus at, rutrum eget odio. Integer tempor ultrices diam eget malesuada', 'Lorem ipsum dolor sit amet', '2023-11-29 10:24:32', 2, 2, 'img/defaultImg.jpg'),
(9, 'test 3', 'sdaklfjsadlkfhsakdfhklsadjflkasdfhasdlkfjsdaklhflksadhflksahflksadhflkasdhfklsdafhsadkfhsadklf', 'sadjfasdklfjsalkdf', '2023-11-29 10:24:32', 0, 2, 'img/defaultImg.jpg'),
(10, 'test 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi, dignissim id faucibus at, rutrum eget odio. Integer tempor ultrices diam eget malesuada', 'Lorem ipsum dolor sit amet', '2023-11-29 10:24:32', 0, 2, 'img/defaultImg.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipes_categories`
--

DROP TABLE IF EXISTS `recipes_categories`;
CREATE TABLE IF NOT EXISTS `recipes_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recipes_categories_categories1_idx` (`categories_id`),
  KEY `fk_recipes_categories_recipes1` (`recipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recipes_categories`
--

INSERT INTO `recipes_categories` (`id`, `recipes_id`, `categories_id`) VALUES
(33, 8, 6),
(34, 8, 7),
(35, 8, 15),
(36, 8, 14),
(89, 9, 7),
(90, 9, 15),
(91, 9, 16),
(92, 9, 18),
(99, 10, 28),
(100, 10, 7),
(103, 10, 1),
(107, 10, 47),
(108, 7, 9),
(109, 7, 34),
(110, 7, 36);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `description` text,
  `img_url` varchar(100) NOT NULL DEFAULT 'img/defaultProfilePic.jpg',
  `RegistrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(4) DEFAULT '0',
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_country1_idx` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `firstname`, `lastname`, `description`, `img_url`, `RegistrationDate`, `admin`, `country_id`) VALUES
(2, 'Timmy', 'tim.vanderkloet@gmail.com', '$2y$10$c.CP/WGtTMtT3ilbrT/UAui6MjqKLQghT/E06FgjpKYC8ftTb8maa', 'Tim', 'van der Kloet', 'My name is timmy', 'img/2/6569a82565cea6569a82565fc5.png', '2023-11-23 10:13:36', 1, 410),
(8, 'test', 'test@test.nl', '$2y$10$OAooftQGafvdNY792CQQaO0tnsAcAoDry93QNP1YV9GAVHfd7reEW', 'test', 'test', 'test account', 'img/defaultProfilePic.jpg', '2023-12-05 10:26:03', 0, 265);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_recipes`
--

DROP TABLE IF EXISTS `user_recipes`;
CREATE TABLE IF NOT EXISTS `user_recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_recipes_users_idx` (`users_id`),
  KEY `fk_user_recipes_recipes1_idx` (`recipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_recipes`
--

INSERT INTO `user_recipes` (`id`, `recipes_id`, `users_id`) VALUES
(21, 8, 2);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `recepies_ingredients`
--
ALTER TABLE `recepies_ingredients`
  ADD CONSTRAINT `fk_recepies_ingredients_ingredients1` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recepies_ingredients_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `recipes_categories`
--
ALTER TABLE `recipes_categories`
  ADD CONSTRAINT `fk_recipes_categories_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recipes_categories_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_country1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `user_recipes`
--
ALTER TABLE `user_recipes`
  ADD CONSTRAINT `fk_user_recipes_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_recipes_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
