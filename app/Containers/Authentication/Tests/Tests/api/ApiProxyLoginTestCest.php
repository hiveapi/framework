<?php

namespace App\Containers\Authentication\Tests\Tests;

use App\Ship\Parents\Tests\Cests\BaseCest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * @group   authentication
 * @group   api
 */
class ApiProxyLoginTestCest extends BaseCest
{
    protected function _before()
    {
        $clientId = '100';
        $clientSecret = 'XXp8x4QK7d3J9R7OVRXWrhc19XPRroHTTKIbY8XX';

        // create client
        DB::table('oauth_clients')->insert([
            [
                'id'                     => $clientId,
                'secret'                 => $clientSecret,
                'name'                   => 'Testing',
                'redirect'               => 'http://localhost',
                'password_client'        => '1',
                'personal_access_client' => '0',
                'revoked'                => '0',
            ],
        ]);

        // make the clients credentials available as env variables
        Config::set('authentication-container.clients.web.admin.id', $clientId);
        Config::set('authentication-container.clients.web.admin.secret', $clientSecret);
    }

    protected function _after()
    {
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_login_with_existing_user(ApiTester $I)
    {
        $endpoint = 'v1/clients/web/admin/login';

        $userdata = [
            'email' => 'confirmed@user.com',
            'password' => 'password',
        ];

        $user = $this->getTestingUser($userdata);

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST($endpoint, $userdata);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson(['token_type' => 'Bearer']);
        $I->seeResponseContains('access_token');
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_login_with_nonexisting_user(ApiTester $I)
    {
        $endpoint = 'v1/clients/web/admin/login';

        $data = [
            'email'     => 'unknown@user.com',
            'password'  => 'asdfasdf'
        ];

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST($endpoint, $data);

        $I->seeResponseCodeIs(422);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_login_with_incorrect_login_data(ApiTester $I)
    {
        $endpoint = 'v1/clients/web/admin/login';

        $data = [
            'email'     => 'admin@admin.com',
            'password'  => 'wrongpassword'
        ];

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST($endpoint, $data);

        $I->seeResponseCodeIs(401);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_login_with_unconfirmed_user(ApiTester $I)
    {
        $endpoint = 'v1/clients/web/admin/login';

        Config::set('authentication-container.require_email_confirmation', true);

        $userdata = [
            'email' => 'unconfirmed@user.com',
            'password' => 'password',
            'confirmed' => false,
        ];

        $user = $this->getTestingUser($userdata);

        $data = [
            'email' => 'unconfirmed@user.com',
            'password' => 'password',
        ];

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('content-type', 'application/json');
        $I->sendPOST($endpoint, $data);

        $I->seeResponseCodeIs(409);
    }

}
