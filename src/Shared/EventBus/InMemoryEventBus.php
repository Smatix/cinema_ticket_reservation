<?php declare(strict_types=1);

namespace App\Shared\EventBus;

use App\Shared\Event\Event;

class InMemoryEventBus implements EventBus
{
    private Event $dispatchedEvent;

    public function dispatch(Event $event): void
    {
        $this->dispatchedEvent = $event;
    }

    public function getDispatchedEvent(): Event
    {
        return $this->dispatchedEvent;
    }
}