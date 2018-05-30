<?php

namespace App\Containers\Payment\Actions;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;

/**
 * Class DeletePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeletePaymentAccountAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     */
    public function run(DataTransporter $data): void
    {
        $user = Hive::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Hive::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Hive::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        Hive::call('Payment@DeletePaymentAccountTask', [$paymentAccount]);
    }
}
