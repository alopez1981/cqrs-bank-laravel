<?php

namespace App\Bank\Application\Command;

use App\Bank\Domain\{Account, AccountRepository};

final class OpenAccountCommandHandler
{
    public function __construct(private AccountRepository $repo)
    {
    }

    public function __invoke(OpenAccountCommand $cmd): void
    {
        if ($this->repo->get($cmd->accountId)) return;
        $this->repo->save(new Account($cmd->accountId));
    }
}
