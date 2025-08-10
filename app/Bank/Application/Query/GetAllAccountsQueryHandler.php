<?php

namespace App\Bank\Application\Query;

use App\Bank\Domain\AccountRepository;

final class GetAllAccountsQueryHandler
{
    public function __construct(private AccountRepository $repo)
    {

    }

    public function __invoke(GetAllAccountsQuery $query): array
    {
        return $this->repo->all();
    }
}
