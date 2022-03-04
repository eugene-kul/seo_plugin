<?php return [
    'plugin' => [
        'name' => 'Seo(Sitemap/Robots/Open Graph)',
        'description' => '用于 SEO 标记和生成 Sitemap.xml 和 Robots.txt 的插件',
    ],

    'config' => [
        'description' => '配置sitemap.xml和robots.txt',
        'meta_title' => 'Mate标题',
        'meta_description' => 'Mate描述',
        'use_in_sitemap' => '在 Sitemap.xml 中启用',
        'model_class' => [
            'label' => '将此页面与模型链接相关联将从它的记录中生成',
            'comment' => 'Author\Plugin\Models\modelClass，可以指定多个,用逗号隔开',
        ],
        'priority' => '页面优先级',
        'og_title' => '默认情况下，使用 Mate 标题变量中的值',
        'og_type' => '默认值为"website"',
        'og_description' => '默认情况下，使用来自 Mate 描述变量的值',
        'og_image' => '默认情况下，使用全局设置中的值',
        'og_ref_image' => 'og:image的变量',
    ],

    'permissions' => [
        'labels' => [
            'sitemap' => 'Sitemap和Open Graph选项卡',
            'meta' => 'Mate标记选项卡',
            'settings' => '插件设置',
        ]
    ],

    'settings' => [
        'enable_sitemap' => '使用sitemap.xml',
        'use_canonical' => '使用规范标签',
        'stock_description' => [
            'label' => '通用Mate标记描述',
            'comment' => '如果没有为页面填写描述Mate标记，则使用',
        ],
        'enable_robots_txt' => '使用 robots.txt',
        'extra_meta' => '<head>中的附加标签',
        'enable_og' => '使用Open Graph',
    ],

    'component' => [
        'description' => '将 SEO Mate标签呈现在适当的位置',
    ]
];