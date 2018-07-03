<?php

namespace App\Containers\Localization\Tests\Tests\Unit;

use App\Containers\Localization\Tasks\GetAllLocalizationsTask;
use App\Containers\Localization\Tests\Tests\UnitTester;
use App\Containers\Localization\Values\Localization;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * @group   localization
 * @group   unit
 */
class LocalizationUnitTestCest extends BaseCest
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
     * @param UnitTester $I
     */
    public function test_if_all_supported_languages_are_returned(UnitTester $I)
    {
        $localizations = $this->getAllLocalizations();

        $configuredLocalizations = Config::get('localization-container.supported_languages', []);

        $I->assertEquals(count($configuredLocalizations), $localizations->count());
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_if_specific_locale_is_returned(UnitTester $I)
    {
        $localizations = $this->getAllLocalizations();

        $supportedLocale = new Localization('de');

        $I->usePHPUnitTo::assertContains($supportedLocale, $localizations, '', false, false, false);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_if_specific_locale_with_regions_is_returned(UnitTester $I)
    {
        $localizations = $this->getAllLocalizations();

        $supportedLocaleWithRegion = new Localization('en', ['en-GB', 'en-US']);

        $I->usePHPUnitTo::assertContains($supportedLocaleWithRegion, $localizations, '', false, false, false);
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_if_wrong_locale_is_not_returned(UnitTester $I)
    {
        $localizations = $this->getAllLocalizations();

        $unsupportedLocale = new Localization('xxx');

        $I->usePHPUnitTo::assertNotContains($unsupportedLocale, $localizations, '', false, false, false);
    }

    private function getAllLocalizations()
    {
        $class = App::make(GetAllLocalizationsTask::class);
        return $class->run();
    }

}