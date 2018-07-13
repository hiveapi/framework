<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class GetSuitablePaymentAccountOfUserTask extends Task
{

    public function run(User $user, $accountType)
    {
        $accounts = $user->paymentAccounts;

        $suitableAccount = null;

        foreach ($accounts as $account) {
            $typedAccount = $account->accountable;

            if ( ! ($typedAccount instanceof $accountType)) {
                continue;
            }

            $suitableAccount = $account;
            break;
        }

        return $suitableAccount;
    }
}
