<?php

namespace App\Containers\Settings\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Settings\Models\Setting;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

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

        $setting = Hive::call('Settings@CreateSettingTask', [$data]);

        return $setting;
    }
}
