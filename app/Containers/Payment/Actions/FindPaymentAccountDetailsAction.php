<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

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
        $user = Hive::call(GetAuthenticatedUserTask::class);

        $paymentAccount = Hive::call(FindPaymentAccountByIdTask::class, [$data->id]);

        // check if this account belongs to our user
        Hive::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
