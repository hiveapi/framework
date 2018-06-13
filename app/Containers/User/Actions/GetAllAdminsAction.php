<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

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
        return Hive::call(GetAllUsersTask::class,
            [],
            [
                'addRequestCriteria',
                'admins',
                'ordered',
            ]
        );
    }
}
