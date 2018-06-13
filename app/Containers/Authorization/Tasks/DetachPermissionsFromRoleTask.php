<?php

namespace App\Containers\Authorization\Tasks;

use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Tasks\Task;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class DetachPermissionsFromRoleTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DetachPermissionsFromRoleTask extends Task
{

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     * @param                                           $singleOrMultiplePermissionIds
     *
     * @return  \App\Containers\Authorization\Models\Role
     */
    public function run(Role $role, $singleOrMultiplePermissionIds): Role
    {
        if (!is_array($singleOrMultiplePermissionIds)) {
            $singleOrMultiplePermissionIds = [$singleOrMultiplePermissionIds];
        };

        // remove each permission ID found in the array from that role.
        array_map(function ($permissionId) use ($role) {
            $permission = Hive::call(FindPermissionTask::class, [$permissionId]);
            $role->revokePermissionTo($permission);
        }, $singleOrMultiplePermissionIds);

        return $role;
    }
}
