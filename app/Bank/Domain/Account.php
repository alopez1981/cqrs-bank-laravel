<?php

namespace App\Bank\Domain;

use InvalidArgumentException;

final class Account
{
    public function __construct(
        private string $id,
        private int    $balance = 0
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function balance(): int
    {
        return $this->balance;
    }

    public function deposit(int $amount): void
    {
        if ($amount <= 0) throw new InvalidArgumentException("amount can't be negative");
        $this->balance += $amount;
    }
}
