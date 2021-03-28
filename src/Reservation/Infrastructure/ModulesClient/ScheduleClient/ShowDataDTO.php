<?php declare(strict_types=1);

namespace App\Reservation\Infrastructure\ModulesClient\ScheduleClient;

use App\Shared\ValueObject\Price;

class ShowDataDTO
{
    private Price $price;
    private \DateTimeImmutable $start;

    public function __construct(Price $price, \DateTimeImmutable $start)
    {
        $this->price = $price;
        $this->start = $start;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->start;
    }
}