<?php declare(strict_types=1);

namespace App\Schedule\Application\Facade;

use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;

class ShowDTO
{
    private Uuid $id;
    private \DateTimeImmutable $start;
    private \DateTimeImmutable $end;
    private Uuid $hallId;
    private Price $price;

    public function __construct(Uuid $id, \DateTimeImmutable $start, \DateTimeImmutable $end, Uuid $hallId, Price $price)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
        $this->hallId = $hallId;
        $this->price = $price;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): \DateTimeImmutable
    {
        return $this->end;
    }

    public function getHallId(): Uuid
    {
        return $this->hallId;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}