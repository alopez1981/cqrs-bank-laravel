<?php

namespace Tests\Unit\Application;

use App\Bank\Application\Command\DepositMoneyCommand;
use App\Bank\Application\Command\DepositMoneyHandler;
use App\Bank\Domain\Account;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Doubles\InMemoryAccountRepository;

final class DepositMoneyHandlerTest extends TestCase
{
    public function test_deposits_into_existing_account(): void
    {
        $repo = new InMemoryAccountRepository();
        $repo->save(new Account('acc-1'));

        $handler = new DepositMoneyHandler($repo);
        $handler(new DepositMoneyCommand('acc-1', 250));

        $this->assertSame(250, $repo->get('acc-1')?->balance());
    }

    public function test_fails_when_account_not_found(): void
    {
        $repo = new InMemoryAccountRepository();
        $handler = new DepositMoneyHandler($repo);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Account not found');

        $handler(new DepositMoneyCommand('missing', 100));
    }
}
