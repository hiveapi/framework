<?php

namespace App\Containers\Authorization\UI\CLI\Commands;

use App\Containers\Authorization\Exceptions\RoleNotFoundException;
use App\Containers\Authorization\Tasks\FindRoleTask;
use App\Containers\Authorization\Tasks\GetAllPermissionsTask;
use App\Ship\Parents\Commands\ConsoleCommand;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GiveAllPermissionsToRoleCommand
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GiveAllPermissionsToRoleCommand extends ConsoleCommand
{

    protected $signature = 'hive:permissions:toRole {role}';

    protected $description = 'Give all system Permissions to a specific Role.';

    /**
     * @void
     */
    public function handle()
    {
        $roleName = $this->argument('role');

        $allPermissions = Hive::call(GetAllPermissionsTask::class, [true]);

        $role = Hive::call(FindRoleTask::class, [$roleName]);

        if (!$role) {
            throw new RoleNotFoundException("Role $roleName is not found!");
        }

        $role->syncPermissions($allPermissionsNames = $allPermissions->pluck('name')->toArray());

        $this->info('Gave the Role (' . $roleName . ') the following Permissions: ' . implode(' - ',
                $allPermissionsNames) . '.');
    }
}
