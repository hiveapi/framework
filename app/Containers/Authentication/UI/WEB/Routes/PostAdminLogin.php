<?php

$router->post('/login', [
    'as'   => 'web_v1_authentication_post_admin_login_form',
    'uses' => 'Controller@loginAdmin',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
