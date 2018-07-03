<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Example;
use Codeception\Util\HttpCode;
use Illuminate\Support\Str;

/**
 * @group   welcome
 * @group   api
 */
class WelcomeApiRoutesTestCest extends BaseCest
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
    public function test_if_api_has_welcome_page(ApiTester $I)
    {
        $endpoint = route('api_v1_welcome_root');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains(trans('welcome::messages.welcome'));
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
        $endpoint = route("api_{$example['version']}_welcome_version");

        $I->amGoingTo('test the welcome page for API versions');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContains(trans('welcome::messages.welcome'));
        $I->seeResponseContains(Str::upper($example['version']));
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_api_throws_error_on_wrong_api_version(ApiTester $I)
    {
        $endpoint = route('api_v1_welcome_root') . '/vNonExistingVersion';

        $I->amGoingTo('test the welcome page for a non-existing API version');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
    }

}