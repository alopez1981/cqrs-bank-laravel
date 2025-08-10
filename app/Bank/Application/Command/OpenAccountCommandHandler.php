<?php

namespace App\Bank\Application\Command;

use App\Bank\Domain\Account;
use App\Bank\Domain\AccountRepository;


final class OpenAccountCommandHandler
{
    public function __construct(private AccountRepository $repo)
    {
    }

    public function __invoke(OpenAccountCommand $cmd): void
    {
        $account = new Account($cmd->accountId);
        $this->repo->save($account);
    }
}
