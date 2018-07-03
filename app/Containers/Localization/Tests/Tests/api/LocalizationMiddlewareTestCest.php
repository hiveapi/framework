<?php

namespace App\Containers\Localization\Tests\Tests;

use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Util\HttpCode;
use Illuminate\Support\Facades\Config;

/**
 * @group   localization
 * @group   api
 */
class LocalizationMiddlewareTestCest extends BaseCest
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
    public function test_if_middleware_sets_default_language(ApiTester $I)
    {
        $endpoint = route("api_v1_welcome_root");

        $default_locale = Config::get('app.locale');

        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeHttpHeader('content-language', $default_locale);
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_middleware_sets_custom_language(ApiTester $I)
    {
        $endpoint = route("api_v1_welcome_root");

        $custom_locale = 'de';

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('accept-language', $custom_locale);
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeHttpHeader('content-language', $custom_locale);
        $I->seeResponseContains(trans('welcome::messages.welcome'));
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_middleware_throws_error_on_wrong_language(ApiTester $I)
    {
        $endpoint = route("api_v1_welcome_root");

        $unknown_locale = 'xxx';

        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('accept-language', $unknown_locale);
        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::PRECONDITION_FAILED);
    }

}