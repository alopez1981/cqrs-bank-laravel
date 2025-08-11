<?php

namespace Tests\Doubles;

use App\Bank\Domain\Account;
use App\Bank\Domain\AccountRepository;

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
    
    public function all(): array
    {
        return array_values($this->db);
    }
}
