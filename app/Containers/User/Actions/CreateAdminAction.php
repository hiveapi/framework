<?php

namespace App\Containers\User\Actions;

use App\Containers\Authorization\Tasks\AssignUserToRoleTask;
use App\Containers\User\Tasks\CreateUserByCredentialsTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\User\Models\User;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class CreateAdminAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdminAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data): User
    {
        $admin = Hive::call(CreateUserByCredentialsTask::class, [
            $isClient = false,
            $data->email,
            $data->password,
            $data->name
        ]);

        // NOTE: if not using a single general role for all Admins, comment out that line below. And assign Roles
        // to your users manually. (To list admins in your dashboard look for users with `is_client=false`).
        Hive::call(AssignUserToRoleTask::class, [$admin, ['admin']]);

        return $admin;
    }
}
