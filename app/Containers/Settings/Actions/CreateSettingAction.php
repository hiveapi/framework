<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Models\Setting;
use App\Containers\Settings\Tasks\CreateSettingTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class CreateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class CreateSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Settings\Models\Setting
     */
    public function run(DataTransporter $data): Setting
    {
        $data = $data->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Hive::call(CreateSettingTask::class, [$data]);

        return $setting;
    }
}
