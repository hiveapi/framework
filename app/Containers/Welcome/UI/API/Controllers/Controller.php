<?php

namespace App\Containers\Welcome\UI\API\Controllers;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function apiRoot()
    {
        $message = Hive::call('Welcome@FindMessageForApiRootVisitorAction');

        return response()->json($message);
    }

    /**
     * @return  \Illuminate\Http\JsonResponse
     */
    public function v1ApiLandingPage()
    {
        $message = Hive::call('Welcome@FindMessageForApiV1VisitorAction');

        return response()->json($message);
    }

}
