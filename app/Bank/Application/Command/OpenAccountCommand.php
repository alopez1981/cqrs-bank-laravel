<?php

namespace App\Bank\Application\Command;

use App\Bank\Shared\Message\Command;

final class OpenAccountCommand implements Command
{
    public function __construct(public string $accountId)
    {
    }
}
