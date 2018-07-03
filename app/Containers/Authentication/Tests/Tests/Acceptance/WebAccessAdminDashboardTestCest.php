<?php

namespace App\Containers\Authentication\Tests\Tests\Acceptance;

use App\Containers\Authentication\Tests\Tests\AcceptanceTester;
use App\Ship\Parents\Tests\Cests\BaseCest;

/**
 * @group   authentication
 * @group   acceptance
 */
class WebAccessAdminDashboardTestCest extends BaseCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @test
     *
     * @param AcceptanceTester $I
     */
    public function test_admin_login_site(AcceptanceTester $I)
    {
        $endpoint = 'http://admin.hive.local';

        $I->amOnPage($endpoint);

        $I->see('Login');
    }

    /**
     * @test
     *
     * @param \App\Containers\Authentication\Tests\Tests\AcceptanceTester $I
     * @group js
     */
    public function test_if_login_works(AcceptanceTester $I)
    {
        $endpoint = 'login';

        $userdata = [
            'email' => 'admin@local.host',
            'password' => 'testing'
        ];

        $access = [
            'roles' => ['admin'],
        ];

        $user = $this->getTestingUser($userdata, $access);

        $I->amOnRoute('get_admin_login_page');

        $I->fillField('email', $userdata['email']);
        $I->fillField('password', $userdata['password']);
        $I->click('login');

        $I->see('Welcome Admin');
        $I->seeInTitle('HiveApi');
    }

}
