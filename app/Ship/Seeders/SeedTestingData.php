<?php

namespace App\Ship\Seeders;

use App\Ship\Parents\Seeders\Seeder;
use HiveApi\Core\Traits\Tests\SetupPassportOAuth2Trait;

/**
 * Class SeedTestingData
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class SeedTestingData extends Seeder
{

    use SetupPassportOAuth2Trait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Testing data for live tests
        $this->call(\DatabaseSeeder::class);

        // set setup passport for testing purposes manually!
        // caution: this should not be used in production mode
        $this->setupPassportOAuth2();
    }

}
