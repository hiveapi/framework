<?php

namespace App\Containers\User\Tests\Tests;

use App\Containers\User\Tests\Tests\_generated\UnitTesterActions as ContainerUnitTesterActions;
use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\UnitTesterActions as ShipUnitTesterActions;

class UnitTester extends Tester
{
    use ContainerUnitTesterActions;
    use ShipUnitTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
