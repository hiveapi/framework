<?php

namespace App\Containers\Payment\Tests\Tests\Unit;

use App\Containers\Payment\Exceptions\PaymentAccountDoesNotBelongToUserException;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tests\Seeders\PaymentTestSeeder;
use App\Containers\Payment\Tests\Tests\UnitTester;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\Cests\BaseCest;
use HiveApi\Core\Foundation\Facades\Hive;
use Illuminate\Support\Facades\Artisan;

/**
 * @group   payment
 * @group   unit
 */
class PaymentUnitCheckAccountsTestCest extends BaseCest
{
    public function _before(UnitTester $I)
    {
        Artisan::call('db:seed', ['--class' => PaymentTestSeeder::class]);
    }

    public function _after(UnitTester $I)
    {
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_if_account_belongs_to_own_user(UnitTester $I)
    {
        /** @var User $user */
        $user = User::where('email', '=', 'payment1@local.host')->first();
        $account = $user->paymentAccounts->first();

        $result = Hive::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $account]);
        $I->assertTrue($result);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_if_account_belongs_to_foreign_user(UnitTester $I)
    {
        /** @var User $user */
        $user1 = User::where('email', '=', 'payment1@local.host')->first();
        $user2 = User::where('email', '=', 'payment2@local.host')->first();
        $account = $user1->paymentAccounts->first();

        $I->expectException(PaymentAccountDoesNotBelongToUserException::class, function() use($user2, $account) {
            $result = Hive::call(CheckIfPaymentAccountBelongsToUserTask::class, [$user2, $account]);
        });
    }

}