<?php

namespace App\Containers\User\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Tasks\DeleteUserTask;
use App\Containers\User\Tasks\FindUserByIdTask;
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
            Hive::call(FindUserByIdTask::class,
                [$data->id]) : Hive::call(GetAuthenticatedUserTask::class);

        Hive::call(DeleteUserTask::class, [$user]);
    }
}
