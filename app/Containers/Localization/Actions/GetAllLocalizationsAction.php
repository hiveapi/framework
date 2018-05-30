<?php

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;
use Illuminate\Support\Collection;

/**
 * Class GetAllLocalizationsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllLocalizationsAction extends Action
{

    /**
     * @return  \Illuminate\Support\Collection
     */
    public function run(): Collection
    {
        $localizations = Hive::call('Localization@GetAllLocalizationsTask');

        return $localizations;
    }
}
