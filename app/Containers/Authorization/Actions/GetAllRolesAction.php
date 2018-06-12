<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetAllRolesTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;

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
