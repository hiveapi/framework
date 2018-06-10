<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Example;
use Illuminate\Support\Str;

/**
 * @group   welcome
 * @group   api
 */
class WelcomeApiRoutesTestCest extends BaseCest
{
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_api_has_welcome_page(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/');

        $I->seeResponseCodeIs(200);
        $I->seeResponseContains(trans('localization::messages.welcome'));
    }

    /**
     * @test
     * @example {"version" : "v1"}
     *
     * @param ApiTester $I
     * @param Example   $example
     */
    public function test_if_api_serves_welcome_page_for_version(ApiTester $I, Example $example)
    {
        $I->amGoingTo('test the welcome page for API versions');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/' . $example['version']);

        $I->seeResponseCodeIs(200);
        $I->seeResponseContains(trans('localization::messages.welcome'));
        $I->seeResponseContains(Str::upper($example["version"]));
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_api_throws_error_on_wrong_api_version(ApiTester $I)
    {
        $I->amGoingTo('test the welcome page for a non-existing API version');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/' . 'non-existing-version');

        $I->seeResponseCodeIs(404);
    }

}