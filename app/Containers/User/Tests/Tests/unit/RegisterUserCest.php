<?php

namespace App\Containers\User\Tests\Tests;

use App\Containers\User\Actions\RegisterUserAction;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tests\Cests\BaseCest;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * @group   user
 * @group   unit
 */
class RegisterUserCest extends BaseCest
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
    public function register_user(UnitTester $I)
    {
        $data = [
            'email'    => 'new_user@example.com',
            'password' => 'secret',
            'name'     => 'John Doe',
        ];

        $transporter = new DataTransporter($data);
        $action = App::make(RegisterUserAction::class);
        $user = $action->run($transporter);

        // asset the returned object is an instance of the User
        $I->usePHPUnitTo->assertInstanceOf(User::class, $user);
        $I->assertEquals($user->name, $data['name']);
    }

}