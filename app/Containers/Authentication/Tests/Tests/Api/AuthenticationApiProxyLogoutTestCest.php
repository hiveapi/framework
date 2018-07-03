<?php

namespace App\Containers\Authentication\Tests\Tests\Api;

use App\Containers\Authentication\Tests\Tests\ApiTester;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Util\HttpCode;

/**
 * @group   authentication
 * @group   api
 */
class AuthenticationApiProxyLogoutTestCest extends BaseCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_logout(ApiTester $I)
    {
        $endpoint = route('api_v1_authentication_logout');

        $userdata = [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ];

        $user = $this->getTestingUser($userdata);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendDELETE($endpoint);

        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

}