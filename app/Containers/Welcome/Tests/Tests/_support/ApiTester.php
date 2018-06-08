<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\ApiTesterActions as ShipApiTesterActions;
use HiveApi\Core\Abstracts\Tests\Traits\ApiTesterActions as CoreApiTesterActions;

class ApiTester extends Tester
{
    use CoreApiTesterActions;
    use ShipApiTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
