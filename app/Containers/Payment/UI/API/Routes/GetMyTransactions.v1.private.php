<?php

/**
 * @apiGroup           Payment
 * @apiName            getMyTransactions
 *
 * @api                {GET} /v1/my/transactions Get My Transactions
 * @apiDescription     Get the transactions of the currently logged in user
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('my/transactions', [
    'as' => 'api_v1_payment_get_my_transactions',
    'uses'  => 'Controller@getMyTransactions',
    'middleware' => [
      'auth:api',
    ],
]);
