<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CheckIfUserIsConfirmedTask;
use App\Containers\Authentication\Tasks\WebLoginTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Authorization\Exceptions\UserNotAdminException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebAdminLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebAdminLoginAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return Authenticatable
     * @throws UserNotAdminException
     */
    public function run(DataTransporter $data) : Authenticatable
    {
        $user = Hive::call(WebLoginTask::class,
            [$data->email, $data->password, $data->remember_me ?? false]);

        Hive::call(CheckIfUserIsConfirmedTask::class, [], [['setUser' => [$user]]]);

        if (!$user->hasAdminRole()) {
            throw new UserNotAdminException();
        }

        return $user;
    }
}
