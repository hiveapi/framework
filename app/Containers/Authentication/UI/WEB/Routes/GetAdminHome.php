<?php

$router->get('/', [
    'as'   => 'web_v1_authentication_get_admin_home_page',
    'uses' => 'Controller@showLoginPage',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
