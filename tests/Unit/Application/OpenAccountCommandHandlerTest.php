<?php

namespace Tests\Unit\Application;

use App\Bank\Application\Command\OpenAccountCommand;
use App\Bank\Application\Command\OpenAccountCommandHandler;
use App\Bank\Domain\Account;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\InMemoryAccountRepository;

final class OpenAccountCommandHandlerTest extends TestCase
{
    public function test_opens_and_persists_an_account(): void
    {
        $repo = new InMemoryAccountRepository();
        $handler = new OpenAccountCommandHandler($repo);

        $handler(new OpenAccountCommand('acc-123'));

        $stored = $repo->get('acc-123');
        $this->assertInstanceOf(Account::class, $stored);
        $this->assertSame(0, $stored->balance());
    }
}
