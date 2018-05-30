<?php

namespace App\Containers\Settings\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;

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
        $settings = Hive::call('Settings@GetAllSettingsTask', [], ['addRequestCriteria', 'ordered']);

        return $settings;
    }
}
