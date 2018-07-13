<?php

namespace App\Containers\Payment\Tests\Tests\Unit;

use App\Containers\Payment\Contracts\PaymentChargerInterface;
use App\Containers\Payment\Tests\Tests\UnitTester;
use App\Ship\Parents\Tests\Cests\BaseCest;
use Illuminate\Support\Facades\Config;

/**
 * @group   payment
 * @group   unit
 */
class PaymentUnitCheckConfigurationTestCest extends BaseCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    /**
     * @test
     *
     * @param UnitTester $I
     */
    public function test_configuration_of_gateways(UnitTester $I)
    {
        $gateways = Config::get('payment-container.gateways', []);

        foreach ($gateways as $gateway)
        {
            $container = $gateway['container'];
            $charger = $gateway['charge_task'];

            $I->assertNotEmpty($container);
            $I->assertNotEmpty($charger);

            $I->assertTrue(class_exists($charger));
        }
    }

}