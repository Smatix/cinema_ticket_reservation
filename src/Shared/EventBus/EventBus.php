<?php declare(strict_types=1);

namespace App\Shared\EventBus;

use App\Shared\Event\Event;

interface EventBus
{
    public function dispatch(Event $event): void;
}