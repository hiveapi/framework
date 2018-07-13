<?php

namespace App\Containers\Payment\Tests\Tests\Api;

use App\Containers\Payment\Tests\Seeders\PaymentTestSeeder;
use App\Containers\Payment\Tests\Tests\ApiTester;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Example;
use Codeception\Util\HttpCode;
use Illuminate\Support\Facades\Artisan;

/**
 * @group   payment
 * @group   api
 */
class PaymentApiGetAccountsTestCest extends BaseCest
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
     * @example {"email" : "payment1@local.host"}
     * @example {"email" : "payment2@local.host"}
     *
     * @param ApiTester $I
     * @param Example   $example
     */
    public function test_if_user_has_payment_accounts(ApiTester $I, Example $example)
    {
        // the route to be accessed (via route name)
        $endpoint = route('api_v1_payment_get_payment_accounts');

        $user = User::where('email', '=', $example['email'])->first();

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();

        $response = $this->getResponseContentObject($I->grabResponse());

        $I->assertCount($user->paymentAccounts->count(), $response->data);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_user_can_view_specific_payment_account(ApiTester $I)
    {
        $user = User::where('email', '=', 'payment1@local.host')->first();

        $account = $user->paymentAccounts->first();

        // the route to be accessed (via route name)
        $endpoint = route('api_v1_payment_get_payment_account', ['id' => $account->getHashedKey()]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_user_is_not_allowed_to_access_other_payment_accounts(ApiTester $I)
    {
        $user1 = User::where('email', '=', 'payment1@local.host')->first();
        $user2 = User::where('email', '=', 'payment2@local.host')->first();

        $account = $user2->paymentAccounts->first();

        // the route to be accessed (via route name)
        $endpoint = route('api_v1_payment_get_payment_account', ['id' => $account->getHashedKey()]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user1));

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::CONFLICT);
        $I->seeResponseIsJson();
    }

}