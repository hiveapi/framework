<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentTransactionRepository;
use App\Containers\User\Models\User;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;
use App\Ship\Parents\Tasks\Task;

class GetTransactionsForUserTask extends Task
{

    /**
     * @var PaymentTransactionRepository
     */
    protected $repository;

    /**
     * GetTransactionsForUserTask constructor.
     *
     * @param PaymentTransactionRepository $repository
     */
    public function __construct(PaymentTransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(User $user)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $user->id));
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        return $this->repository->paginate();
    }
}
