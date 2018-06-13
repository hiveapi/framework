<?php

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\Payment\Actions\FindPaymentAccountDetailsAction;
use App\Containers\Payment\Actions\GetAllPaymentAccountsAction;
use App\Containers\Payment\Actions\UpdatePaymentAccountAction;
use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
use App\Containers\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;
use HiveApi\Core\Foundation\Facades\Hive;

/**
 * Class Controller
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param GetAllPaymentAccountsRequest $request
     *
     * @return array
     */
    public function getAllPaymentAccounts(GetAllPaymentAccountsRequest $request)
    {
        $paymentAccounts = Hive::call(GetAllPaymentAccountsAction::class);

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    /**
     * @param FindPaymentAccountRequest $request
     *
     * @return array
     */
    public function getPaymentAccount(FindPaymentAccountRequest $request)
    {
        $paymentAccount = Hive::call(FindPaymentAccountDetailsAction::class, [new DataTransporter($request)]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param UpdatePaymentAccountRequest $request
     *
     * @return array
     */
    public function updatePaymentAccount(UpdatePaymentAccountRequest $request)
    {
        $paymentAccount = Hive::call(UpdatePaymentAccountAction::class, [new DataTransporter($request)]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param DeletePaymentAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePaymentAccount(DeletePaymentAccountRequest $request)
    {
        Hive::call(DeletePaymentAccountAction::class, [new DataTransporter($request)]);

        return $this->noContent();
    }
}
