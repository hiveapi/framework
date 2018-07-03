<?php

// API Root route
$router->get('/', [
    'as'   => 'api_v1_welcome_root',
    'uses' => 'Controller@apiRoot',
]);
