<?php

namespace App\Containers\Payment\Tests\Seeders;

use App\Containers\Credit\Tasks\CreateCreditAccountTask;
use App\Containers\Label\Models\Label;
use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;
use HiveApi\Core\Foundation\Facades\Hive;
use HiveApi\Core\Traits\Tests\TestsUserHelperTrait;

/**
 * Class PaymentTestSeeder
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class PaymentTestSeeder extends Seeder
{
    use TestsUserHelperTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = $this->getTestingUser(
            ['email' => 'payment1@local.host']
        );
        $this->createPaymentAccount($user1);
        $this->createPaymentAccount($user1);

        $user2 = $this->getTestingUser(
            ['email' => 'payment2@local.host']
        );
        $this->createPaymentAccount($user2);
    }

    private function createPaymentAccount(User $user)
    {
        $account = Hive::call(CreateCreditAccountTask::class, [[]]);
        Hive::call(AssignPaymentAccountToUserTask::class, [$account, $user, 'TESTING ACCOUNT USER ' . $user->id]);
    }

}
