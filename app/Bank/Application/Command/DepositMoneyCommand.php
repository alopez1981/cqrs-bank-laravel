<?php

namespace App\Bank\Application\Command;

use App\Bank\Shared\Message\Command;

final class DepositMoneyCommand implements Command
{
    public function __construct(
        public string $accountId,
        public int    $amountCents
    )
    {
    }
}
