<?php

namespace App\Containers\Localization\Tests\Tests\Api;

use App\Containers\Localization\Tests\Tests\ApiTester;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Codeception\Util\HttpCode;
use Illuminate\Support\Facades\Config;

/**
 * @group   localization
 * @group   api
 */
class LocalizationApiRoutesTestCest extends BaseCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    /**
     * @test
     * @param ApiTester $I
     */
    public function test_if_api_returns_all_locales(ApiTester $I)
    {
        $endpoint = route('api_v1_localization_get_all_localizations');

        $defined_locales = Config::get('localization-container.supported_languages', []);

        /** @var User $user */
        $user = $this->getTestingUser([
            'email' => 'user@user.com',
        ]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));
        $I->haveHttpHeader('accept', 'application/json');

        $I->sendGET($endpoint);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->canSeeResponseIsJson();

        $response = json_decode($I->grabResponse());
        $data = $response->data;

        $I->assertEquals(count($data), count($defined_locales));
        foreach ($defined_locales as $key => $value) {
            if (! is_array($value)) {
                $I->seeResponseContainsJson(['code' => $value]);
            }
            else {
                $I->seeResponseContainsJson(['code' => $key]);
                foreach ($value as $region) {
                    $I->seeResponseContainsJson(['code' => $region]);
                }
            }
        }
    }

    /**
     * @test
     *
     * @param ApiTester $I
     */
    public function test_if_api_does_not_return_unknown_locale(ApiTester $I)
    {
        $endpoint = route('api_v1_localization_get_all_localizations');

        /** @var User $user */
        $user = $this->getTestingUser([
            'email' => 'user@user.com',
        ]);

        $I->amBearerAuthenticated($this->getAuthenticationTokenForUser($user));
        $I->haveHttpHeader('accept', 'application/json');

        $I->sendGET($endpoint);

        $I->dontSeeResponseContainsJson(['code' => 'xxx']);
        $I->seeResponseIsJson();
    }

}