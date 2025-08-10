<?php

namespace App\Http\Controllers;

use App\Bank\Application\Command\DepositMoneyCommand;
use App\Bank\Application\Command\OpenAccountCommand;
use App\Bank\Application\Query\GetBalanceQuery;
use App\Bank\Shared\Bus\CommandBus;
use App\Bank\Shared\Bus\QueryBus;
use Illuminate\Http\JsonResponse;

final readonly class AccountController
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus   $queryBus)
    {
    }

    public function demo(): JsonResponse
    {
        $accountId = 'acc-123';

        $this->commandBus->dispatch(new OpenAccountCommand($accountId));
        $this->commandBus->dispatch(new DepositMoneyCommand($accountId, 1500));
        $this->commandBus->dispatch(new DepositMoneyCommand($accountId, 250));

        $balance = $this->queryBus->ask(new GetBalanceQuery($accountId));

        return new JsonResponse([
            'accountId' => $accountId,
            'balance_cents' => $balance,
            'balance_eur' => number_format($balance / 100, 2),
        ]);
    }
}
