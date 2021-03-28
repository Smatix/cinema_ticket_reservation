<?php declare(strict_types=1);

namespace App\Schedule\Application\Command;

use App\Shared\Command\Command;
use App\Shared\Uuid\Uuid;
use DateTimeImmutable;

class CreateShowCommand implements Command
{
    private Uuid $id;
    private DateTimeImmutable $start;
    private DateTimeImmutable $end;
    private Uuid $hallId;
    private float $price;

    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end, Uuid $hallId, float $price)
    {
        $this->id = Uuid::generate();
        $this->start = $start;
        $this->end = $end;
        $this->hallId = $hallId;
        $this->price = $price;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }

    public function getHallId(): Uuid
    {
        return $this->hallId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}