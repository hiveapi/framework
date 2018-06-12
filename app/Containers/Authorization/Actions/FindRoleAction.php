<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\FindRoleTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Models\Role;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Role
     * @throws  RoleNotFoundException
     */
    public function run(DataTransporter $data): Role
    {
        $role = Hive::call(FindRoleTask::class, [$data->id]);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

}
