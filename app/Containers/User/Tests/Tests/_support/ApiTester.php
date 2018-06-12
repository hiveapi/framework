<?php

namespace App\Containers\User\Tests\Tests;

use App\Containers\User\Tests\Tests\_generated\ApiTesterActions as ContainerApiTesterActions;
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
