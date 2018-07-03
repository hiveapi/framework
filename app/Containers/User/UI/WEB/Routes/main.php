<?php

$router->get('/user', [
    'as'   => 'web_v1_user_get_user_home_page',
    'uses' => 'Controller@sayWelcome',
]);
