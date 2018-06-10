<?php

namespace App\Containers\Authentication\Tests\Tests;

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
     */
    public function test_if_login_works(AcceptanceTester $I)
    {
        $endpoint = 'http://admin.hive.local';

        $userdata = [
            'email' => 'admin@admin.com',
        ];

        $user = $this->getTestingUser($userdata);

        $I->amOnPage($endpoint);

        $I->fillField('email', 'admin@admin.com');
        $I->fillField('password', 'admin');
        $I->click('login');

        $I->see('Welcome Admin');
        $I->seeInTitle('HiveApi');
    }

}
