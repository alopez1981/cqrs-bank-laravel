<?php

namespace App\Bank\Application\Query;

use App\Bank\Domain\AccountRepository;
use RuntimeException;

final class GetBalanceQueryHandler
{
    public function __construct(private AccountRepository $repo)
    {
    }

    public function __invoke(GetBalanceQuery $q): int
    {
        $acc = $this->repo->get($q->accountId);
        if (!$acc) throw new RuntimeException('Account not found');

        return $acc->balance();
    }
}
