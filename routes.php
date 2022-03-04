<?php

use Eugene3993\Seo\Classes\Sitemap;
use Eugene3993\Seo\Classes\Robots;
use Eugene3993\Seo\Models\Settings;
use Cms\Classes\Controller;

Route::get('robots.txt', function() {
    $robot = new Robots;
    if (!Settings::get('enable_robots_txt')) {
        return  \App::make(Controller::class)->setStatusCode(404)->run('404');
    } else {
        return \Response::make($robot->generate())->header("Content-Type", "text/plain");
    }
});

Route::get('sitemap.xml', function() {
    $sitemap = new Sitemap;
    if (!Settings::get('enable_sitemap')) {
        return  \App::make(Controller::class)->setStatusCode(404)->run('404');
    } else {
        return \Response::make($sitemap->generate())->header('Content-Type', 'application/xml');
    }
});