-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Jan 17. 10:44
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `2024chatapp`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `image_name` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `image_name`) VALUES
(112, 771437636, 1369272329, 'f', NULL),
(113, 771437636, 1369272329, 'szia Liliana', NULL),
(114, 557206628, 1369272329, 'Szia Iván', NULL),
(115, 1369272329, 557206628, 'Szia Zita', NULL),
(116, 557206628, 1369272329, 'Hogy vagy iván', NULL),
(117, 557206628, 1369272329, '[image]: SYEW1447.JPG', NULL),
(118, 171348553, 557206628, 'Szia Rita', NULL),
(119, 557206628, 171348553, 'Szia Iván !', NULL),
(120, 171348553, 557206628, '[image]: SYEW1447.JPG', NULL),
(121, 557206628, 1369272329, 'hello', NULL),
(122, 1369272329, 557206628, 'hello', NULL),
(123, 1369272329, 557206628, 'websocket?', NULL),
(124, 557206628, 1369272329, 'működik?', NULL),
(125, 1369272329, 557206628, 'talán', NULL),
(126, 557206628, 1369272329, 'nem jön át az üzi', NULL),
(127, 557206628, 1369272329, 'éé', NULL),
(128, 557206628, 1369272329, 'semmi', NULL),
(129, 557206628, 1369272329, 'nnnn', NULL),
(130, 557206628, 1369272329, 'kikk', NULL),
(131, 1369272329, 557206628, 'kjk', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `content`, `post_image`, `created_at`) VALUES
(1, 1369272329, 'Szia', '', '2024-10-08 18:27:25'),
(2, 557206628, 'Sziasztok\r\n', '', '2024-10-08 18:27:56');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL,
  `mobil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `department`, `occupation`, `img`, `status`, `mobil`) VALUES
(171348553, 'Rita', 'Kiss ', 'rita@gmail.com', '$2y$10$KlDbacEP9e8i3NemoqYvmuMyHq9U0SofYT6lXKArsBpDh583wES7i', 'Latiza Kft', 'adminisztrátor', '17284134141615830203.jpg', 'Active now', '0630458-9564'),
(557206628, 'Ivan', 'Ferkó ', 'ivan@gmail.com', '$2y$10$aeK7uNIh3l8vZS/W90hJrO9/DpNQvBFkm/GvE5qKrrO3S9iIiNtsm', 'Latiza Kft', 'gépkocsivezető', '1728408858_c13b27e8-2769-4e8a-9f59-2a51abcae598.jpg', 'Active now', '0620562-8547'),
(675714206, 'Balázs', 'Koczka', 'koczka.balazs@gmail.com', '$2y$10$iN.G4oJOJMeDSvS0WCDbwetmJBIdKmKFgDTpe.c3PwCeZtB2w19lW', 'Fejlesztés', 'Programozó', '17370585131165944276.jpg', 'Offline now', '06701234567'),
(771437636, 'Liliana', 'Varga ', 'liliana@gmail.com', '$2y$10$UF0OA9ReEKmgrk8.uigsEebOCf7WYxhhyng9RPg33SP40.x0s8PWq', 'Latiza Kft', 'szoftverfejlesztő', '1728407248320885182_1142322559738159_8236716738442723893_n.jpg', 'Offline now', '0630-477-8523'),
(1369272329, 'Zita', 'Ruzsinszki', 'zita@gmail.com', '$2y$10$8/wW0oQ9Yd.RD5d.1IJNMeKbydnea/6WZFNhEBgWuXiIrWf64yQkO', 'Latiza Kft', 'tulajdonos', '1728407164devilgirl.jpg', 'Active now', '+36 304778772');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `incoming_msg_id` (`incoming_msg_id`),
  ADD KEY `outgoing_msg_id` (`outgoing_msg_id`);

--
-- A tábla indexei `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT a táblához `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1661759700;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`user_id`);

--
-- Megkötések a táblához `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
