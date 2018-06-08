<?php

namespace App\Containers\Localization\Tests\Tests;

use App\Containers\Localization\Tests\Tests\ApiTester;
use Illuminate\Support\Facades\Config;

/**
 * @group   localization
 * @group   api
 */
class LocalizationMiddlewareTestCest
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
    public function test_if_middleware_sets_default_language(ApiTester $I)
    {
        $default_locale = Config::get('app.locale');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/');

        $I->seeResponseCodeIs(200);
        $I->seeHttpHeader('content-language', $default_locale);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_middleware_sets_custom_language(ApiTester $I)
    {
        $custom_locale = 'de';

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('accept-language', $custom_locale);
        $I->sendGET('/');

        $I->seeResponseCodeIs(200);
        $I->seeHttpHeader('content-language', $custom_locale);
        $I->seeResponseContains(trans('localization::messages.welcome'));
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_middleware_throws_error_on_wrong_language(ApiTester $I)
    {
        $unknown_locale = 'xxx';

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('accept-language', $unknown_locale);
        $I->sendGET('/');

        $I->seeResponseCodeIs(412);
    }

}