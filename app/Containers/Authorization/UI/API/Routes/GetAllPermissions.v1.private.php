<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getAllPermissions
 * @api                {get} /v1/permissions Get All Permission
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

$router->get('permissions', [
    'as' => 'api_v1_authorization_get_all_permissions',
    'uses'       => 'Controller@getAllPermissions',
    'middleware' => [
        'auth:api',
    ],
]);
