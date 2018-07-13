<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\GetTransactionsForUserTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

class GetMyTransactionsAction extends Action
{
    public function run(DataTransporter $transporter)
    {
        $user = Hive::call(GetAuthenticatedUserTask::class);

        $transactions = Hive::call(GetTransactionsForUserTask::class, [$user]);

        return $transactions;
    }
}
