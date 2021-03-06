<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

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
        return Hive::call(GetAllUsersTask::class,
            [],
            [
                'addRequestCriteria',
                'ordered',
            ]
        );
    }
}
