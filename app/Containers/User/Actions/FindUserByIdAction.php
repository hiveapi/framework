<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\FindUserByIdTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindUserByIdAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindUserByIdAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return User
     * @throws NotFoundException
     */
    public function run(DataTransporter $data): User
    {
        $user = Hive::call(FindUserByIdTask::class, [$data->id]);

        if (!$user) {
            throw new NotFoundException();
        }

        return $user;
    }

}
