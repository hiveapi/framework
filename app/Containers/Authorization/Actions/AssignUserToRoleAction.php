<?php

namespace App\Containers\Authorization\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

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
        $user = Hive::call('User@FindUserByIdTask', [$data->user_id]);

        // convert to array in case single ID was passed
        $rolesIds = (array)$data->roles_ids;

        $roles = array_map(function ($roleId) {
            return Hive::call('Authorization@FindRoleTask', [$roleId]);
        }, $rolesIds);

        $user = Hive::call('Authorization@AssignUserToRoleTask', [$user, $roles]);

        return $user;
    }
}
