<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetAllRolesTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GetAllRolesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllRolesAction extends Action
{

    /**
     * @return mixed
     */
    public function run()
    {
        $roles = Hive::call(GetAllRolesTask::class, [], ['addRequestCriteria']);

        return $roles;
    }

}
