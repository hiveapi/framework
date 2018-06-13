<?php

namespace App\Containers\Localization\UI\API\Controllers;

use App\Containers\Localization\Actions\GetAllLocalizationsAction;
use App\Containers\Localization\UI\API\Requests\GetAllLocalizationsRequest;
use App\Containers\Localization\UI\API\Transformers\LocalizationTransformer;
use App\Ship\Parents\Controllers\ApiController;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class Controller
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class Controller extends ApiController
{
    /**
     * Get all supported Localizations of the application.
     *
     * @param GetAllLocalizationsRequest $request
     *
     * @return array
     */
    public function getAllLocalizations(GetAllLocalizationsRequest $request)
    {
        $localizations = Hive::call(GetAllLocalizationsAction::class);

        return $this->transform($localizations, LocalizationTransformer::class);
    }
}
