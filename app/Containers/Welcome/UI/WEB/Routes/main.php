<?php

$router->get('/', [
    'as'   => 'web_v1_welcome_get_main_home_page',
    'uses' => 'Controller@sayWelcome',
]);
