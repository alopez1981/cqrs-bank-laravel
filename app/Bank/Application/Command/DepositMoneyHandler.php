<?php

namespace App\Bank\Application\Command;

use App\Bank\Domain\AccountRepository;
use RuntimeException;

final class DepositMoneyHandler
{
    public function __construct(private AccountRepository $repo)
    {
    }

    public function __invoke(DepositMoneyCommand $cmd): void
    {
        $acc = $this->repo->get($cmd->accountId);
        if (!$acc) throw new RuntimeException('Account not found');

        $acc->deposit($cmd->amountCents);
        $this->repo->save($acc);
    }
}
