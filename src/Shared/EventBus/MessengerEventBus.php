<?php declare(strict_types=1);

namespace App\Shared\EventBus;

use App\Shared\Event\Event;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }
}