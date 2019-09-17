-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Sty 2019, 21:52
-- Wersja serwera: 10.1.31-MariaDB
-- Wersja PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Baza danych: `webproject`
--
CREATE DATABASE IF NOT EXISTS `webproject` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `webproject`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `EVENTID` int(11) NOT NULL,
  `NAME` text COLLATE utf8_polish_ci NOT NULL,
  `TIMESTART` time NOT NULL,
  `TIMEEND` time NOT NULL,
  `CATEGORY` text COLLATE utf8_polish_ci NOT NULL,
  `SCIENCE` tinyint(1) NOT NULL,
  `COST` decimal(15,2) NOT NULL,
  `TEXT` text COLLATE utf8_polish_ci NOT NULL,
  `AUTHORID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`EVENTID`, `NAME`, `TIMESTART`, `TIMEEND`, `CATEGORY`, `SCIENCE`, `COST`, `TEXT`, `AUTHORID`) VALUES
(1, 'What is new in IT?', '10:00:00', '12:00:00', 'Main Track', 1, '5.00', 'For 300 years, insurances have only slightly advanced technologically and have a solid reputation for being one of the most boring industries in the world. However, the latest technologies and numerous startups have opened up huge opportunities that insurers are beginning to see. The industry is beginning a huge, revolutionary transformation, which may be one of the most fascinating transformations in the coming decades.', 15298),
(2, 'Java Development', '12:00:00', '13:30:00', 'Main Track', 1, '10.00', 'Have you ever rebuilt the whole application because you have to add a new field to the frontend? Or when the table organization change in DB changed all your domain? The answer is the architecture of ports and adapters. On the presentation I will talk about experiences with building an application, where your domain is the most important and I will answer, among others. to the questions: - What will it give me? - How to do it? - What to watch out for? - Why is it difficult?', 15300),
(3, 'PHP Development', '13:30:00', '15:00:00', 'Main Track', 1, '10.00', ' try to explain what SOLID principles are all about, how to refactor an example code according to these principles and summarize what are the benefits of writing a SOLID code.', 15303),
(4, 'Security in IT', '16:30:00', '18:00:00', 'Main Track', 1, '8.00', 'In this topic I am asking you about practical problems related to IoT security, I also conduct a study of several cases where such security has been violated in devices available on the market', 15305),
(5, 'Data Science', '18:00:00', '20:00:00', 'Main Track', 1, '8.00', 'The subject of the presentation will be an attempt to present the values and examples of using SQL in Big data technologies - a language that everyone knows and which enables soft entry into the world of great data for programmers, designers, analysts, architects and ... managers. The whole is embellished with gistami, that is, short fragments of the code and abstract figures from our bands and seen not from the perspective of an expert, but practicing programmer.', 15306),
(6, 'Pizza Launch', '15:00:00', '16:00:00', 'Food', 0, '3.00', 'Enjoy our pizza!', 15297),
(7, 'Gala Dinner', '20:00:00', '21:00:00', 'Food', 0, '15.00', 'Join our gala Dinner!', 15297),
(8, 'Robotic Science', '12:00:00', '13:30:00', 'WorkShops', 1, '5.00', 'The rapid development of artificial intelligence (AI) and innovative technologies accelerates the emergence of intelligent enterprises and enables companies to participate in the lives of people on an increasingly large scale. Technology Vision is an annual report, prepared by Accenture, forecasting key technological trends that will revolutionize the market over the next three years.', 15307),
(9, 'Game Developing', '14:00:00', '15:30:00', 'WorkShops', 1, '3.00', '45 minutes - just enough to make your first game in the Unity3D engine! You will learn not only how to navigate in the environment, but also how to create a simple game world, simulate and handle collisions between objects, as well as react to players actions.', 15308),
(10, 'AI in Games', '16:00:00', '17:30:00', 'WorkShops', 1, '4.00', 'About how to breathe life into 3d models or pixel characters. Make them think and interact with the player. An overview of the most popular concepts and techniques of creating AI in games, full of examples from games such as Crush Your Enemies or This War of Mine.', 15298),
(11, 'First steps in C++', '16:30:00', '18:00:00', 'Tutorials', 1, '6.00', 'C ++ is simple - very easy! In 90 minutes we will learn the most important aspects of programming in this language. You will listen today, in the evening you will implement on your computer!', 15300),
(12, 'First steps in HTML/CSS', '18:30:00', '20:00:00', 'Tutorials', 1, '6.00', 'Have you ever worked with an application that cannot be easily developed any more? Would you like to upgrade the front end of your app, but the code seems to be unupgradable? Lets take a look at some approaches to creating micro frontends and using them to build software that doesnt get nasty with age.', 15303);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events_users`
--

CREATE TABLE `events_users` (
  `EVENTS_USERSID` int(11) NOT NULL,
  `EVENTID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `events_users`
--

INSERT INTO `events_users` (`EVENTS_USERSID`, `EVENTID`, `USERID`) VALUES
(17, 3, 15299),
(19, 7, 15299),
(20, 2, 15299),
(25, 8, 15301),
(26, 6, 15301),
(27, 12, 15301),
(28, 5, 15301),
(29, 8, 15302),
(30, 9, 15302),
(31, 2, 15302),
(32, 3, 15302),
(33, 12, 15302),
(34, 10, 15302),
(38, 4, 15309),
(39, 7, 15309),
(40, 5, 15309),
(41, 3, 15309),
(44, 1, 15299),
(45, 5, 15299);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `feedback`
--

CREATE TABLE `feedback` (
  `FEEDBACKID` int(11) NOT NULL,
  `TEXT` text COLLATE utf8_polish_ci NOT NULL,
  `AUTHORID` int(11) NOT NULL,
  `PRIVATE` tinyint(1) NOT NULL,
  `EVENTID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `feedback`
--

INSERT INTO `feedback` (`FEEDBACKID`, `TEXT`, `AUTHORID`, `PRIVATE`, `EVENTID`) VALUES
(1, 'Very interesting event! The Java programming presentation was very good.', 15299, 0, 2),
(2, 'People were very friendly. Board members went out of their way to introduce themselves.', 15302, 0, 7),
(3, 'Well organized conference, good scale, solid content in presentations. The student presentations and posters were outstanding.', 15304, 0, 11),
(4, 'I love that the time allotted for presentations is generous, promoting thoughtful Q & A, discussion. Gives presenter the gift of critical (thoughtful) feedback.', 15309, 0, 5),
(5, 'Impressed by quality of keynotes and presenters at a regional conference.', 15301, 0, 8),
(13, 'This is private feedback. Visible only to the author of Game Developing.', 15299, 1, 9),
(14, 'THIS IS NEW FEEDBACK', 152311, 0, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `NAME` text COLLATE utf8_polish_ci NOT NULL,
  `SURRNAME` text COLLATE utf8_polish_ci NOT NULL,
  `COUNTRY` text COLLATE utf8_polish_ci NOT NULL,
  `EMAIL` text COLLATE utf8_polish_ci NOT NULL,
  `INSTITUTION` text COLLATE utf8_polish_ci NOT NULL,
  `PASSWORD` text COLLATE utf8_polish_ci NOT NULL,
  `AUTHOR` tinyint(1) NOT NULL,
  `TOTALCOST` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`USERID`, `NAME`, `SURRNAME`, `COUNTRY`, `EMAIL`, `INSTITUTION`, `PASSWORD`, `AUTHOR`, `TOTALCOST`) VALUES
(15297, 'Mikolaj', 'Kapturowski', 'Poland', 'Kapturowski420@gmail.com', 'PJATK', 'Italia1997', 1, '0.00'),
(15298, 'Joanna', 'Krupa', 'Poland', 'JoanaKrupa@gmail.com', 'Politechnika Warszawska', 'Womanizer123', 1, '0.00'),
(15299, 'Ivan', 'Gregor', 'Czech Republic', 'IvanGregor@gmail.com', 'University of economy', 'forminutes', 0, '48.00'),
(15300, 'Ricardo', 'Fortiale', 'Italy', 'Ricardo27@gmail.com', 'UPO', 'Ricupo222', 1, '0.00'),
(15301, 'Jan', 'Kalbarczyk', 'USA', 'Kalbarczyk@gmail.com', 'Oxford', 'Kalbar021', 0, '22.00'),
(15302, 'Micheal', 'May', 'Netherlands', 'MichealBay@gmail.com', 'University of Technology Science', 'BayMay123', 0, '38.00'),
(15303, 'Lorenzo', 'Conasera', 'Italy', 'Lorenzo000@gmail.com', 'UPO', 'Lorenzo456456', 1, '0.00'),
(15305, 'William', 'Szenberg', 'England', 'Szenberg33@gmail.com', 'University of Oxford', 'LittleDogs223', 1, '0.00'),
(15306, 'Quentin', 'Tarantino', 'Canada', 'Tarantino@gmail.com', 'Stanford University', 'TarantinoMovies123', 1, '0.00'),
(15307, 'Abraham', 'Shill', 'Germany', 'AbrahamS@gmail.com', 'Monachium University', 'AbraCadabra', 1, '0.00'),
(15308, 'Hilda', 'Vien', 'Germany', 'VienHilga@gmail.com', 'University of Hagen', 'Bella123', 1, '0.00'),
(15309, 'Radek', 'Szalecki', 'Poland', 'SzaleckiRadek@gmail.com', 'University of Warsaw', 'Radek009', 0, '41.00'),
(44444, 'userName', 'userSurrname', 'userCountry', 'userMail', 'userInstitution', 'italia123', 1, '0.00'),
(152311, 'Janek', 'Kowalski', 'Poland', 'adad@gmail.com', 'PJATK', 'alaasdfg', 0, '0.00'),
(152312, 'Rafal‚', 'Marks', 'Poland', 'rafal.marks20@gmail.com', 'None', 'Pulpi123', 0, '0.00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EVENTID`);

--
-- Indeksy dla tabeli `events_users`
--
ALTER TABLE `events_users`
  ADD PRIMARY KEY (`EVENTS_USERSID`);

--
-- Indeksy dla tabeli `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FEEDBACKID`);


--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `EVENTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `events_users`
--
ALTER TABLE `events_users`
  MODIFY `EVENTS_USERSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152313;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
