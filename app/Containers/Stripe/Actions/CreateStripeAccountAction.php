<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Stripe\Tasks\CreateStripeAccountTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  mixed
     */
    public function run(DataTransporter $data)
    {
        $user = Hive::call(GetAuthenticatedUserTask::class);

        $sanitizedData = $data->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
            'nickname',
        ]);

        $account = Hive::call(CreateStripeAccountTask::class, [$sanitizedData]);

        $result = Hive::call(AssignPaymentAccountToUserTask::class, [$account, $user, $sanitizedData['nickname']]);

        return $result;
    }

}
