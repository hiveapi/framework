<?php

namespace App\Containers\User\Data\Seeders;

use App\Containers\Authorization\Tasks\CreatePermissionTask;
use App\Ship\Parents\Seeders\Seeder;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class UserPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Hive::call(CreatePermissionTask::class, ['search-users', 'Find a User in the DB.']);
        Hive::call(CreatePermissionTask::class, ['list-users', 'Get All Users.']);
        Hive::call(CreatePermissionTask::class, ['update-users', 'Update a User.']);
        Hive::call(CreatePermissionTask::class, ['delete-users', 'Delete a User.']);
        Hive::call(CreatePermissionTask::class, ['refresh-users', 'Refresh User data.']);

        // ...

    }
}
