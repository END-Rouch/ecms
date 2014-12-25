-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.38-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица test.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `desc` text NOT NULL,
  `keyword` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.category: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`, `desc`, `keyword`) VALUES
	(1, 'О сайте', 'Категория об жизни сайта', 'Сайт, О сайте, Жизнь сайта'),
	(2, 'В мире', 'Категория о мире', 'Мир, В мире, Мой мир, Новости мира'),
	(3, 'Экономика', '', ''),
	(4, 'Религия', '', ''),
	(5, 'Криминал', '', ''),
	(6, 'Спорт', '', ''),
	(7, 'Культура', '', ''),
	(8, 'Инопресса', '', '');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Дамп структуры для таблица test.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `href` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.menu: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `href`) VALUES
	(1, 'Главная', '/home/');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Дамп структуры для таблица test.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `min_text` text NOT NULL,
  `full_text` text NOT NULL,
  `tags` text NOT NULL,
  `by` int(11) NOT NULL,
  `date` date NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.news: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `min_text`, `full_text`, `tags`, `by`, `date`, `category`) VALUES
	(1, 'Elementary CMS - это бесплатный движок для создание сайта', '[center][img=/static/images/ecms_logo.png alt=Elementary CMS]\r\n[br]\r\n[b]Elementary CMS[/b] - это бесплатный движок для создание сайта {:emot-1:}[/center]', '[center]\r\n[img=/static/images/ecms_logo.png alt=Elementary CMS]\r\n[br]\r\n[b]Elementary CMS[/b] - это бесплатный движок для создание сайта с минимальным функционалом. {:emot-1:}[br]\r\nИ удобным дизайном для вашего первого или по следующего веб-сайта.[br]\r\nХотите сделать выбор? Elementary CMS вот что вам нужно![br]\r\nДанный движок распространяется по генеральной лицензии GNU/GPL v2 {:emot-2:}\r\n[/center]', 'ECMS,Elementary,Elementary CMS,CMS,Бесплатный движок', 1, '2014-10-30', 1);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Дамп структуры для таблица test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `name` text NOT NULL,
  `family` text NOT NULL,
  `email` text NOT NULL,
  `groupid` int(11) NOT NULL,
  `password` text NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `about` text NOT NULL,
  `activate` int(11) NOT NULL,
  `register` date DEFAULT NULL,
  `last_visit` text,
  `session_id` text NOT NULL,
  `last_ip` text NOT NULL,
  `last_browser` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test.users: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `name`, `family`, `email`, `groupid`, `password`, `balance`, `about`, `activate`, `register`, `last_visit`, `session_id`, `last_ip`, `last_browser`) VALUES
	(1, 'admin', 'Администратор', 'сайта', 'admin@cms.ru', 1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 100, 'Управляю данным сайтом на основе Elementary CMS :)', 1, '2014-10-14', '2014-10-30,06:37', '2d324e0a864e5f744dfd39dff89c99961c8784f9', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36'),
	(2, 'moderator', 'Модератор', 'сайта', 'moder@cms.ru', 2, '79f52b5b92498b00cb18284f1dcb466bd40ad559', 5, 'Слежу за хулиганами :)', 1, '2014-10-14', '2014-10-14,04:23', '5c50923505cf04602296a3e543eadac5317d4430', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 YaBrowser/14.8.1985.11875 Safari/537.36'),
	(3, 'editor', 'Редактор', 'сайта', 'editor@cms.ru', 3, 'ab41949825606da179db7c89ddcedcc167b64847', 1, 'Добавляю разный контент на сайт.', 1, '2014-10-14', '2014-10-14,03:28', 'a065911f9b65945528733b63999b23d4c8a03ed8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 YaBrowser/14.8.1985.11875 Safari/537.36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
