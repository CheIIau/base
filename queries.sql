-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.19 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп данных таблицы yeticave.categories: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `symbol_code`) VALUES
	(3, 'Ботинки', 'boots'),
	(1, 'Доски и лыжи', 'boards'),
	(5, 'Инструменты', 'tools'),
	(2, 'Крепления', 'attachment'),
	(4, 'Одежда', 'clothing'),
	(6, 'Разное', 'others');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дамп данных таблицы yeticave.lots: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
INSERT INTO `lots` (`id`, `user_id`, `category_id`, `winner_id`, `name`, `detail`, `cost_start`, `step_cost`, `url`, `date_create`, `date_finished`) VALUES
	(1, 1, 1, NULL, '2014 Rossignol District Snowboard', 'JJSSSWEE', 10999.00, 10.00, 'img/lot-1.jpg', '2022-09-07 06:29:13', '2022-04-01 00:00:00'),
	(2, 2, 1, NULL, 'DC Ply Mens 2016/2017 Snowboard0', 'EDFIN', 159999.00, 20.00, 'img/lot-2.jpg', '2022-09-07 06:29:13', '2022-10-20 00:00:00'),
	(3, 3, 2, NULL, 'Крепления Union Contact Pro 2015 года размер L/XL', 'UEUWUQS', 8000.00, 10.00, 'img/lot-3.jpg', '2022-09-07 06:29:13', '2022-04-30 00:00:00'),
	(4, 1, 3, NULL, 'Ботинки для сноуборда DC Mutiny Charocal', 'uuusssxx', 10999.00, 30.00, 'img/lot-4.jpg', '2022-09-07 06:29:13', '2022-08-20 00:00:00'),
	(5, 3, 4, NULL, 'Куртка для сноуборда DC Mutiny Charocal', 'eewwssw', 7500.00, 30.00, 'img/lot-5.jpg', '2022-09-07 06:29:13', '2022-09-21 00:00:00'),
	(6, 2, 6, NULL, 'Маска Oakley Canopy', 'update info', 5400.00, 5.00, 'img/lot-6.jpg', '2022-09-07 06:29:13', '2022-07-20 00:00:00');
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;

-- Дамп данных таблицы yeticave.rates: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id`, `user_id`, `lot_id`, `cost`, `date_create`) VALUES
	(1, 2, 1, 11000.00, '2022-09-07 06:29:13'),
	(2, 3, 2, 170000.00, '2022-09-07 06:29:13'),
	(3, 2, 1, 12000.00, '2022-09-07 06:29:13'),
	(4, 2, 4, 120000.00, '2022-09-07 06:46:58');
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;

-- Дамп данных таблицы yeticave.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `date_registration`, `contact`) VALUES
	(1, 'Игнат', 'ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', '2022-09-07 06:21:40', NULL),
	(2, 'Вован', 'kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', '2022-09-07 06:22:06', NULL),
	(3, 'Руслан', 'warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', '2022-09-07 06:22:25', NULL),
	(4, 'qqqqqqqqqqqqqqq', 'fear_rulez@mail.ru', '$2y$10$1k92lqwV03NTNmZVpDOAdO8OEzcZAMffpIKB5jOMV53MXBpzSkJQG', '2022-09-12 19:06:53', 'qqqqqqqqqqqqqqqqq');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
