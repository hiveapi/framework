<?php

namespace App\Containers\User\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;

/**
 * Class GetAllAdminsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdminsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        return Hive::call('User@GetAllUsersTask',
            [],
            [
                'addRequestCriteria',
                'admins',
                'ordered',
            ]
        );
    }
}
