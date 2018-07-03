<?php

// provider callback handler
$router->any('auth/{provider}/callback', [
    'as' => 'web_v1_socialauth_callback',
    'uses' => 'Controller@handleCallbackAll',
]);

