<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\GetAllUsersTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GetAllClientsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllClientsAction extends Action
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
                'clients',
                'ordered',
            ]
        );
    }
}
