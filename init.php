<?php

\Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
    $controller->addJs('/plugins/eugene3993/seo/assets/meta_count.js');
});