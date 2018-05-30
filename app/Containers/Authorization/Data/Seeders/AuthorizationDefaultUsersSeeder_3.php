<?php

namespace App\Containers\Authorization\Data\Seeders;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationDefaultUsersSeeder_3
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationDefaultUsersSeeder_3 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Users (with their roles) ---------------------------------------------
        Hive::call('User@CreateUserByCredentialsTask', [
            $isClient = false,
            'admin@admin.com',
            'admin',
            'Super Admin',
        ])->assignRole(Hive::call('Authorization@FindRoleTask', ['admin']));

        // ...

    }
}
