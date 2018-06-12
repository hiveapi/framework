<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\DetachPermissionsFromRoleTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DetachPermissionsFromRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(DataTransporter $data): Role
    {
        $role = Hive::call(FindRoleTask::class, [$data->role_id]);

        $role = Hive::call(DetachPermissionsFromRoleTask::class, [$role, $data->permissions_ids]);

        return $role;
    }
}
