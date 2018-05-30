<?php

namespace App\Containers\Authorization\Actions;

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
        $role = Hive::call('Authorization@FindRoleTask', [$data->role_id]);

        $role = Hive::call('Authorization@DetachPermissionsFromRoleTask', [$role, $data->permissions_ids]);

        return $role;
    }
}
