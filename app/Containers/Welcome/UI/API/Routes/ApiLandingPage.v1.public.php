<?php

// API Version root route (starts with /v{number}/)
$router->get('/', [
    'as'   => 'api_v1_welcome_landing_route',
    'uses' => 'Controller@v1ApiLandingPage',
]);
