<?php

namespace App\Containers\Payment\UI\API\Transformers;

use App\Containers\Payment\Models\PaymentTransaction;
use App\Ship\Parents\Transformers\Transformer;

class PaymentTransactionTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param PaymentTransaction $entity
     *
     * @return array
     */
    public function transform(PaymentTransaction $entity)
    {
        $response = [
            'object' => 'PaymentTransformer',
            'id' => $entity->getHashedKey(),

            'gateway' => $entity->gateway,
            'transaction_id' => $entity->transaction_id,

            'status' => $entity->status,
            'is_successful' => $entity->is_successful,

            'price' => $entity->formatMoneyAsArray($entity->getMoneyFromFields('amount', 'currency')),

            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
