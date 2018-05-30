<?php

namespace App\Containers\Payment\Actions;

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
        $user = Hive::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Hive::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Hive::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $data = $data->sanitizeInput([
            'name'
        ]);

        $paymentAccount = Hive::call('Payment@UpdatePaymentAccountTask', [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
