<?php return [
    'plugin' => [
        'name' => 'Seo (Sitemap/Robots/Open Graph)',
        'description' => 'Plugin for SEO markup and generation Sitemap.xml and Robots.txt'
    ],

    'config' => [
        'description' => 'Configure sitemap.xml and robots.txt',
        'meta_title' => 'META title',
        'meta_description' => 'META description',
        'use_in_sitemap' => 'Enable in the Sitemap.xml',
        'model_class' => [
            'label' => 'Associate this page with a model links will be generated from it\s records',
            'comment' => 'Author\Plugin\Models\modelClass, you can specify several separated by commas'
        ],
        'priority' => 'Page priority',
        'og_title' => 'By default, the value from the META title variable is used',
        'og_type' => 'The default value is "website"',
        'og_description' => 'By default, the value from the META description variable is used',
        'og_image' => 'By default, the value from the global settings is used',
        'og_ref_image' => 'Variable for og:image',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Sitemap and Open Graph tab',
            'meta' => 'Meta Tab',
            'settings' => 'Plugin Settings',
        ]
    ],

    'settings' => [
        'enable_sitemap' => 'Use sitemap.xml',
        'use_canonical' => 'Use the Canonical tag',
        'stock_description' => [
            'label' => 'Universal Meta tag description',
            'comment' => 'Used if the description meta tag is not filled in for the page',
        ],
        'enable_robots_txt' => 'Use robots.txt',
        'extra_meta' => 'Additional tags in <head>',
        'enable_og' => 'Use Open Graph',
    ],

    'component' => [
        'description' => 'Renders SEO meta tags in place',
    ]
];