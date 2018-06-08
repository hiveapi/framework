<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\FunctionalTesterActions as ShipFunctionalTesterActions;
use HiveApi\Core\Abstracts\Tests\Traits\FunctionalTesterActions as CoreFunctionalTesterActions;

class FunctionalTester extends Tester
{
    use CoreFunctionalTesterActions;
    use ShipFunctionalTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
