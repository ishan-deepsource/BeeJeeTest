-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.19-MariaDB-log - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица beejee.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `date_creating` bigint(20) NOT NULL,
  `date_updating` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='Задачи';

-- Дамп данных таблицы beejee.tasks: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` (`id`, `status`, `name`, `email`, `content`, `date_creating`, `date_updating`) VALUES
	(1, 1, 'Максим', 'mxm.zhuravlev@yandex.ru', 'Тест 123567', 0, 0),
	(2, 1, 'Иван', 'ivan@example.com', '1234567', 0, 0),
	(3, 0, 'Алексей', 'alexey@gmail.com', '7891234', 0, 0),
	(4, 0, 'Денис', 'mail@test.com', '3243243', 0, 0),
	(5, 0, 'Антон', 'email@yandex.ru', 'описание... 22', 0, 0),
	(6, 1, '23132132', '132132132@test.ru', '3213213', 0, 0),
	(7, 1, 'НОВАЯ ЗАДАЧА', 'test@mail.ru', '&lt;script&gt;alert(&#039;xs432432s&#039;);&lt;/script&gt; 6', 0, 1627481962),
	(8, 0, '76576', '5765765765@mail.ru', '765765765765', 1627483235, 1627483235);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Дамп структуры для таблица beejee.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  `password` binary(32) NOT NULL,
  `session` char(32) CHARACTER SET cp1251 COLLATE cp1251_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Дамп данных таблицы beejee.users: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `session`) VALUES
	(1, 'admin', _binary 0xa665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3, 'Y5EfnMU0CXBkQfRkeP3WT1cUMbQpPXMM');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
