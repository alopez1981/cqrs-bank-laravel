<?php

namespace App\Bank\Shared\Bus;

use App\Bank\Shared\Message\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;
}
