<?php

namespace App\Bank\Shared\Bus;

use App\Bank\Shared\Message\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
