<?php declare(strict_types=1);

namespace App\Schedule\Domain;

use App\Shared\Uuid\Uuid;
use App\Shared\ValueObject\Price;
use League\Period\Period;

class Show
{
    private Uuid $id;
    private Period $period;
    private Hall $hall;
    private Price $price;

    public function __construct(Uuid $id, Period $period, Hall $hall, Price $price)
    {
        $this->id = $id;
        $this->period = $period;
        $this->hall = $hall;
        $this->price = $price;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPeriod(): Period
    {
        return $this->period;
    }

    public function getHall(): Hall
    {
        return $this->hall;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}