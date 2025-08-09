<?php

namespace App\Bank\Infrastructure\Bus;

use App\Bank\Shared\Bus\CommandBus;
use App\Bank\Shared\Message\Command;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use RuntimeException;

final class InMemoryCommandBus implements CommandBus
{
    /**@param array<class-string, class-string> $map */
    public function __construct(private Container $container, private array $map)
    {

    }

    /**
     * @throws BindingResolutionException
     */
    public function dispatch(Command $command): void
    {
        $commandClass = $command::class;
        $handlerClass = $this->map[$commandClass] ?? null;

        if (!$handlerClass) {
            throw new RuntimeException("Command handler not found");
        }

        $handler = $this->container->make($handlerClass);
        $handler($command);
    }
}
