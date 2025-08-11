<?php

namespace Tests\Unit\Domain;

use App\Bank\Domain\Account;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class AccountTest extends TestCase
{
    public function test_starts_with_zero_balance_by_default(): void
    {
        $acc = new Account('acc-1');
        $this->assertSame(0, $acc->balance());
    }

    public function test_deposits_positive_amounts(): void
    {
        $acc = new Account('acc-1');
        $acc->deposit(150);
        $acc->deposit(50);

        $this->assertSame(200, $acc->balance());
    }

    public function test_rejects_non_positive_deposits(): void
    {
        $acc = new Account('acc-1');

        $this->expectException(InvalidArgumentException::class);
        $acc->deposit(0);
    }
}
