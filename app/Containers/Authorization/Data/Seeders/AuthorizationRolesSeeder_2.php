<?php

namespace App\Containers\Authorization\Data\Seeders;

use App\Containers\Authorization\Tasks\CreateRoleTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationRolesSeeder_2
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationRolesSeeder_2 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------
        Hive::call(CreateRoleTask::class, ['admin', 'Administrator', 'Administrator Role', 999]);

        // ...

    }
}
