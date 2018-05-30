<?php

namespace App\Containers\Stripe\UI\API\Controllers;

use HiveApi\Core\Foundation\Facades\Hive;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function createStripeAccount(CreateStripeAccountRequest $request)
    {
        $stripeAccount = Hive::call('Stripe@CreateStripeAccountAction', [new DataTransporter($request)]);

        return $this->accepted([
            'message'           => 'Stripe account created successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

    /**
     * @param \App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function updateStripeAccount(UpdateStripeAccountRequest $request)
    {
        $stripeAccount = Hive::call('Stripe@UpdateStripeAccountAction', [new DataTransporter($request)]);

        return $this->accepted([
            'message'           => 'Stripe account updated successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

}
