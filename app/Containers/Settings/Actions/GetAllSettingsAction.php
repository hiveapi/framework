<?php

namespace App\Containers\Settings\Actions;

use App\Containers\Settings\Tasks\GetAllSettingsTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GetAllSettingsAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetAllSettingsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $settings = Hive::call(GetAllSettingsTask::class, [], ['addRequestCriteria', 'ordered']);

        return $settings;
    }
}
