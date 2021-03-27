<?php declare(strict_types=1);

namespace App\Shared\CommandBus;

use App\Shared\Command\Command;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}