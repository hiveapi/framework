<?php

namespace App\Containers\Welcome\Tests\Tests;

use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\AcceptanceTesterActions as ShipAcceptanceTesterActions;
use HiveApi\Core\Abstracts\Tests\Traits\AcceptanceTesterActions as CoreAcceptanceTesterActions;

class AcceptanceTester extends Tester
{
    use CoreAcceptanceTesterActions;
    use ShipAcceptanceTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
