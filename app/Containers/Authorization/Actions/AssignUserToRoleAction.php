<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Containers\User\Models\User;
use App\Containers\User\Tasks\FindUserByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class AssignUserToRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class AssignUserToRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data): User
    {
        $user = Hive::call(FindUserByIdTask::class, [$data->user_id]);

        // convert to array in case single ID was passed
        $rolesIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Hive::call(FindRoleTask::class, [$roleId]);
        }, $rolesIds);

        $user = Hive::call(AssignUserToRoleTask::class, [$user, $roles]);

        return $user;
    }
}
