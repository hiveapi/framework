<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GetAllPermissionsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllPermissionsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $permissions = Hive::call(GetAllPermissionsTask::class, [], ['addRequestCriteria']);

        return $permissions;
    }

}
