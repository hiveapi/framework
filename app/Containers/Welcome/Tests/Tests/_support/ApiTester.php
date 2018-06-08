<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Containers\Welcome\Tests\Tests\_generated\ApiTesterActions as ContainerApiTesterActions;
use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\ApiTesterActions as ShipApiTesterActions;

class ApiTester extends Tester
{
    use ContainerApiTesterActions;
    use ShipApiTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
