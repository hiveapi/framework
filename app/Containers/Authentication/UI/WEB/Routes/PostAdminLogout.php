<?php

$router->post('/logout', [
    'as'   => 'web_v1_authentication_post_admin_logout_form',
    'uses' => 'Controller@logoutAdmin',
    'domain' => 'admin.'. parse_url(\Config::get('app.url'))['host'],
]);
