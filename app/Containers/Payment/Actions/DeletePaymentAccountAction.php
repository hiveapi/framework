<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
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
        $user = Hive::call(GetAuthenticatedUserTask::class);

        $paymentAccount = Hive::call(FindPaymentAccountByIdTask::class, [$data->id]);

        // check if this account belongs to our user
        Hive::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        Hive::call(DeletePaymentAccountTask::class, [$paymentAccount]);
    }
}
