<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Hive::call(CreatePermissionTask::class, ['manage-roles', 'Create, Update, Delete, Get All, Attach/detach permissions to Roles and Get All Permissions.']);
        Hive::call(CreatePermissionTask::class, ['create-admins', 'Create new Users (Admins) from the dashboard.']);
        Hive::call(CreatePermissionTask::class, ['manage-admins-access', 'Assign users to Roles.']);
        Hive::call(CreatePermissionTask::class, ['access-dashboard', 'Access the admins dashboard.']);

        // ...

    }
}
