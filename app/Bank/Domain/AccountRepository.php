<?php

namespace App\Bank\Domain;

interface AccountRepository
{
    public function save(Account $account): void;

    public function get(string $id): ?Account;
}
