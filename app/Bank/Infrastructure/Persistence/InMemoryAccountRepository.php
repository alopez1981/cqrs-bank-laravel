<?php

namespace App\Bank\Infrastructure\Persistence;

use App\Bank\Domain\{Account, AccountRepository};

final class InMemoryAccountRepository implements AccountRepository
{
    /** @var array<string, Account> */
    private array $db = [];

    public function save(Account $account): void
    {
        $this->db[$account->id()] = $account;
    }

    public function get(string $id): ?Account
    {
        return $this->db[$id] ?? null;
    }
}
