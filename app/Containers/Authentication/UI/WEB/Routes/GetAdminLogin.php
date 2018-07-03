<?php

$router->get('/login', [
    'as'   => 'web_v1_authentication_get_admin_login_page',
    'uses' => 'Controller@showLoginPage',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
