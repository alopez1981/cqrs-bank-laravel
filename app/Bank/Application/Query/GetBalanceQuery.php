<?php

namespace App\Bank\Application\Query;

use App\Bank\Shared\Message\Query;

final class GetBalanceQuery implements Query
{
    public function __construct(public string $accountId)
    {
    }
}
