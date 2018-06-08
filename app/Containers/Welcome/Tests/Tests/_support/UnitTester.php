<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\UnitTesterActions as ShipUnitTesterActions;
use HiveApi\Core\Abstracts\Tests\Traits\UnitTesterActions as CoreUnitTesterActions;

class UnitTester extends Tester
{
    use CoreUnitTesterActions;
    use ShipUnitTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
