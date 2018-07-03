<?php

/**
 * @apiGroup           Users
 * @apiName            getAuthenticatedUser
 *
 * @api                {GET} /v1/my/profile Get Logged in User data
 * @apiDescription     Get the user details of the logged in user from its Token (without specifying his ID)
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiUse             UserSuccessSingleResponse
 */

$router->get('my/profile', [
    'as' => 'api_v1_user_get_authenticated_user',
    'uses'  => 'Controller@getAuthenticatedUser',
    'middleware' => [
      'auth:api',
    ],
]);
