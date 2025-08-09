<?php
declare(strict_types=1);

namespace App\Bank\Infrastructure\Bus;

use App\Bank\Shared\Bus\QueryBus;
use App\Bank\Shared\Message\Query;
use Illuminate\Contracts\Container\Container;
use RuntimeException;

final class InMemoryQueryBus implements QueryBus
{
    /**
     * @param array<class-string, class-string> $map Mapa: Query::class => Handler::class
     */
    public function __construct(
        private Container $container,
        private array     $map
    )
    {
    }

    public function ask(Query $query): mixed
    {
        $queryClass = $query::class;
        $handlerClass = $this->map[$queryClass] ?? null;

        if (!$handlerClass) {
            throw new RuntimeException("Query handler not found for {$queryClass}");
        }

        $handler = $this->container->make($handlerClass); // __invoke
        return $handler($query);
    }
}
