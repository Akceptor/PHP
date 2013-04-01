-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2013 at 12:44 PM
-- Server version: 5.1.40-community
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `login`, `password`) VALUES
(1, 'test', 'test'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `my_table`
--

CREATE TABLE IF NOT EXISTS `my_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `shorttext` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fulltext` text CHARACTER SET utf8,
  `creation_date` date DEFAULT NULL,
  `edit_date` date DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Dumping data for table `my_table`
--

INSERT INTO `my_table` (`id`, `name`, `shorttext`, `fulltext`, `creation_date`, `edit_date`, `author_id`) VALUES
(1, 'one', '1st short text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '2013-03-21', '2013-03-21', 1),
(2, 'two', '2nd short text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '2013-03-20', '2013-03-21', 1),
(3, 'three', '3rd short text', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '2013-03-25', '2013-03-22', 2),
(4, 'test', 'Три біди української опозиції', 'Не позиціонуватиму себе як людина, яка хоч трохи петрає у вітчизняній політиці, але нещодавня акція “Україно, Вставай!”, яка стартувала нещодавно (подейкують, що відклали її початок через негоду) завадила мені нормально дістатися до хати (а моя хата якраз скраю), тому мовчати не буду.', '2013-03-28', '2013-03-28', 2),
(10, '360 панорама', '360 панорама Марсу', 'Завдяки крутому обладнанню на борту марсохода Curiosity тепер кожен може подивитися на Марс практично своїми очима. Вірніше, подивитися на 360-градусну панораму Червоної Планети.', '2013-03-28', '2013-03-28', 1),
(11, 'Сучасні тролейбуси', 'Сучасні тролейбуси: українська реальність', 'Деякий час тому я писав про те як мене приємно вразила поїздка у тролейбусі: ніяких кондукторів, оголошення зупинок – все як у Європі. Довелося мені вчора знов скористатися франківськими тролейбусами і тепер я уже не така наївна дитина, як був минулого разу', '2013-04-01', '2013-04-01', 1),
(12, 'myJournal', 'myJournal – наступний крок', 'Коли є час, потрохи продовжую роботу над своїм проектом “електронний журнал викладача” (поки-що назва проекту залишається драфтовою: myJournal). До попередньої версії додано ряд фіч, які стосуються ролей викладача та студента. Зараз якраз збираюся з силами аби почати писати адмінку і потрохи рефакторю вже існуючий код.', '2013-04-01', '2013-04-01', 1),
(13, 'Samurai ', 'Samurai VS Zombies 2', 'Трохи раніше я писав про гру Samurai vs Zombies, яка у мене незмінно поселилася на планшеті (хоча зараз бавитися часу немає), так от, нещодавно Glu Mobile випустили продовження під назвою Samurai VS Zombies 2 (шкода, але Amazon ще не встиг у себе викласти адаптовану під Kindle Fire версію), яку вже можна безкоштовно скачати у Google Play.', '2013-04-01', '2013-04-01', 1),
(14, 'Wack-a-Mole', 'Wack-a-Mole на LabVIEW', 'Продовжуємо розпочату у попередній статті розробку гри Wack-a-Mole на LabVIEW. Основну частину функціоналу гри було вже розроблено попереднього разу, але що ж це за така гра, у якій не можливо програти? Тепер займемося створенням проблем для гравців ', '2013-04-01', '2013-04-01', 1),
(15, 'WiFi-роутер', 'Як налаштувати передачу 3G інтернету на WiFi-', 'Уявіть собі ситуацію: маєте ви 3G модем, комп’ютер і кілька девайсів з андроїдом, які інтернету хочуть, але модем їм підключити нікуди, а через провід з комп’ютера аж ніяк не зручно. Звичайно, у часи швидкісного анліму така проблема стоїть перед дуже обмеженим колом людей, але так сталося, що мені “пощастило” бути одним із них. Отож, треба щось робити і найбільш очевидним варіантом видається покупка недорогого Wi-Fi роутера з тим, щоб роздавати смартфонам і планшетам інтернет через нього.', '2013-04-01', '2013-04-01', 1),
(16, 'Мотопрогулянка', 'Мотопрогулянка “Дніпром” до Байкалу', 'Коли я вперше побачив фразу “Дніпром до Байкалу”, то вирішив, що або у мене, або ж у її автора щось не гаразд із географією: Дніпро, наче, впадає у Чорне море, а Байкал – то озеро взагалі десь на краю світу, у сибірах… Вже потім до мене дійшло, що мався на увазі мотоцикл “Дніпро”, та навіть тоді ідея податися до Байкалу на такому транспорті виглядала божевільною. ', '2013-04-01', '2013-04-01', 1),
(17, 'LabVIEW: вгадуємо', 'LabVIEW: вгадуємо число діленням навпіл', 'Давненько я вже нічого не писав сюди. Не було про що, аж ось один дописувач виручив і підкинув нескладну, наче, задачку на e-mail. Суть задачки зводиться до вгадування задуманого користувачем числа методом ділення навпіл. “Користувач загадує число в межах від 0 до 200 і потрібно створити інструмент, який методом поділу на 2 буде відгадувати це число.”', '2013-04-01', '2013-04-01', 1),
(56, 'ww', 'wwwww', ' URL SPAM ', '2013-04-01', '2013-04-01', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
