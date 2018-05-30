<?php

namespace App\Containers\Payment\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class FindPaymentAccountDetailsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FindPaymentAccountDetailsAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Payment\Models\PaymentAccount
     */
    public function run(DataTransporter $data): PaymentAccount
    {
        $user = Hive::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Hive::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Hive::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
