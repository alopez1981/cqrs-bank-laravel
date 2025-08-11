<?php

namespace Tests\Unit\Application;

use App\Bank\Application\Query\GetBalanceQuery;
use App\Bank\Application\Query\GetBalanceQueryHandler;
use App\Bank\Domain\Account;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\InMemoryAccountRepository;

final class GetBalanceQueryHandlerTest extends TestCase
{
    public function test_returns_current_balance(): void
    {
        $repo = new InMemoryAccountRepository();

        $acc = new Account('acc-1');
        $acc->deposit(500);
        $repo->save($acc);

        $handler = new GetBalanceQueryHandler($repo);
        $result = $handler(new GetBalanceQuery('acc-1'));

        $this->assertSame(500, $result);
    }
}
