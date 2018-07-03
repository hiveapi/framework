<?php

namespace App\Containers\User\Tests\Tests\Api;

use App\Containers\User\Tests\Tests\ApiTester;
use App\Ship\Parents\Tests\Cests\BaseCest;

/**
 * @group   user
 * @group   api
 */
class UserApiMyProfileTestCest extends BaseCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_something(ApiTester $I)
    {
        $endpoint = route('api_v1_user_get_authenticated_user');

        $user = $this->getTestingUser([
            'email' => 'test@local.host',
        ]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));
        $I->haveHttpHeader('accept', 'application/json');

        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $resultEmail = $I->grabDataFromResponseByJsonPath('data.email')[0];
        $I->assertEquals('test@local.host', $resultEmail);
    }

}