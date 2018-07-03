<?php

// API Version root route (starts with /v{number}/)
$router->get('/', [
    'as'   => 'api_v1_welcome_version',
    'uses' => 'Controller@v1ApiLandingPage',
]);
