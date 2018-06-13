<?php

namespace App\Containers\Authorization\Actions;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class CreatePermissionAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreatePermissionAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Authorization\Models\Permission
     */
    public function run(DataTransporter $data): Permission
    {
        $permission = Hive::call(CreatePermissionTask::class,
            [$data->name, $data->description, $data->display_name]
        );

        return $permission;
    }
}
