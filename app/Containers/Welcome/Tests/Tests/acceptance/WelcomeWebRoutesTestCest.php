<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Containers\Welcome\Tests\Tests\AcceptanceTester;

/**
 * @group   welcome
 * @group   acceptance
 */
class WelcomeWebRoutesTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    /**
     * @param AcceptanceTester $I
     */
    public function test_welcome_page(AcceptanceTester $I)
    {
        $I->amOnPage('/');

        $I->see('HiveApi', '.title');
        $I->see('GitHub', '.links');
        $I->see('Documentation', '.links');

        $I->seeInTitle('HiveApi');
    }

}
