<?php

namespace App\Providers;

use App\Bank\Application\Command\DepositMoneyCommand;
use App\Bank\Application\Command\DepositMoneyHandler;
use App\Bank\Application\Command\OpenAccountCommand;
use App\Bank\Application\Command\OpenAccountCommandHandler;
use App\Bank\Application\Query\GetBalanceQuery;
use App\Bank\Application\Query\GetBalanceQueryHandler;
use App\Bank\Domain\AccountRepository;
use App\Bank\Infrastructure\Bus\InMemoryCommandBus;
use App\Bank\Infrastructure\Bus\InMemoryQueryBus;
use App\Bank\Infrastructure\Persistence\InMemoryAccountRepository;
use App\Bank\Shared\Bus\CommandBus;
use App\Bank\Shared\Bus\QueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AccountRepository::class, InMemoryAccountRepository::class);

        $this->app->singleton(CommandBus::class, function ($app) {
            return new InMemoryCommandBus($app, [
                OpenAccountCommand::class => OpenAccountCommandHandler::class,
                DepositMoneyCommand::class => DepositMoneyHandler::class,
            ]);
        });

        $this->app->singleton(QueryBus::class, function ($app) {
            return new InMemoryQueryBus($app, [
                GetBalanceQuery::class => GetBalanceQueryHandler::class,
            ]);
        });
    }

    public function boot(): void
    {
        //
    }
}
