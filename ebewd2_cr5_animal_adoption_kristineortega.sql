-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 09:40 PM
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
-- Database: `ebewd2_cr5_animal_adoption_kristineortega`
--
CREATE DATABASE IF NOT EXISTS `ebewd2_cr5_animal_adoption_kristineortega` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ebewd2_cr5_animal_adoption_kristineortega`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT 'test_pic.jpg',
  `location` varchar(155) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `vaccinated` tinyint(1) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`id`, `name`, `image`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `availability`) VALUES
(4, 'Bowow', 'bulldog.jpg', 'Animal Care Austria,  Triester Str. 8', 'It has a large head, folded ears, a short muzzle, a protruding lower jaw, and loose skin that forms wrinkles on the head and face.', 'medium', 6, 1, 'bulldog', 1),
(5, 'Hummy', 'cockatiel_bird.jpg', 'Animal Care Austria,  Triester Str. 8', 'The Cockatiel is an unusual member of the cockatoo family. It has a slender body and long pointed tail, which is more characteristic of the smaller parrots. Its plumage is mostly grey, paler below, with a white wing patch, orange cheeks and a distinctive ', 'small', 2, 0, 'Cockatiel Bird', 0),
(6, 'Spideyman', 'test_pic.jpg', 'Wiener Tierschutzverein, Berlagasse 36', 'They have dark bodies with rose-hued hair. These active predators use their body size to subdue prey. Their venom primarily helps them eat and is not known to be fatal in humans.', '5 inches', 4, 0, 'Grammostola Rosea Tarantula', 1),
(7, 'Gaga', '6671cb01e90c1.jpg', 'Animal Care Austria, Triester Str. 8', 'A herbivore, it has adapted significantly with regard to locomotion and osmoregulation as a result of its diet.The green iguana ranges over a large geographic area; it is native from southern Brazil and Paraguay as far north as Mexico.', '2 meter', 10, 0, 'green iguana', 1),
(8, 'Quiao', 'macaw_parrots.jpg', 'Animal Care Austria, Triester Str. 8', 'Macaws are king-sized members of the parrot family and have typical parrot features. Their large, strong, curved beaks are adapted for crushing nuts and seeds. Their strong, agile toes are used like hands to grasp things. Loud, screeching and squawking vo', '40 centimeter', 12, 0, 'macaw parrot', 1),
(9, 'Hassie', 'polish_rabbit.jpg', 'Wiener Tierschutzverein, Berlagasse 36', 'Polish rabbits are small, with short ears that touch each other all the way from the base to the tip. This breed has a short head with full cheeks and bold eyes.', 'small', 2, 1, 'polish rabbit', 1),
(10, 'Patrash', '6671da1fc3b25.jpg', 'Animal Care Austria, Triester Str. 8', 'Poodles are good family dogs — fun, energetic, smart and easy to train. They do best with plenty of exercise for both mind and body and prefer to be with people most of the time.', '40', 6, 0, 'poodle dog', 1),
(11, 'Doink', 'provence_donkey.jpg', 'Wiener Tierschutzverein, Berlagasse 36', 'The muzzle and surround of the eyes are pale; the forehead and ears usually have a russet tint. There is a well-marked darker dorsal stripe and shoulder-stripe; zebra-striping of the legs may be present. ', '102 centimeter', 25, 1, 'provence donkey', 1),
(12, 'Ben', 'ranchu_goldfish.jpg', 'Animal Care Austria, Triester Str. 8', 'The scales are metallic and come in a wide variety of colours from white to black. These goldfish have no dorsal fin. Breeding standards require that the back should not have any vestiges of the dorsal fin on it.', '7 inches', 11, 0, 'ranchu goldfish', 1),
(13, 'Nik', 'roborovski_hamster.jpg', 'Wiener Tierschutzverein, Berlagasse 36', 'The Roborovski hamster, also known as the Desert hamster is the smallest breed of pet hamster.These hamsters are fairly low-maintenance pets, and they can be quite entertaining to watch.', '2 inches', 2, 0, 'roborovski hamster', 1),
(14, 'Woll', 'suffolk_sheep.jpg', 'Animal Care Austria, Triester Str. 8', 'They are energetic, and the whole carriage is alert, showing stamina and quality. Suffolk\'s have jet black, wool-free heads and legs that sharply contrast their clean white fleeces and pink skin.', '113 kilogram', 8, 1, 'suffolk sheep', 1),
(15, 'Viker', 'thoroughbred_horse.jpg', 'Wiener Tierschutzverein, Berlagasse 36', 'Good-quality Thoroughbreds have a well-chiseled head on a long neck, high withers, a deep chest, a short back, good depth of hindquarters, a lean body, and long legs.', '450 kilograms', 10, 1, 'thoroughbred horse', 1),
(18, 'bethy', 'test_pic.jpg', 'Vier Pfoten, Linke Wienzeile 236', 'huge', 'large', 3, 1, 'dog', 1),
(21, 'Raphael', 'box_turtle.jpg', 'Vier Pfoten, Linke Wienzeile 236', 'Box turtles have a hooked upper jaw, and most have a significant overbite. Their feet are slightly webbed.', '11 inches', 3, 0, 'box turtle', 1),
(22, 'Sprinter', 'four_toed_hedgehog.jpg', 'Vier Pfoten, Linke Wienzeile 236', 'Spines are white at the bases and tips and black in the middle. The face and underside of the hedgehog are covered in soft white or brown fur.', '7 inches', 2, 0, 'four toed ', 1),
(23, 'Kitty', 'test_pic.jpg', 'Wiener Tierschutzverein, Berlagasse 35', 'Short coupled and robust, the British Shorthair is instantly recognisable by their rounded face and large round eyes, giving this cat an adorable expression and bags of character.', 'large', 9, 0, 'british shorthair cat', 1),
(26, 'Ken', '6671e1545b6db.jpg', 'Schönbrunnerstraße 45', 'loving and active', 'large', 8, 1, 'poodle', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adoption_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`id`, `animal_id`, `user_id`, `adoption_date`) VALUES
(10, 5, 3, '2024-06-18 19:39:17'),
(11, 26, 3, '2024-06-18 19:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `image`, `password`, `status`) VALUES
(1, 'chris', 'chiu', 'chris@gmail.com', '0123694577', 'morrokogasse 25', '6671b5013606d.jpg', '523aa18ecb892c51fbdbe28c57e10a92419e0a73e8931e578b98baffccf99cdd', 'user'),
(2, 'andrea', 'torres', 'andrea@yahoo.com', '023456787', 'rochesgassse 23', '6671cbda857dd.jpg', '2c174b41116e79b737335d46186f9252fef5707825191dc50575e8aac039e6f7', 'adm'),
(3, 'shawn', 'moll', 'shawn@gmail.com', '4567892', 'emil-behring weg 11', '666df12f948c4.jpg', '5e559fcb1446dff10942fa692499d0f5222406dde553264bae7a112eeea68faf', 'user'),
(4, 'zach', 'howard', 'zach@yahoo.com', '06642895647', 'Salesianergasse 5 1030 Wien', '666e9eec96af5.jpg', 'becfdcaae290c8e66e79029924d2c8b1484cc3d8eb014b1e2c0fce976e92fabf', 'adm'),
(5, 'greg', 'kurt', 'greg@yahoo.com', '0064789632', 'Keinmayergasse 26', '666f12c354f59.jpg', 'e0de640176612412914bcc1cd9fdb15a28a26fdeb09fe640de028be9b2c03f04', 'user'),
(6, 'paola', 'madrigal', 'paola@gmx.com', '5656426653', 'Hietzinger Hauptstrasse 28', 'test_pic.jpg', 'd87aa6cfb64f45b3643af741b6c4e2574ba667fdcb9ded3590235ef8d23a38b8', 'user'),
(7, 'Awaz Khan', 'Uthman', 'awaz@gmail.com', '00123654', 'herrengasse 2', 'test_pic.jpg', 'd87aa6cfb64f45b3643af741b6c4e2574ba667fdcb9ded3590235ef8d23a38b8', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_adaption_animal` (`animal_id`),
  ADD KEY `pet_adaption_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adaption_animal` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`),
  ADD CONSTRAINT `pet_adaption_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
