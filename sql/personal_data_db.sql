-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 10:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_data_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`) VALUES
(1, 'Los Angeles', 1),
(2, 'San Francisco', 1),
(3, 'Houston', 2),
(4, 'Toronto', 3),
(5, 'Montreal', 4),
(6, 'London', 5),
(7, 'Sydney', 6),
(8, 'Mumbai', 7),
(9, 'Munich', 8),
(10, 'Paris', 9),
(11, 'São Paulo', 10),
(12, 'Tokyo', 11),
(13, 'Johannesburg', 12),
(27, 'Minglanilla', 16);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(4, 'Australia'),
(8, 'Brazil'),
(2, 'Canada'),
(12, 'Europe'),
(7, 'France'),
(6, 'Germany'),
(5, 'India'),
(9, 'Japan'),
(11, 'Philippines'),
(10, 'South Africa'),
(3, 'United Kingdom'),
(1, 'United States');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `city_id`) VALUES
(1, 'Downtown', 1),
(2, 'Hollywood', 1),
(3, 'Uptown', 2),
(4, 'Downtown', 3),
(5, 'Scarborough', 4),
(6, 'Old Montreal', 5),
(7, 'Westminster', 6),
(8, 'Central Coast', 7),
(9, 'Dadar', 8),
(10, 'Altstadt', 9),
(11, 'Montmartre', 10),
(12, 'Centro', 11),
(13, 'Sandton', 12),
(14, 'Vito', 27);

-- --------------------------------------------------------

--
-- Table structure for table `neighborhoods`
--

CREATE TABLE `neighborhoods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `neighborhoods`
--

INSERT INTO `neighborhoods` (`id`, `name`, `district_id`) VALUES
(1, 'Arts District', 1),
(2, 'Silver Lake', 1),
(3, 'Nob Hill', 2),
(4, 'Midtown', 3),
(5, 'Yorkville', 4),
(6, 'Plateau', 5),
(7, 'Soho', 6),
(8, 'Bondi Beach', 7),
(9, 'Juhu', 8),
(10, 'Lehel', 9),
(11, 'Montparnasse', 10),
(12, 'Liberdade', 11),
(13, 'Harajuku', 12),
(14, 'Rosebank', 13),
(15, 'Acoy', 14);

-- --------------------------------------------------------

--
-- Table structure for table `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_initial` char(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed','Legally Separated','Others') DEFAULT NULL,
  `other_civil_status` varchar(50) DEFAULT NULL,
  `tax_identification_number` varchar(15) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `place_of_birth_rm_flr_unit` varchar(50) DEFAULT NULL,
  `place_of_birth_house_lot_blk` varchar(50) DEFAULT NULL,
  `place_of_birth_street_name` varchar(100) DEFAULT NULL,
  `place_of_birth_subdivision` varchar(100) DEFAULT NULL,
  `place_of_birth_barangay` varchar(100) DEFAULT NULL,
  `place_of_birth_city` varchar(100) DEFAULT NULL,
  `place_of_birth_province` varchar(100) DEFAULT NULL,
  `place_of_birth_country` enum('Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Côte d''Ivoire','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','North Korea','South Korea','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Lithuania','Luxembourg','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palau','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Sint Maarten','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Swaziland','Sweden','Switzerland','Syria','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe') DEFAULT NULL,
  `place_of_birth_zip_code` varchar(10) DEFAULT NULL,
  `home_address_rm_flr_unit` varchar(50) DEFAULT NULL,
  `home_address_house_lot_blk` varchar(50) DEFAULT NULL,
  `home_address_street_name` varchar(100) DEFAULT NULL,
  `home_address_subdivision` varchar(100) DEFAULT NULL,
  `home_address_barangay` varchar(100) DEFAULT NULL,
  `home_address_city` varchar(100) DEFAULT NULL,
  `home_address_province` varchar(100) DEFAULT NULL,
  `home_address_country` enum('Afghanistan','Albania','Algeria','Andorra','Angola','Antigua and Barbuda','Argentina','Armenia','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Brazil','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Central African Republic','Chad','Chile','China','Colombia','Comoros','Congo','Costa Rica','Côte d''Ivoire','Croatia','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Fiji','Finland','France','Gabon','Gambia','Georgia','Germany','Ghana','Greece','Grenada','Guatemala','Guinea','Guinea-Bissau','Guyana','Haiti','Honduras','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Israel','Italy','Jamaica','Japan','Jordan','Kazakhstan','Kenya','Kiribati','North Korea','South Korea','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Lithuania','Luxembourg','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Mauritania','Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','New Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palau','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Qatar','Romania','Russia','Rwanda','Saint Kitts and Nevis','Saint Lucia','Saint Vincent and the Grenadines','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Sint Maarten','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Sudan','Spain','Sri Lanka','Sudan','Suriname','Swaziland','Sweden','Switzerland','Syria','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tonga','Trinidad and Tobago','Tunisia','Turkey','Turkmenistan','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Yemen','Zambia','Zimbabwe') DEFAULT NULL,
  `home_address_zip_code` varchar(10) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `father_last_name` varchar(50) DEFAULT NULL,
  `father_first_name` varchar(50) DEFAULT NULL,
  `father_middle_name` varchar(50) DEFAULT NULL,
  `mother_last_name` varchar(50) DEFAULT NULL,
  `mother_first_name` varchar(50) DEFAULT NULL,
  `mother_middle_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_data`
--

INSERT INTO `personal_data` (`id`, `last_name`, `first_name`, `middle_initial`, `date_of_birth`, `gender`, `civil_status`, `other_civil_status`, `tax_identification_number`, `nationality`, `religion`, `place_of_birth_rm_flr_unit`, `place_of_birth_house_lot_blk`, `place_of_birth_street_name`, `place_of_birth_subdivision`, `place_of_birth_barangay`, `place_of_birth_city`, `place_of_birth_province`, `place_of_birth_country`, `place_of_birth_zip_code`, `home_address_rm_flr_unit`, `home_address_house_lot_blk`, `home_address_street_name`, `home_address_subdivision`, `home_address_barangay`, `home_address_city`, `home_address_province`, `home_address_country`, `home_address_zip_code`, `mobile_number`, `email_address`, `telephone_number`, `father_last_name`, `father_first_name`, `father_middle_name`, `mother_last_name`, `mother_first_name`, `mother_middle_name`) VALUES
(2, 'Fisher', 'Carly', 'V', '1983-02-28', 'Male', 'Single', 'Qui nostrud qui haru', '745', 'Quis laborum invento', 'Labore aut consectet', 'Dolor ratione evenie', 'Est in numquam digni', 'Ashely Murray', 'Quos et laboris nece', 'Et non doloribus ess', 'Exercitation elit u', 'Eiusmod laborum quia', '', '44595', 'Aut laudantium proi', 'Qui et expedita ipsu', 'Mikayla Stokes', 'Temporibus eu est od', 'Velit quas mollitia ', 'Ut optio rerum est', 'Duis et nisi animi ', '', '42932', '268', 'gofiros@mailinator.com', '+1 (819) 223-12', 'Gomez', 'Hilary', 'Adrian Green', 'Browning', 'Dara', 'Alden Hogan'),
(3, 'Hyde', 'Isabella', 'I', '1980-05-11', 'Female', 'Widowed', '', '877', 'Porro quod magna ea ', 'Aut pariatur Ad ips', 'Jescie Brennan', 'Optio dolor ut tene', 'Lucas Hebert', 'Qui assumenda sequi ', 'Atque consequuntur c', 'Quia mollit eos inv', 'Exercitation autem e', 'Angola', '94037', 'Meghan Michael', 'Commodi blanditiis q', 'Hakeem Rosario', 'Maiores ducimus et ', 'Irure commodo rerum ', 'Minim pariatur Temp', 'Repudiandae necessit', 'Spain', '50782', '+1 (525) 867-37', 'wilap@mailinator.com', '+1 (123) 374-29', 'Huber', 'Noble', 'Uma Donovan', 'Bray', 'Winter', 'Brenda Nolan'),
(4, 'Mcfadden', 'Vielka', 'E', '1999-09-04', 'Female', 'Married', '', '961', 'Nobis ut omnis conse', 'Totam consectetur v', 'Ursa Rasmussen', 'Laborum dolorem tota', 'Shafira Carter', 'Et tenetur ut repreh', 'Praesentium aspernat', 'Dolore esse repudia', 'Aliquip et exercitat', 'Belgium', '42274', 'Inga Daniel', 'Qui sed omnis qui qu', 'Robin Romero', 'Autem occaecat eaque', 'Doloremque quisquam ', 'Quidem ea qui asperi', 'Commodo in non provi', 'Timor-Leste', '30751', '+1 (435) 788-25', 'bujiv@mailinator.com', '+1 (411) 613-92', 'Daniel', 'Uma', 'Lani Reid', 'Graves', 'Ramona', 'Ian Rogers'),
(5, 'Bright', 'Joshua', 'A', '2024-05-25', 'Male', 'Others', 'asdas', '195', 'Dolorum quibusdam al', 'Cillum explicabo Qu', 'Sage Ingram', 'Et in impedit nisi ', 'Devin Pennington', 'Molestiae amet elig', 'Culpa nostrud ea com', 'Aut asperiores sint ', 'Ut officia consequat', 'San Marino', '23576', 'Dorian Hale', 'Asperiores optio ip', 'MacKensie Mckenzie', 'Et aut autem dicta i', 'Perferendis illo dol', 'Architecto non dolor', 'Aute esse alias dol', 'Armenia', '71151', '+1 (954) 933-56', 'satiq@mailinator.com', '+1 (735) 448-91', 'Mcdaniel', 'TaShya', 'Jocelyn Welch', 'Morris', 'Wylie', 'George Berger'),
(6, 'Collier', 'Idona', 'V', '2017-12-02', 'Male', 'Legally Separated', '', '291', 'Voluptas aperiam nec', 'Adipisicing aspernat', 'Hiram Gibson', 'Labore laboris qui r', 'Rashad Tyson', 'Sit qui quisquam Nam', 'Adipisicing velit qu', 'Consequatur Omnis e', 'Voluptate aute sint ', 'Bahrain', '64392', 'Calista Keith', 'Ut consequuntur sunt', 'Tasha Horne', 'Dolorem molestiae ve', 'Sit nulla distinctio', 'Elit labore illo of', 'Perferendis debitis ', 'Liberia', '40103', '+1 (872) 703-63', 'kilohek@mailinator.com', '+1 (979) 778-69', 'Hawkins', 'Ross', 'Stone Rutledge', 'Hess', 'Bruno', 'Nola Pruitt'),
(7, 'Nielsen', 'Echo', 'P', '2004-01-25', 'Male', 'Others', 'asdas', '841', 'Laborum asperiores e', 'Adipisicing lorem no', 'Laborum quidem deser', 'Veniam cum aperiam ', 'Vera Landry', 'Recusandae Laudanti', 'Iusto est voluptate ', 'Sed impedit qui qui', 'Omnis sunt est omni', 'Ecuador', '65707', 'Omnis anim aliquam e', 'Ad laborum Elit ea', 'Cameron Lara', 'Elit praesentium qu', 'Ullam adipisicing mi', 'Tempore incididunt ', 'Aliquip minim Nam ma', 'Switzerland', '46268', '71', 'sivupy@mailinator.com', '+1 (326) 891-12', 'Rosa', 'Elliott', 'Abigail Walton', 'Whitaker', 'Quamar', 'Chancellor Hartman'),
(8, 'Schneider', 'Bo', 'Q', '1994-05-04', 'Male', 'Others', 'hehe', '739', 'Laborum pariatur Ea', 'Pariatur Eligendi q', 'Suscipit sed autem f', 'Impedit non exceptu', 'Macey Guthrie', 'Distinctio Deserunt', 'Est reiciendis tempo', 'Provident sunt dolo', 'Vel excepturi placea', '', '18871', 'Itaque unde incidunt', 'Aliqua Nemo velit n', 'Aiko Valencia', 'Vitae commodi repell', 'Et mollit sint cumqu', 'Obcaecati aut ea aut', 'Optio quasi quis ve', '', '77658', '387', 'joquwewol@mailinator.com', '+1 (268) 599-52', 'Bryan', 'Akeem', 'Willa Schroeder', 'Gibbs', 'Shea', 'Irene Madden');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'California', 1),
(2, 'Texas', 1),
(3, 'Ontario', 2),
(4, 'Quebec', 2),
(5, 'England', 3),
(6, 'New South Wales', 4),
(7, 'Maharashtra', 5),
(8, 'Bavaria', 6),
(9, 'Île-de-France', 7),
(10, 'São Paulo', 8),
(11, 'Tokyo', 9),
(12, 'Gauteng', 10),
(14, 'Manila', 11),
(15, 'Bulgaria', 12),
(16, 'Cebu', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_id`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `neighborhoods`
--
ALTER TABLE `neighborhoods`
  ADD CONSTRAINT `neighborhoods_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
