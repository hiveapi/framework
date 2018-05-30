<?php

namespace App\Containers\Settings\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class UpdateSettingAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateSettingAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     */
    public function run(DataTransporter $data)
    {
        $sanitizedData = $data->sanitizeInput([
            'key',
            'value'
        ]);

        $setting = Hive::call('Settings@UpdateSettingTask', [$data->id, $sanitizedData]);

        return $setting;
    }
}
