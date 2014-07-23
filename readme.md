Структура таблицы `notice`

    CREATE TABLE `notice` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `user_id` int(11) NOT NULL,
      `text` text NOT NULL,
      `url` varchar(255) DEFAULT NULL,
      `read` tinyint(1) DEFAULT '0',
      `dismiss` tinyint(1) DEFAULT '0',
      `color` varchar(255) DEFAULT 'success',
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
