<?php

return [
    'plugin' => [
        'name' => 'RssReader',
        'description' => 'Получение и отображение лент новостей с других сайтов'
    ],
    'backend' => [
        'label' => 'Rss Reader',
        'description' => 'Ленты новостей',
    ],
    'backend_channel' => [
        'menu_label' => 'Каналы новостей',
        'manage_channels' => 'Управление каналами',
        'record_name_channel' => 'Канал',
        'new_channel' => 'Новый канал',
        'create_channel' => 'Создать канал',
        'edit_channel' => 'Изменить канал',
        'preview_channel' => 'Предпросмотр канала',
        'channels' => 'Каналы',
        'return_to_list' => 'Вернуться к списку каналов',
        'delete_confirm' => 'Вы действительно хотите удалить этот канал?',
        'name' => 'Название',
        'title' => 'Заголовок',
        'description' => 'Описание',
        'url' => 'URL',
        'slug' => 'Идентификатор канала',
        'language' => 'Язык',
        'date_format' => 'Формат даты',
    ],
    'rss_channel' => [
        'name' => 'Rss Channel',
        'description' => 'Вывод новостей на страницу',
        'channel_title' => 'Канал',
        'channel_description' => 'Выбранный канал',
        'itemsperpage_title' => 'Количество на странице',
        'items_per_page_validation' => 'Неверный формат значения количества на страницу',
        'mode_title' => 'Режим',
        'mode_description' => 'Режим отображения',
        'mode_option_full' => 'Заголовки и содержимое',
        'mode_option_short' => 'Только заголовки',
        'showpager_title' => 'Навигация',
        'showpager_description' => 'Показывать страничную навигацию',
        'showpager_option_show' => 'Показывать',
        'showpager_option_hide' => 'Скрывать',
        'feedpage_title' => 'Страница вывода',
        'feedpage_description' => 'Страница полного вывода новостей',
        'pagenumber_title' => 'Номер страницы',
        'show_all' => 'Показать все',
    ],
];

