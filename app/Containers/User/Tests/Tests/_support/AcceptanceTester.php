<?php

namespace App\Containers\User\Tests\Tests;

use App\Containers\User\Tests\Tests\_generated\AcceptanceTesterActions as ContainerAcceptanceTesterActions;
use App\Ship\Parents\Tests\Tester\Tester;
use App\Ship\Parents\Tests\Traits\AcceptanceTesterActions as ShipAcceptanceTesterActions;

class AcceptanceTester extends Tester
{
    use ContainerAcceptanceTesterActions;
    use ShipAcceptanceTesterActions;

   /**
    * Define custom methods for this tester here
    */
}
