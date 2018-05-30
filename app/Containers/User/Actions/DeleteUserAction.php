<?php

namespace App\Containers\User\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeleteUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data): void
    {
        $user = $data->id ?
            Hive::call('User@FindUserByIdTask',
                [$data->id]) : Hive::call('Authentication@GetAuthenticatedUserTask');

        Hive::call('User@DeleteUserTask', [$user]);
    }
}
