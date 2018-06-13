<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Tasks\CheckIfUserIsConfirmedTask;
use App\Containers\Authentication\Tasks\WebLoginTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class WebLoginAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class WebLoginAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \Illuminate\Contracts\Auth\Authenticatable
     */
    public function run(DataTransporter $data): Authenticatable
    {
        $user = Hive::call(WebLoginTask::class, [$data->email, $data->password, $data->remember]);

        Hive::call(CheckIfUserIsConfirmedTask::class, [], [['setUser' => [$user]]]);

        return $user;
    }
}
