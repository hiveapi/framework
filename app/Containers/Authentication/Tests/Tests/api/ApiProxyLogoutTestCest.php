<?php

namespace App\Containers\Authentication\Tests\Tests;

use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Util\HttpCode;

/**
 * @group   authentication
 * @group   api
 */
class ApiProxyLogoutTestCest extends BaseCest
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
        $endpoint = 'v1/logout';

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