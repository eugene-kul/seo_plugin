<?php return [
    'plugin' => [
        'name' => 'SEO (Sitemap/Robots/Open Graph)',
        'description' => 'Плагин для SEO разметки и генерации Sitemap.xml и Robots.txt'
    ],

    'config' => [
        'description' => 'Настройки sitemap.xml и robots.txt',
        'meta_title' => 'Заголовок страницы (META title)',
        'meta_description' => 'Описание страницы (META description)',
        'index' => 'Укажите, должны ли поисковые системы индексировать эту страницу',
        'follow' => 'Укажите, должны ли поисковые системы переходить по ссылкам на этой странице',
        'use_in_sitemap' => 'Включить страницу в sitemap.xml',
        'model_class' => [
            'label' => 'PHP Class для списка страниц в Sitemap.xml',
            'comment' => 'Author\Plugin\Models\modelClass, можно указывать несколько через запятую'
        ],
        'priority' => 'Приоритет страницы',
        'og_title' => 'По умолчанию используется значение из перемнной META title',
        'og_type' => 'По умолчанию используется значение "website"',
        'og_description' => 'По умолчанию используется значение из переменной META description',
        'og_image' => 'По умолчанию используется значение из глобальных настроек',
        'og_ref_image' => 'Переменная для og:image',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Вкладки Sitemap и Open Graph',
            'meta' => 'Вкладка Meta',
            'settings' => 'Настройки плагина',
        ]
    ],

    'settings' => [
        'enable_robots_txt' => 'Использовать robots.txt',
        'enable_robots_meta' => 'Использовать meta теги robots',
        'enable_sitemap' => 'Использовать sitemap.xml',
        'use_canonical' => 'Использовать тег Canonical',
        'site_name' => [
            'label' => 'Название сайта/организации',
            'label_pos' => 'Отображать имя сайта',
            'prefix_pos' => 'В начале заголовка',
            'suffix_pos' => 'В конце заголовка',
            'nowhere_pos' => 'Отключено',
            'comment_pos' => 'Выберите, как название сайта должно отображаться в заголовке Title',
            'separator' => 'Разделитель названия сайта',
            'separator_comment' => 'Символ для отделения названия сайта от заголовка, например: Page Title | SiteName',
        ],
        'stock_description' => [
            'label' => 'Универсальный Мета тег description',
            'comment' => 'Используется, если у страницы не заполнен мета тег description',
        ],
        'enable_robots_txt' => 'Использовать robots.txt',
        'extra_meta' => 'Дополнительные теги в <head>',
        'enable_og' => 'Использовать Open Graph',
    ],

    'component' => [
        'description' => 'Отображает мета-теги SEO',
    ]
];