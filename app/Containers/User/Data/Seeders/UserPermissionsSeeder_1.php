<?php

namespace App\Containers\User\Data\Seeders;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Seeders\Seeder;

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
        Hive::call('Authorization@CreatePermissionTask', ['search-users', 'Find a User in the DB.']);
        Hive::call('Authorization@CreatePermissionTask', ['list-users', 'Get All Users.']);
        Hive::call('Authorization@CreatePermissionTask', ['update-users', 'Update a User.']);
        Hive::call('Authorization@CreatePermissionTask', ['delete-users', 'Delete a User.']);
        Hive::call('Authorization@CreatePermissionTask', ['refresh-users', 'Refresh User data.']);

        // ...

    }
}
