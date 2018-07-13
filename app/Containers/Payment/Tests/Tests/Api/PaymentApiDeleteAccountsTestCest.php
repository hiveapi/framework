<?php

namespace App\Containers\Payment\Tests\Tests\Api;

use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Tests\Seeders\PaymentTestSeeder;
use App\Containers\Payment\Tests\Tests\ApiTester;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Util\HttpCode;
use Illuminate\Support\Facades\Artisan;

/**
 * @group   payment
 * @group   api
 */
class PaymentApiDeleteAccountsTestCest extends BaseCest
{
    public function _before(ApiTester $I)
    {
        Artisan::call('db:seed', ['--class' => PaymentTestSeeder::class]);
    }

    public function _after(ApiTester $I)
    {
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_user_can_delete_his_payment_account(ApiTester $I)
    {
        $user = $this->getExistingUser(['email' => 'payment1@local.host']);
        $account = $user->paymentAccounts->first();

        // the route to be accessed (via route name)
        $endpoint = route('api_v1_payment_delete_payment_account', ['id' => $account->getHashedKey()]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendDELETE($endpoint);

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);

        $I->dontSeeRecord(PaymentAccount::class, ['id' => $account->id]);
        $I->dontSeeRecord($account->accountable_type, ['id' => $account->accountable_id]);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_user_can_delete_foreign_payment_accounts(ApiTester $I)
    {
        $user1 = $this->getExistingUser(['email' => 'payment1@local.host']);
        $user2 = $this->getExistingUser(['email' => 'payment2@local.host']);

        $account = $user2->paymentAccounts->first();

        // the route to be accessed (via route name)
        $endpoint = route('api_v1_payment_delete_payment_account', ['id' => $account->getHashedKey()]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user1));

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::CONFLICT);
        $I->seeResponseIsJson();

        $I->seeRecord(PaymentAccount::class, ['id' => $account->id]);
        $I->seeRecord($account->accountable_type, ['id' => $account->accountable_id]);
    }

}