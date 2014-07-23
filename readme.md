Структура таблицы `notice`
--------------------------

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

Пример конфигурации
-------------------

    Yii::setPathOfAlias('noticeModule', '/path/to/notice/dir');

    return [
        // ...
        'modules'    => [
            // ...
            'notice' => ['class' => 'noticeModule.NoticeModule'],
            // ...
        ],
        // ...
        'components' => [
            // ...
            'notice' => ['class' => 'notice.components.NoticeComponent'],
            // ...
        ]
    ];

Примеры использования:
----------------------
Подключение виджета:

    $this->widget('notice.widgets.NoticeWidget', ['userId' => 123]);
    // Параметр userId не обязателен.
    // Если он не передан userId будет получен из Yii::app()->user->id

Добавление оповещения:

    Yii::app()->notice->add(123, 'text', 'url', 'success');
    // 123 - ID пользователя (обязательно)
    // text - Текст оповещения (обязательно)
    // url - URL для перехода (необязательно)
    // success - Цвет оповещения (необязательно, по умолчанию 'success').
    // Возможные значения цвета: success, info, warning, danger