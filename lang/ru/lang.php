<?php return [
    'plugin' => [
        'name' => 'SEO Pro',
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
        'changefreq' => 'Частота изменения страницы',
        'og_title' => 'По умолчанию используется значение из перемнной META title',
        'og_type' => 'По умолчанию используется значение "website"',
        'og_description' => 'По умолчанию используется значение из переменной META description',
        'og_image' => 'По умолчанию используется значение из глобальных настроек',
        'og_ref_image' => 'Переменная twig для og:image',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Вкладка Sitemap и Open Graph',
            'meta' => 'Вкладка Meta',
            'settings' => 'Настройки плагина',
        ]
    ],

    'settings' => [
        'enable_sitemap' => 'Использовать sitemap.xml',
        'use_canonical' => 'Использовать тег Canonical',
        'stock_description' => [
            'label' => 'Универсальный Мета тег description',
            'comment' => 'Используется, если у страницы не заполнен мета тег description',
        ],
        'enable_robots_txt' => 'Использовать robots.txt',
        'enable_robots_meta' => 'Использовать meta теги robots',
        'extra_meta' => 'Дополнительные теги в <head>',
        'enable_og' => 'Использовать Open Graph',
    ],

    'component' => [
        'description' => 'Отображает мета-теги SEO',
    ]
];