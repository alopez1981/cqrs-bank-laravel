<?php

namespace App\Bank\Infrastructure\Persistence;

use App\Bank\Domain\Account;
use App\Bank\Domain\AccountRepository;

final class EloquentAccountRepository implements AccountRepository
{
    public function save(Account $account): void
    {
        AccountEloquent::updateOrCreate(
            ['id' => $account->id()],
            ['balance' => $account->balance()]
        );
    }

    public function get(string $id): ?Account
    {
        $row = AccountEloquent::find($id);

        return $row ? new Account($row->id, $row->balance) : null;
    }

    public function all(): array
    {
        return AccountEloquent::query()
            ->get()
            ->map(fn($a) => new Account($a->id, $a->balance))
            ->all();
    }
}
