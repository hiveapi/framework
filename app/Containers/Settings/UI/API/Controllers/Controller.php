<?php

namespace App\Containers\Settings\UI\API\Controllers;

use App\Containers\Settings\Actions\CreateSettingAction;
use App\Containers\Settings\Actions\DeleteSettingAction;
use App\Containers\Settings\Actions\GetAllSettingsAction;
use App\Containers\Settings\Actions\UpdateSettingAction;
use App\Containers\Settings\UI\API\Requests\CreateSettingRequest;
use App\Containers\Settings\UI\API\Requests\DeleteSettingRequest;
use App\Containers\Settings\UI\API\Requests\GetAllSettingsRequest;
use App\Containers\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Containers\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * Get All application settings
     *
     * @param GetAllSettingsRequest $request
     *
     * @return mixed
     */
    public function getAllSettings(GetAllSettingsRequest $request)
    {
        $settings = Hive::call(GetAllSettingsAction::class);

        return $this->transform($settings, SettingTransformer::class);
    }

    /**
     * create a new setting
     *
     * @param CreateSettingRequest $request
     *
     * @return mixed
     */
    public function createSetting(CreateSettingRequest $request)
    {
        $setting = Hive::call(CreateSettingAction::class, [new DataTransporter($request)]);

        return $this->transform($setting, SettingTransformer::class);
    }

    /**
     * Updates an existing setting
     *
     * @param UpdateSettingRequest $request
     *
     * @return mixed
     */
    public function updateSetting(UpdateSettingRequest $request)
    {
        $setting = Hive::call(UpdateSettingAction::class, [new DataTransporter($request)]);

        return $this->transform($setting, SettingTransformer::class);
    }

    /**
     * Removes a setting
     *
     * @param DeleteSettingRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteSetting(DeleteSettingRequest $request)
    {
        Hive::call(DeleteSettingAction::class, [new DataTransporter($request)]);

        return $this->noContent();
    }
}
