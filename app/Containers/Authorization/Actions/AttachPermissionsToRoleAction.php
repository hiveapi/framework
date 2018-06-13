<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Models\Role;
use App\Containers\Authorization\Tasks\FindPermissionTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class AttachPermissionsToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(DataTransporter $data): Role
    {
        $role = Hive::call(FindRoleTask::class, [$data->role_id]);

        // convert to array in case single ID was passed
        $permissionIds = (array) $data->permissions_ids;

        $permissions = array_map(function ($permissionId) {
            return Hive::call(FindPermissionTask::class, [$permissionId]);
        }, $permissionIds);

        $role = $role->givePermissionTo($permissions);

        return $role;
    }
}
