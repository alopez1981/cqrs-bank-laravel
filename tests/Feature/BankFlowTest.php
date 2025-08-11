<?php

namespace Tests\Feature;

use App\Bank\Application\Command\DepositMoneyCommand;
use App\Bank\Application\Command\OpenAccountCommand;
use App\Bank\Application\Query\GetBalanceQuery;
use App\Bank\Infrastructure\Persistence\AccountEloquent;
use App\Bank\Shared\Bus\CommandBus;
use App\Bank\Shared\Bus\QueryBus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class BankFlowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_opens_an_account_and_updates_balance()
    {
        $commandBus = app(CommandBus::class);
        $queryBus = app(QueryBus::class);

        $id = 'acc-test';
        $commandBus->dispatch(new OpenAccountCommand($id));
        $commandBus->dispatch(new DepositMoneyCommand($id, 150));
        $commandBus->dispatch(new DepositMoneyCommand($id, 50));

        $balance = $queryBus->ask(new GetBalanceQuery($id));
        $this->assertSame(200, $balance);

        $row = AccountEloquent::find($id);
        $this->assertNotNull($row);
        $this->assertSame(200, (int)$row->balance);
    }
}
