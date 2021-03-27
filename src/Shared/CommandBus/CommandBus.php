<?php declare(strict_types=1);

namespace App\Shared\CommandBus;

use App\Shared\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}