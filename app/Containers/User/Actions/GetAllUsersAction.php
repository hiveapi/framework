<?php

namespace App\Containers\User\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllUsersAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllUsersAction extends Action
{

    /**
     * @return mixed
     */
    public function run()
    {
        return Hive::call('User@GetAllUsersTask',
            [],
            [
                'addRequestCriteria',
                'ordered',
            ]
        );
    }
}
