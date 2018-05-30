<?php

namespace App\Containers\Authorization\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Spatie\Permission\Contracts\Role;

/**
 * Class DeleteRoleAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteRoleAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \Spatie\Permission\Contracts\Role
     */
    public function run(DataTransporter $data): Role
    {
        $role = Hive::call('Authorization@FindRoleTask', [$data->id]);

        Hive::call('Authorization@DeleteRoleTask', [$role]);

        return $role;
    }
}
