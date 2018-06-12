<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\FindPermissionTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Authorization\Exceptions\PermissionNotFoundException;
use App\Containers\Authorization\Models\Permission;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindPermissionAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindPermissionAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Permission
     * @throws  PermissionNotFoundException
     */
    public function run(DataTransporter $data): Permission
    {
        $permission = Hive::call(FindPermissionTask::class, [$data->id]);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

}
