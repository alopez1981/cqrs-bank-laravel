<?php

use App\Bank\Application\Command\DepositMoneyCommand;
use App\Bank\Application\Command\OpenAccountCommand;
use App\Bank\Application\Query\GetBalanceQuery;
use App\Bank\Shared\Bus\CommandBus;
use App\Bank\Shared\Bus\QueryBus;
use Illuminate\Support\Facades\Route;

Route::get('/cqrs-demo', function (CommandBus $commandBus, QueryBus $queryBus) {
    $accountId = 'acc-123';

    // write side
    $commandBus->dispatch(new OpenAccountCommand($accountId));
    $commandBus->dispatch(new DepositMoneyCommand($accountId, 1500));
    $commandBus->dispatch(new DepositMoneyCommand($accountId, 250));

    // read side
    $balance = $queryBus->ask(new GetBalanceQuery($accountId));

    return response()->json([
        'accountId' => $accountId,
        'balance_cents' => $balance,
        'balance_eur' => number_format($balance / 100, 2),
    ]);
});
