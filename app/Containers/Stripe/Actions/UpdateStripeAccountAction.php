<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\Stripe\Tasks\FindStripeAccountByIdTask;
use App\Containers\Stripe\Tasks\UpdateStripeAccountTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class UpdateStripeAccountAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UpdateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Stripe\Models\StripeAccount
     */
    public function run(DataTransporter $data): StripeAccount
    {
        $user = Hive::call(GetAuthenticatedUserTask::class);

        // check, if this account does - in fact - belong to our user
        $account = Hive::call(FindStripeAccountByIdTask::class, [$data->id]);
        $paymentAccount = $account->paymentAccount;
        Hive::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        // we own this account - so it is safe to update it
        $sanitizedData = $data->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $account = Hive::call(UpdateStripeAccountTask::class, [$account, $sanitizedData]);

        return $account;
    }
}
