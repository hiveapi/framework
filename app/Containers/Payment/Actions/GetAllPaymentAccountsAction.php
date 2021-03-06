<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\GetAllPaymentAccountsTask;
use App\Ship\Parents\Actions\Action;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class GetAllPaymentAccountsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllPaymentAccountsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $user = Hive::call(GetAuthenticatedUserTask::class);

        $paymentAccounts = Hive::call(GetAllPaymentAccountsTask::class,
            [],
            [
                'addRequestCriteria',
                'ordered',
                ['filterByUser' => [$user]]
            ]
        );

        return $paymentAccounts;
    }
}
