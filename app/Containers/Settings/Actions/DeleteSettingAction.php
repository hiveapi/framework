<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\DeleteSettingTask;
use App\Containers\Settings\Tasks\FindSettingByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class DeleteSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data): void
    {
        $setting = Hive::call(FindSettingByIdTask::class, [$data->id]);

        Hive::call(DeleteSettingTask::class, [$setting]);
    }
}
