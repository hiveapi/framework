<?php

namespace App\Containers\Payment\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;

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
        $user = Hive::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = Hive::call('Payment@GetAllPaymentAccountsTask',
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
