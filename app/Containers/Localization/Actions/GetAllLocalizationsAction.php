<?php

namespace App\Containers\Localization\Actions;

use App\Containers\Localization\Tasks\GetAllLocalizationsTask;
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
        $localizations = Hive::call(GetAllLocalizationsTask::class);

        return $localizations;
    }
}
