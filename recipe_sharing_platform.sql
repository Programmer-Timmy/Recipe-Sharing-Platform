-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 29 nov 2023 om 17:12
-- Serverversie: 5.7.40
-- PHP-versie: 8.0.26

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe_sharing_platform`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `name` varchar
(
    45
) NOT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`)
VALUES (1, 'Appetizers'),
       (2, 'Soups'),
       (3, 'Salads'),
       (4, 'Main Dishes'),
       (5, 'Side Dishes'),
       (6, 'Breakfast'),
       (7, 'Brunch'),
       (8, 'Lunch'),
       (9, 'Dinner'),
       (10, 'Snacks'),
       (11, 'Desserts'),
       (12, 'Baking'),
       (13, 'Grilling'),
       (14, 'Roasting'),
       (15, 'Slow Cooker'),
       (16, 'One-Pot Meals'),
       (17, 'Stir-Fries'),
       (18, 'Pasta Dishes'),
       (19, 'Rice Dishes'),
       (20, 'Casseroles'),
       (21, 'Vegetarian'),
       (22, 'Vegan'),
       (23, 'Gluten-Free'),
       (24, 'Dairy-Free'),
       (25, 'Keto'),
       (26, 'Paleo'),
       (27, 'Mediterranean'),
       (28, 'Asian'),
       (29, 'Mexican'),
       (30, 'Italian'),
       (31, 'American'),
       (32, 'Indian'),
       (33, 'Middle Eastern'),
       (34, 'BBQ'),
       (35, 'Seafood'),
       (36, 'Chicken'),
       (37, 'Beef'),
       (38, 'Pork'),
       (39, 'Lamb'),
       (40, 'Turkey'),
       (41, 'Soup and Stew'),
       (42, 'Sandwiches and Wraps'),
       (43, 'Pizza'),
       (44, 'Finger Foods'),
       (45, 'Party Snacks'),
       (46, 'Holiday Recipes'),
       (47, 'Comfort Food'),
       (48, 'Healthy Recipes'),
       (49, 'Quick and Easy');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `comment` text NOT NULL,
    `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `rating` int
(
    1
) NOT NULL,
    `users_id` int
(
    11
) NOT NULL,
    `recipes_id` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id`
),
    KEY `fk_comments_users1_idx`
(
    `users_id`
),
    KEY `fk_comments_recipes1_idx`
(
    `recipes_id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `comment`, `timestamp`, `rating`, `users_id`, `recipes_id`)
VALUES (4, 'test', '2023-11-28 00:12:08', 3, 3, 7),
       (5, 'test', '2023-11-28 09:27:35', 4, 2, 8),
       (6, 'tset', '2023-11-28 10:51:37', 1, 2, 10),
       (7, 'ja ja ', '2023-11-28 11:52:12', 4, 2, 19),
       (8, 'Goed recept', '2023-11-28 12:02:35', 5, 2, 7);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `name` varchar
(
    45
) NOT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `countries`
--

INSERT INTO `countries` (`id`, `name`)
VALUES (253, 'Afghanistan'),
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
(500, ' Wallis and Futuna '),
(501, ' Western Sahara '),
(502, ' Yemen '),
(503, ' Zambia '),
(504, ' Zimbabwe ');

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
(54, ' Flour (all -purpose) '),
(55, ' Sugar (white) '),
(56, ' Honey '),
(57, ' Maple syrup '),
(58, ' Agave nectar '),
(59, ' Butter '),
(60, ' Olive oil '),
(61, ' Vegetable oil '),
(62, ' Coconut oil '),
(63, ' Milk '),
(64, ' Cream '),
(65, ' Yogurt '),
(66, ' Cheese '),
(67, ' Eggs '),
(68, ' Baking powder '),
(69, ' Baking soda '),
(70, ' Yeast '),
(71, ' Salt '),
(72, ' Pepper '),
(73, ' Basil '),
(74, ' Thyme '),
(75, ' Rosemary '),
(76, ' Cinnamon '),
(77, ' Cumin '),
(78, ' Paprika '),
(79, ' Vanilla extract '),
(80, ' Almonds '),
(81, ' Walnuts '),
(82, ' Sunflower seeds '),
(83, ' Chia seeds '),
(84, ' Apples '),
(85, ' Bananas '),
(86, ' Berries '),
(87, ' Lemons '),
(88, ' Oranges '),
(89, ' Onions '),
(90, ' Garlic '),
(91, ' Tomatoes '),
(92, ' Spinach '),
(93, ' Kale '),
(94, ' Chicken '),
(95, ' Beef '),
(96, ' Fish '),
(97, ' Tofu '),
(98, ' Lentils '),
(99, ' Beans '),
(100, ' Coffee '),
(101, ' Tea '),
(102, ' Ketchup '),
(103, ' Mustard '),
(104, ' Soy sauce '),
(105, ' Tomato sauce '),
(106, ' Mayonnaise ');

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recepies_ingredients`
--

INSERT INTO `recepies_ingredients` (`id`, `recipes_id`, `ingredients_id`, `quantity`) VALUES
(11, 19, 54, ' 1fscd '),
(12, 19, 71, '123'),
(13, 19, 66, 'sdfasdf'),
(14, 8, 61, '100ml'),
(19, 22, 65, '100ml'),
(26, 9, 69, '200g'),
(27, 9, 71, '500g'),
(28, 23, 54, '22');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `instructions`, `created_at`, `likes`, `user_id`, `img_url`) VALUES
(7, 'test 1', 'Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi,
        dignissim id faucibus at,
        rutrum eget odio. Integer tempor ultrices diam eget malesuada', 'Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi,
        dignissim id faucibus at, rutrum eget odio. Integer tempor ultrices diam eget malesuada', '2023-11-29 10:24:32', 0, 2, 'img/2/6565cba18728ctest.jpeg'),
(8, 'test 2', 'Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi,
        dignissim id faucibus at,
        rutrum eget odio. Integer tempor ultrices diam eget malesuada', 'Lorem ipsum dolor sit amet', '2023-11-29 10:24:32', 1, 2, 'img/defaultImg.jpg'),
(9, 'test 3', 'sdaklfjsadlkfhsakdfhklsadjflkasdfhasdlkfjsdaklhflksadhflksahflksadhflkasdhfklsdafhsadkfhsadklf', 'sadjfasdklfjsalkdf', '2023-11-29 10:24:32', 0, 2, 'img/defaultImg.jpg'),
(10, 'test 4', 'Lorem ipsum dolor sit amet,
        consectetur adipiscing elit. Nulla at augue justo. Ut pellentesque erat vitae dui pellentesque consectetur. Curabitur lobortis viverra quam scelerisque rutrum. Sed purus mi,
        dignissim id faucibus at,
        rutrum eget odio. Integer tempor ultrices diam eget malesuada', 'Lorem ipsum dolor sit amet', '2023-11-29 10:24:32', 0, 2, 'img/defaultImg.jpg'),
(19, 'jadslfas', 'sdafsdfasdfasdkfjasdlkfvjaskldfjsadlk jslkdafjskldfj asdlfjsadlkfjasdlkfj sdlkaf\r\nsdfjas d\'kfasd\r\n\r\n\r\n\r\nslfk jasdlfkjasd',
        'et', '2023-11-29 10:24:32', 2, 3, 'img/3/656491d0c1fcc588A9371.jpg'),
       (22, 'test', 'ehhehehe', 'heheh', '2023-11-29 10:24:32', 1, 4, 'img/defaultImg.jpg'),
       (23, 'sadf', 'asdf', 'asdf', '2023-11-29 13:37:45', 0, 3, 'img/defaultImg.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipes_categories`
--

DROP TABLE IF EXISTS `recipes_categories`;
CREATE TABLE IF NOT EXISTS `recipes_categories`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `recipes_id` int
(
    11
) NOT NULL,
    `categories_id` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id`
),
    KEY `fk_recipes_categories_categories1_idx`
(
    `categories_id`
),
    KEY `fk_recipes_categories_recipes1`
(
    `recipes_id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `recipes_categories`
--

INSERT INTO `recipes_categories` (`id`, `recipes_id`, `categories_id`)
VALUES (30, 19, 8),
       (31, 19, 10),
       (32, 19, 46),
       (33, 8, 6),
       (34, 8, 7),
       (35, 8, 15),
       (36, 8, 14),
       (70, 7, 23),
       (71, 7, 9),
       (72, 7, 34),
       (73, 7, 7),
       (76, 22, 13),
       (89, 9, 7),
       (90, 9, 15),
       (91, 9, 16),
       (92, 9, 18),
       (93, 23, 42);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `username` varchar
(
    40
) NOT NULL,
    `email` varchar
(
    100
) NOT NULL,
    `password_hash` varchar
(
    255
) NOT NULL,
    `firstname` varchar
(
    40
) NOT NULL,
    `lastname` varchar
(
    40
) NOT NULL,
    `description` text,
    `img_url` varchar
(
    100
) NOT NULL DEFAULT 'img/defaultProfilePic.jpg',
    `RegistrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `country_id` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id`
),
    KEY `fk_users_country1_idx`
(
    `country_id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `firstname`, `lastname`, `description`, `img_url`,
                     `RegistrationDate`, `country_id`)
VALUES (2, 'Timmy', 'tim.vanderkloet@gmail.com', '$2y$10$c.CP/WGtTMtT3ilbrT/UAui6MjqKLQghT/E06FgjpKYC8ftTb8maa', 'Tim',
        'van der Kloet', 'My name is timmy', 'img/profilepic.jpg', '2023-11-23 10:13:36', 410),
       (3, 'janp', 'jan@piet.nl', '$2y$10$rIYXFti3Xakqe5kDncmfN.lcNVad8xVqn1nu/gXQT8twQfB1aWF76', 'piet', 'jan', NULL,
        'img/defaultProfilePic.jpg', '2023-11-27 10:53:35', 410),
       (4, 'test1', 'test@test.nl', '$2y$10$hohrNcdXTz24bb7nybZNjuzNjyc0AVxwcQO91ufV9VdhN22T2AjyG', 'test', 'test',
        NULL, 'img/defaultProfilePic.jpg', '2023-11-28 12:21:36', 253);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_recipes`
--

DROP TABLE IF EXISTS `user_recipes`;
CREATE TABLE IF NOT EXISTS `user_recipes`
(
    `id` int
(
    11
) NOT NULL AUTO_INCREMENT,
    `recipes_id` int
(
    11
) NOT NULL,
    `users_id` int
(
    11
) NOT NULL,
    PRIMARY KEY
(
    `id`
),
    KEY `fk_user_recipes_users_idx`
(
    `users_id`
),
    KEY `fk_user_recipes_recipes1_idx`
(
    `recipes_id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_recipes`
--

INSERT INTO `user_recipes` (`id`, `recipes_id`, `users_id`)
VALUES (21, 8, 2),
       (22, 22, 2),
       (23, 19, 2),
       (24, 19, 3);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `comments`
--
ALTER TABLE `comments`
    ADD CONSTRAINT `fk_comments_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON
DELETE
NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `recepies_ingredients`
--
ALTER TABLE `recepies_ingredients`
    ADD CONSTRAINT `fk_recepies_ingredients_ingredients1` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recepies_ingredients_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON
DELETE
NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_recipes_categories_recipes1` FOREIGN KEY (`recipes_id`) REFERENCES `recipes` (`id`) ON
DELETE
NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_user_recipes_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON
DELETE
NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
