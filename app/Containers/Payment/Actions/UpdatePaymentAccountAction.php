<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Containers\Payment\Tasks\UpdatePaymentAccountTask;
use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class UpdatePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdatePaymentAccountAction extends Action
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

        $data = $data->sanitizeInput([
            'name'
        ]);

        $paymentAccount = Hive::call(UpdatePaymentAccountTask::class, [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
